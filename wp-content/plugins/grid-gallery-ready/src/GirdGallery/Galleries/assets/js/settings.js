/*global jQuery*/
(function (app, $) {

    function Controller() {
        this.$container = $('.form-tabs');
        this.tabs = this.getAvailableTabs();
        this.$currentTab = null;
        this.$currentTarget = null;

        this.init();
    }

    Controller.prototype.init = function () {
        var lastTab = this.getCookie('lastTab');

        if (!lastTab) {
            this.$currentTab = this.tabs[Object.keys(this.tabs)[0]];
            this.$currentTarget = $('.change-tab').first();
        } else {
            this.$currentTarget = $('.change-tab[href="' + lastTab + '"]');
            this.$currentTab = $('[data-tab="' + lastTab + '"]');
        }


        this.hideTabs();
        this.$currentTab.fadeIn();
        this.$currentTarget.addClass('active');
    };

    Controller.prototype.getParameterByName = function (name) {
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");

        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
            results = regex.exec(location.search);
        return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    };

    Controller.prototype.getCookie = function (name) {
        var matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : null;
    };

    Controller.prototype.setCookie = function (name, value) {
        document.cookie = name + '=' + encodeURIComponent(value);
    }

    Controller.prototype.getAvailableTabs = function () {
        var tabs = {};

        $.each($('[data-tab]'), function (index, tab) {
            tabs[$(tab).data('tab')] = $(tab);
        });

        return tabs;
    };

    Controller.prototype.hideTabs = function () {
        $.each(this.tabs, function () { this.hide() });
    };

    Controller.prototype.changeTab = function (event) {
        event.preventDefault();

        this.hideTabs();

        this.$currentTarget.removeClass('active');

        this.$currentTarget = $(event.currentTarget);
        this.$currentTarget.addClass('active');

        this.$currentTab = this.tabs[this.$currentTarget.attr('href')];
        this.$currentTab.show();

        this.setCookie('lastTab', this.$currentTarget.attr('href'));
    };

    Controller.prototype.remove = function (event) {
        if (!confirm('Are you sure?')) {
            event.preventDefault();
        }
    };

    Controller.prototype.togglePhotoHeight = function () {
        var $options = $('[name="area[photo_height]"], [name="area[photo_height_unit]"]');

        $options.parents('tr').hide();

        if ($(':selected', this).val() != '1') {
            $options.parents('tr').show();
        }
    };

    Controller.prototype.toggleSlideShow = function () {
        var $options = $('[name="box[slideshowSpeed]"], [name="box[slideshowAuto]"]');
        $options.parents('tr').hide();

        if ($(':selected', this).val() === 'true') {
            $options.parents('tr').show();
        }
    };

    Controller.prototype.removePresetRequest = function () {
        var presetId = $('#presetId').val(),
            request = app.Ajax.Post({
                module: 'galleries',
                action: 'removePreset'
        });

        request.add('preset_id', presetId);

        return request;
    };

    Controller.prototype.initSaveDialog = function () {
        $('#saveDialog').dialog({
            width:    350,
            autoOpen: false,
            modal:    true,
            buttons:  {
                Save:   function () {
                    var $settingsId  = $('#settingsId'),
                        $presetTitle = $('#presetTitle'),
                        request = app.Ajax.Post(
                            {
                                module: 'galleries',
                                action: 'savePreset'
                            }
                        );

                    // Close the dialog and show error if the settings isn't yet saved to the database.
                    if ($settingsId.val() === 'undefined') {
                        $.jGrowl('You must to save the settings first.');
                        $(this).dialog('close');
                    }

                    request.add('settings_id', $settingsId.val());
                    request.add('title', $presetTitle.val());

                    request.send($.proxy(function (response) {
                        if (response.message) {
                            $.jGrowl(response.message);
                        }

                        if (!response.error) {
                            window.location.reload(true);
                        }

                        $(this).dialog('close');
                    }, this));
                },
                Cancel: function () {
                    $(this).dialog('close');
                }
            }
        });
    };

    Controller.prototype.openSaveDialog = function () {
        $('#saveDialog').dialog('open');
    };

    Controller.prototype.initDeleteDialog = function () {
        var controller = this;

        $('#deletePreset').dialog({
            width:    350,
            autoOpen: false,
            modal:    true,
            buttons:  {
                Delete: function () {
                    var request = controller.removePresetRequest();

                    request.send($.proxy(function (response) {
                        if (response.message) {
                            $.jGrowl(response.message);
                        }

                        if (!response.error) {
                            window.location.reload(true);
                        }

                        $(this).dialog('close');
                    }, this));
                },
                Cancel: function () {
                    $(this).dialog('close');
                }
            }
        });
    };

    Controller.prototype.openDeleteDialog = function () {
        $('#deletePreset').dialog('open');
    };

    Controller.prototype.initLoadDialog = function () {
        var controller = this;

        $("#loadPreset").dialog({
            width:    350,
            autoOpen: false,
            modal:    true,
            buttons:  {
                Cancel: function () {
                    $(this).dialog('close');
                },
                Load: function () {
                    var galleryId,
                        presetId,
                        $presetsList = $('#presetList'),
                        request = app.Ajax.Post({
                            module: 'galleries',
                            action: 'applyPreset'
                        });

                    // Get gallery Id from the browser's query string.
                    galleryId = parseInt(controller.getParameterByName('gallery_id'), 10);

                    // Get preset id from the preset list.
                    presetId = parseInt($presetsList.val(), 10);

                    request.add('gallery_id', galleryId);
                    request.add('preset_id', presetId);

                    request.send($.proxy(function (response) {
                        if (response.message) {
                            $.jGrowl(response.message);
                        }

                        if (!response.error) {
                            $(this).dialog('close');
                            window.location.reload(true);
                        }
                    }, this));
                }
            },
            open: function () {
                var request = app.Ajax.Post({
                    module: 'galleries',
                    action: 'getPresetList'
                });

                request.send(function (response) {
                    var $presetList = $('#presetList'),
                        $errors = $('#presetListError');

                    if (response.error) {
                        $presetList.attr('disabled', 'disabled');
                        $errors.find('#presetLoadingFailed').show();
                        return;
                    }

                    if (response.presets.length < 0) {
                        $presetList.attr('disabled', 'disabled');
                        $errors.find('#presetEmpty').show();
                        return;
                    }

                    $.each(response.presets, function (index, preset) {
                        $presetList.append('<option value="'+preset.id+'">'+preset.title+'</option>');
                    });
                });
            }
        });
    };

    Controller.prototype.openPresetDialog = function () {
        $('#loadPreset').dialog('open');
    };

    Controller.prototype.removePresetFromList = function () {
        var request = this.removePresetRequest();

        request.send(function (response) {
            if (response.error) {
                return false;
            }

            $('#presetId').find(':selected').remove();
        });
    };

    Controller.prototype.initThemeDialog = function () {
        $('#themeDialog').dialog({
            autoOpen: false,
            modal:    true,
            width:    570,
            buttons:  {
                // Select: function () {
                //     var selected = $('#bigImageThemeSelect').val(),
                //         $theme = $('#bigImageTheme');
                //
                //     $theme.val(selected);
                //     $(this).dialog('close');
                // },
                Cancel: function () {
                    $(this).dialog('close');
                }
            }
        });

        Controller.prototype.initThemeSelect = function () {
            var $theme = $('#bigImageTheme');

            $('.theme').on('click', function () {
                $theme.val($(this).data('val'));
                $('.themeName').text($(this).data('name'));
                $('#themeDialog').dialog('close');
            });
        };

        Controller.prototype.initEffectsDialog = function () {
            $('#effectDialog').dialog({
                autoOpen: false,
                modal:    true,
                width:    740,
                buttons:  {
                    Cancel: function () {
                        $(this).dialog('close');
                    }
                }
            });
        };

        Controller.prototype.openEffectsDialog = function () {
            $('#effectDialog').dialog('open');
        };
    };

    Controller.prototype.initEffectPreview = function () {
        var $effect  = $('#overlayEffect'),
            $preview = $('#effectsPreview'),
            $dialog  = $('#effectDialog');

        $preview.find('figure').on('click', function (event) {
            event.preventDefault();

            $effect.val($(this).data('gird-gallery-type'));
            $dialog.dialog('close');

            $('.selectedEffectName').text($.proxy(function () {
                return this.find('span').text();
            }, $(this)));
        });
    };

    Controller.prototype.openThemeDialog = function () {
        $('#themeDialog').dialog('open');
    };

    Controller.prototype.toggleShadow = function () {
        var $table = $('table[data-tab="shadow"]'),
            $toggleRow = $('#useShadowRow'),
            value = 0;

        $('#useShadow').on('change', function () {
            value = parseInt($(this).val(), 10);

            if (value === 0) {
                $table.find('tr').hide();
                $toggleRow.show();
            } else {
                $table.find('tr').show();
            }
        }).trigger('change');
    };

    Controller.prototype.selectCover = function (e) {
        var target = $(e.currentTarget),
            covers = $('.covers'),
            cover  = $('#coverUrl');

        covers.find('li').removeClass('selected');
        target.parents('li').addClass('selected');

        cover.val(target.parents('li').data('url'));
    }

    Controller.prototype.savePosts = function () {
        jQuery('[name="posts[add]"]').on('click', $.proxy(function() {
            ReadyGridGallery.Loader.show('Please, wait until post will be imported.');
            var request = ReadyGridGallery.Ajax.Post({
                module: 'galleries',
                action: 'savePosts'
            });

            request.add('galleryId', parseInt(this.getParameterByName('gallery_id'), 10));
            request.add('id', parseInt(jQuery('[name="posts[current]"] option:selected').val()));

            request.send($.proxy(function (response) {
                jQuery('tbody#the-list').append(
                    this.addRow(
                        jQuery('[name="posts[current]"] option:selected').val(),
                        jQuery('[name="posts[current]"] option:selected').text(),
                        response.post_author, response.comment_count, response.post_date
                    ));
                ReadyGridGallery.Loader.hide();
                $.jGrowl('Done');
            }, this));
        }, this));

        jQuery('#remove-posts').on('click', $.proxy(function() {
            var request = ReadyGridGallery.Ajax.Post({
                module: 'galleries',
                action: 'removePosts'
            });

            var postsId = new Array();
            jQuery('[name="post[]"]').each(function() {
                if($(this).attr('checked')) {
                    postsId.push($(this).attr('id'))
                    $(this).parent().parent().remove();
                }
            });

            request.add('galleryId', parseInt(this.getParameterByName('gallery_id'), 10));
            request.add('id', postsId);

            request.send($.proxy(function (response) {
                $.jGrowl('Removed');
            }, this));
        }, this));

        jQuery('#button-select-posts').on('click', function() {
            if($(this).data('value') == 'select') {
                jQuery('[name="post[]"]').each(function() {
                    $(this).attr('checked', true);
                });
                $(this).data('value', 'deselect');
            } else {
                jQuery('[name="post[]"]').each(function() {
                    $(this).attr('checked', false);
                });
                $(this).data('value', 'select');
            }
        });
    }

    Controller.prototype.addRow = function(id, title , author, comments, date) {
        return  '<tr>'+
                    '<th scope="row" class="check-column">' +
                        '<label class="screen-reader-text"></label>' +
                        '<input type="checkbox" name="post[]" id="' + id + '" data-observable="">'+
                    '</th>'+
                    '<td class="date column-author">' + author +'</td>' +
                    '<td class="date column-title">' + title +'</td>' +
                    '<td class="title column-comments">'+ comments +'</td>' +
                    '<td class="title column-date">'+ date +'</td>' +
                '</tr>';
    }

    $(document).ready(function () {
        var qs = new URI().query(true), controller;

        if (qs.module === 'galleries' && qs.action === 'settings') {
            controller = new Controller();

            controller.initSaveDialog();
            controller.initDeleteDialog();
            controller.initLoadDialog();
            controller.initThemeDialog();
            controller.initEffectsDialog();

            controller.initEffectPreview();

            controller.toggleShadow();

            controller.initThemeSelect();

            controller.savePosts();

            // Save as preset dialog
            $('#btnSaveAsPreset').on('click', controller.openSaveDialog);

            // Delete preset dialog
            $('#btnDeletePreset').on('click', controller.openDeleteDialog);

            // Load from preset dialog
            $('#btnLoadFromPreset').on('click', controller.openPresetDialog);

            // Delete gallery
            $('.delete').on('click', controller.remove);

            // Change the tab
            $('.change-tab')
                .on('click', $.proxy(controller.changeTab, controller));

            // Toggle photo height based on the selected grid type.
            $('#grid-type').find('select')
                .on('change', controller.togglePhotoHeight)
                .trigger('change');

            // Toggle colorbox slide-show settings
            $('select[name="box[slideshow]"]')
                .on('change', controller.toggleSlideShow)
                .trigger('change');

            // Open theme dialog
            $('#chooseTheme').on('click', controller.openThemeDialog);

            // Open effects dialog
            $('#chooseEffect').on('click', controller.openEffectsDialog);

            // Cover
            $('.covers img').on('click', controller.selectCover);
        }
    });

}(window.ReadyGridGallery = window.ReadyGridGallery || {}, jQuery));

// Preview

(function ($) {
    var getSelector = (function (fieldName) {
        return '[name="' + fieldName + '"]';
    });


    function ImagePreview(enabled) {
        this.$window = $('#preview.gallery-preview');

        if (enabled) {
            this.init();
            this.$window.show();
        }
    }

    ImagePreview.prototype.setProp = (function (selector, props) {
        this.$window.find(selector).css(props);
    });

    ImagePreview.prototype.setDataset = (function (selector, name, value) {
        this.$window.find(selector).attr(name, value);
    });

    ImagePreview.prototype.initBorder = (function () {
        var fieldNames = {
            type: 'thumbnail[border][type]',
            color: 'thumbnail[border][color]',
            width: 'thumbnail[border][width]',
            radius: 'thumbnail[border][radius]',
            radiusUnit: 'thumbnail[border][radius_unit]'
        };

        $(getSelector(fieldNames.type)).on('change', $.proxy(function (e) {
            this.setProp('figure', { borderStyle: $(e.currentTarget).val() });
        }, this)).trigger('change');

        $(getSelector(fieldNames.color)).on('change', $.proxy(function (e) {
            this.setProp('figure', { borderColor: $(e.currentTarget).val() });
        }, this)).trigger('change');

        $(getSelector(fieldNames.width)).bind('change paste keyup', $.proxy(function (e) {
            this.setProp('figure', { borderWidth: $(e.currentTarget).val() });
        }, this)).trigger('change');

        $(getSelector(fieldNames.radius) + ',' + getSelector(fieldNames.radiusUnit))
            .bind('change paste keyup', $.proxy(function () {
                var $value = $(getSelector(fieldNames.radius)),
                    $unit  = $(getSelector(fieldNames.radiusUnit)),
                    unitValue = 'px';

                if (parseInt($unit.val(), 10) == 1) {
                    unitValue = '%';
                }

                this.setProp('figure', { borderRadius: $value.val() + unitValue });
                this.setProp('figcaption', { borderRadius: $value.val() + unitValue });

            }, this))
            .trigger('change');
    });

    ImagePreview.prototype.initIcons = (function () {
        var fields = {
            iconsColor: 'icons[color]',
            hoverIconsColor: 'icons[hover_color]',
            bgColor: 'icons[background]',
            hoverBgColor: 'icons[background_hover]',
            iconsSize : 'icons[size]'
        };

        console.log($.parseJSON($('#showIcons').val()));

        if($.parseJSON($('#showIcons').val())) {
            console.log($('#preview figure.gird-gallery-caption').attr('data-gird-gallery-type'));
            $('#preview figure.gird-gallery-caption').attr('data-gird-gallery-type', 'icons');
            $('#preview figcaption').show();
        }
        $('#showIcons').on('change', $.proxy(function() {
            if($.parseJSON($('#showIcons').val())){
                this.setDataset('figure', 'data-gird-gallery-type', 'icons');
                $('#preview figcaption').show();
            } else {
                $('#preview figcaption').hide();
            }
        }, this));

        $(getSelector(fields.iconsColor)).bind('change paste keyup', $.proxy(function (e) {
            this.setProp('a.hi-icon', { color: $(e.currentTarget).val() });
        }, this))
            .trigger('change')
            .bind('change', $.proxy(function () {
                this.setProp('figcaption', { opacity: 1 });
            }, this))
            .on('focusout', $.proxy(function () {
                this.setProp('figcaption', { opacity: '' });
            }, this));

        $(getSelector(fields.hoverIconsColor)).bind('change paste keyup', $.proxy(function (e) {
            $('a.hi-icon').on('mouseover', $.proxy(function() {
                this.setProp('a.hi-icon', { color: $(e.currentTarget).val() });
            }, this))
            $('a.hi-icon').on('mouseleave', $.proxy(function() {
                this.setProp('a.hi-icon', { color: $(getSelector(fields.iconsColor)).val() });
            }, this))
        }, this))
            .trigger('change')
            .bind('change', $.proxy(function () {
                this.setProp('figcaption', { opacity: 1 });
            }, this))
            .on('focusout', $.proxy(function () {
                this.setProp('figcaption', { opacity: '' });
            }, this));

        $(getSelector(fields.bgColor)).bind('change paste keyup', $.proxy(function (e) {
            this.setProp('figcaption', { backgroundColor: $(e.currentTarget).val() });
        }, this))
            .trigger('change')
            .bind('change', $.proxy(function () {
                this.setProp('figcaption', { opacity: 1 });
            }, this))
            .on('focusout', $.proxy(function () {
                this.setProp('figcaption', { opacity: '' });
            }, this));

        $(getSelector(fields.hoverBgColor)).bind('change paste keyup', $.proxy(function (e) {
            $('a.hi-icon').on('mouseover', $.proxy(function() {
                this.setProp('figcaption', { backgroundColor: $(e.currentTarget).val() });
            }, this))
            $('a.hi-icon').on('mouseleave', $.proxy(function() {
                this.setProp('figcaption', { backgroundColor: $(getSelector(fields.bgColor)).val() });
            }, this))
        }, this))
            .trigger('change')
            .bind('change', $.proxy(function () {
                this.setProp('figcaption', { opacity: 1 });
            }, this))
            .on('focusout', $.proxy(function () {
                this.setProp('figcaption', { opacity: '' });
            }, this));

        $(getSelector(fields.iconsSize)).bind('change paste keyup', $.proxy(function (e) {
            this.setProp('a.hi-icon', { width: $(e.currentTarget).val()*9, height: $(e.currentTarget).val()*9  });
        }, this))
            .trigger('change')
            .bind('change', $.proxy(function () {
                this.setProp('figcaption', { opacity: 1 });
            }, this))
            .on('focusout', $.proxy(function () {
                this.setProp('figcaption', { opacity: '' });
            }, this));
    });

    ImagePreview.prototype.initShadow = (function () {
        var fieldNames = {
            color: 'thumbnail[shadow][color]',
            blur: 'thumbnail[shadow][blur]',
            x: 'thumbnail[shadow][x]',
            y: 'thumbnail[shadow][y]'
        };

        $('#useShadow').on('change', $.proxy(function () {
            if (parseInt($('#useShadow').val(), 10) == 1) {
                $(
                    getSelector(fieldNames.color) + ','
                        + getSelector(fieldNames.blur) + ','
                        + getSelector(fieldNames.x) + ','
                        + getSelector(fieldNames.y)
                )
                    .bind('change paste keyup', $.proxy(function (e) {
                        var $color = $(getSelector(fieldNames.color)),
                            $blur = $(getSelector(fieldNames.blur)),
                            $x = $(getSelector(fieldNames.x)),
                            $y = $(getSelector(fieldNames.y));

                        this.setProp('figure', {
                            boxShadow: $x.val() + 'px '
                                           + $y.val() + 'px '
                                           + $blur.val() + 'px '
                                + $color.val()
                        });
                    }, this))
                    .trigger('change');
            } else {
                this.setProp('figure', {
                    boxShadow: 'none'
                });
            }
        }, this)).trigger('change');
    });

    ImagePreview.prototype.initMouseShadow = (function() {
        if($('#useMouseOverShadow option:selected').text().trim() == 'Yes') {
            $('figure.gird-gallery-caption').on('mouseover', $.proxy(function () {
                this.setProp('.gird-gallery-caption img' , {boxShadow: '5px 5px 5px #888'});
                this.setProp('.gird-gallery-caption' , {overflow: 'visible'});
            }, this));
            $('figure.gird-gallery-caption').on('mouseleave', $.proxy(function () {
                this.setProp('.gird-gallery-caption img' , {boxShadow: 'inherit'});
                this.setProp('.gird-gallery-caption' , {overflow: 'hidden'});
            }, this));
        }

        $('#useMouseOverShadow').on('change', $.proxy(function() {
            if($('#useMouseOverShadow option:selected').text().trim() == 'Yes') {
                $('figure.gird-gallery-caption').on('mouseover', $.proxy(function () {
                    this.setProp('.gird-gallery-caption img' , {boxShadow: '5px 5px 5px #888'});
                    this.setProp('.gird-gallery-caption' , {overflow: 'visible'});
                }, this));
                $('figure.gird-gallery-caption').on('mouseleave', $.proxy(function () {
                    this.setProp('.gird-gallery-caption img' , {boxShadow: 'inherit'});
                    this.setProp('.gird-gallery-caption' , {overflow: 'hidden'});
                }, this));
            } else {
                $('figure.gird-gallery-caption').off('mouseover');
                $('figure.gird-gallery-caption').off('mouseleave');
            }

        }, this));
    });

    ImagePreview.prototype.initOverlayShadow = (function() {
        if($('[name="area[overlay]"] option:selected').text().trim() == 'Yes') {
            $('figure.gird-gallery-caption').on('mouseover', $.proxy(function () {
                this.setProp('.gird-gallery-caption img' , {opacity: '1.0'});
            }, this));
            $('figure.gird-gallery-caption').on('mouseleave', $.proxy(function () {
                this.setProp('.gird-gallery-caption img' , {opacity: '0.2'});
            }, this));
        }

        $('[name="area[overlay]"]').on('change', $.proxy(function() {
            if($('[name="area[overlay]"] option:selected').text().trim() == 'Yes') {
                this.setProp('.gird-gallery-caption img' , {opacity: '0.2'});
                $('figure.gird-gallery-caption').on('mouseover', $.proxy(function () {
                    this.setProp('.gird-gallery-caption img' , {opacity: '1.0'});
                }, this));
                $('figure.gird-gallery-caption').on('mouseleave', $.proxy(function () {
                    this.setProp('.gird-gallery-caption img' , {opacity: '0.2'});
                }, this));
            } else {
                this.setProp('.gird-gallery-caption img' , {opacity: '1.0'});
                $('figure.gird-gallery-caption').off('mouseover');
                $('figure.gird-gallery-caption').off('mouseleave');
            }

        }, this));
    });

    ImagePreview.prototype.initCaption = (function () {

        var fields = {
            effect: 'thumbnail[overlay][effect]',
            bg: 'thumbnail[overlay][background]',
            fg: 'thumbnail[overlay][foreground]',
            opacity: 'thumbnail[overlay][transparency]',
            size: 'thumbnail[overlay][text_size]',
            sizeUnit: 'thumbnail[overlay][text_size_unit]',
            align: 'thumbnail[overlay][text_align]'
        };

        $('#captionEnabled').on('change', $.proxy(function (e) {
            if ($(e.currentTarget).val() == 'true') {
                $('#preview figcaption').show();
                this.setDataset('figure', 'data-gird-gallery-type', $('#overlayEffect').val());

                $('#effectsPreview').find('figure').bind('click', $.proxy(function (e) {
                    this.setDataset('figure', 'data-gird-gallery-type', $(e.currentTarget).data('gird-gallery-type'));
                }, this)).trigger('change');

                $(getSelector(fields.bg)).bind('change paste keyup', $.proxy(function (e) {
                    this.setProp('figcaption', { backgroundColor: $(e.currentTarget).val() });
                }, this))
                    .trigger('change')
                    .bind('change', $.proxy(function () {
                        this.setProp('figcaption', { opacity: 1 });
                    }, this))
                    .on('focusout', $.proxy(function () {
                        this.setProp('figcaption', { opacity: '' });
                    }, this));

                $(getSelector(fields.fg)).bind('change paste keyup', $.proxy(function (e) {
                    this.setProp('figcaption', { color: $(e.currentTarget).val() });
                }, this))
                    .trigger('change')
                    .bind('change', $.proxy(function () {
                        this.setProp('figcaption', { opacity: 1 });
                    }, this))
                    .on('focusout', $.proxy(function () {
                        this.setProp('figcaption', { opacity: '' });
                    }, this));

                $(getSelector(fields.opacity))
                    .on('focus', $.proxy(function () {
                        this.$window.find('small').show();
                    }, this))
                    .on('focusout', $.proxy(function () {
                        this.$window.find('small').hide();
                    }, this));

                $(getSelector(fields.size) + ',' + getSelector(fields.sizeUnit))
                    .bind('change paste keyup', $.proxy(function (e) {
                        var $size = $(getSelector(fields.size)),
                            $unit = $(getSelector(fields.sizeUnit)),
                            unitValue = 'px';

                        switch (parseInt($unit.val(), 10)) {
                            case 0:
                                unitValue = 'px';
                                break;
                            case 1:
                                unitValue = '%';
                                break;
                            case 2:
                                unitValue = 'em';
                                break;
                        }

                        this.setProp('figcaption', { fontSize: $size.val() + unitValue });
                    }, this))
                    .trigger('change')
                    .on('focus', $.proxy(function () {
                        this.setProp('figcaption', { opacity: 1 });
                    }, this))
                    .on('focusout', $.proxy(function () {
                        this.setProp('figcaption', { opacity: '' });
                    }, this));

                $(getSelector(fields.align)).on('change', $.proxy(function (e) {
                    var value = '';

                    switch (parseInt($(e.currentTarget).val(), 10)) {
                        case 0:
                            value = 'left';
                            break;
                        case 1:
                            value = 'right';
                            break;
                        case 2:
                            value = 'center';
                            break;
                        case 3:
                            value = '';
                            break;
                    }

                    this.setProp('figcaption', { textAlign: value });
                }, this))
                    .trigger('change')
                    .on('focus', $.proxy(function () {
                        this.setProp('figcaption', { opacity: 1 });
                    }, this))
                    .on('focusout', $.proxy(function () {
                        this.setProp('figcaption', { opacity: '' });
                    }, this));
            } else {
                $('#preview figcaption').hide();
                this.setDataset('figure', 'data-gird-gallery-type', 'None')
            }
        }, this)).trigger('change');
    });

    ImagePreview.prototype.init = (function () {
        this.$window.draggable();

        this.initBorder();
        this.initShadow();
        this.initMouseShadow();
        this.initOverlayShadow();
        //this.initIcons();
        this.initCaption();
    });

    $(document).ready(function () {
        jQuery('input#cmn-preview').click(function() {
            if($(this).is(':checked')) {
                jQuery('#preview figure').show();
            } else {
                jQuery('#preview figure').hide();
            }
        });
        return new ImagePreview(true);
    });
}(jQuery));