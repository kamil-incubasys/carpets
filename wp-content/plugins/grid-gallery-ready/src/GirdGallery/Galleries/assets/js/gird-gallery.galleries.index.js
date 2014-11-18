(function($) {

    $(document).ready(function() {
        initCreateDialog();

        if (window.location.hash === '#add') {
            $('#btn-add-new').trigger('click');
        }
    });

    function initCreateDialog() {

        var $container = $('#gg-create-gallery-dialog'),
            $trigger = $('#gg-create-gallery-link, #btn-add-new');

        var request = {
            action: 'gird-gallery',
            title:  'Untitled gallery',
            route:  {
                module: 'galleries',
                action: 'create'
            }
        };

        if (typeof $container === 'undefined' || $container === false)  {
            // console.log('The "Create gallery" popup window was not initialized: Container not found.');
            return;
        }

        if (typeof $trigger === 'undefined' || $trigger === false) {
            // console.log('The "Create gallery" popup window trigger is undefined');
            return;
        }

        $trigger.on('click', function(e) {
            // e.preventDefault();
            $container.dialog('open');
        });


        var submitGallery = (function () {
            /* Window layers */
            var layers = {
                text:   $('#gg-create-gallery-text'),
                loader: $('#gg-create-gallery-loader')
            };

            /* Gallery title */
            var title = $container.find('input').val(),
                preset = $container.find('#presetValue').val();

            if (!title) {
                $container.find('#newGalleryAlert').show();
                return false;
            }

            layers.text.hide();
            layers.loader.show();


            if (title) {

                request = $.extend('', request, {
                    title: title,
                    preset: preset
                });

                $.post(wp.ajax.settings.url, request, function (response) {
                    $.jGrowl(response.message);

                    if (!response.error) {
                        window.location.href = response.url;
                    }

                    $container.dialog('close');
                    $container.find('#newGalleryAlert').hide();
                });

            }

            layers.text.show();
            layers.loader.hide();
        });
        $container.dialog({
            modal:    true,
            autoOpen: false,
            width: 750,
            height: 565,
            buttons:  {
                OK: function() {
                    submitGallery();
                },
                Cancel: function() {
                    $container.dialog('close');
                }
            },
            open: function (event, ui) {
                $(this).css({ height: 575 });
            }
        });

        $(document).keypress(function (e) {
            if (e.which == 13) {
                submitGallery();
            }
        });

        $(document).ready(function () {
            var $presets = $('.preset:not(.disabled)'),
                $field = $('#presetValue');

            $presets.first().addClass('active');

            $presets.on('click', function () {
                $presets.removeClass('active');
                $(this).addClass('active');

                $field.val($(this).data('preset'));
            });
        });

        $('.delete-gallery').on('click', function (e) {
            if (!confirm('Are you sure?')) {
                e.preventDefault();
            }
        });
    }

})(jQuery);
