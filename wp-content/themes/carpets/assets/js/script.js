function languageclick(element)
{
    console.log(jQuery(element).find('span'));
}

(function($){
$(document).ready(function () {
    var categoryHtml = '';
    
    $( '.product' ).addClass('col');

    $( '.orderby' ).on('change', function () {
        $( '.woocommerce-ordering' ).submit();
    });

    var code = $( 'ul.products' ).html();

    if (code === undefined) {
        $( '#related_products_heading' ).remove();
        $( '#related_products' ).remove();
    }
    else {
        $( 'div.related' ).remove();
        $( '#related_products' ).html(code);
    }
    //console.log(code);

    code = $('div.images div.thumbnails').html();
    //console.log(code);

    var src = siteUrl + '/wp-content/plugins/woocommerce/assets/images/placeholder.png';
    if (code === undefined) {
        code = $( 'div.slide div.images' ).html();
        //console.log(code);
        $( 'div#product_images div.slide' ).html(code);
        $( 'div#product_images' ).append('<div class="slide"><img src="' + src + '" alt=""></div><div class="slide"><img src="' + src + '" alt=""></div><div class="slide"><img src="' + src + '" alt=""></div>');
        $( '#gallery_links' ).append('<li><a href="#"><img src="' + src + '" alt=""></a></li><li><a href="#"><img src="' + src + '" alt=""></a></li><li><a href="#"><img src="' + src + '" alt=""></a></li>');
        $( '#gallery_links li' ).first().html('<a href="#"><img src="' + src + '" alt=""></a>');
    }
    else {
        code = $( 'div.slide div.images a' ).html();
        //console.log(code);
        $( 'div#product_images div.slide' ).append('<div class="slide">' + code + '</div>');
        $( '#gallery_links li' ).first().html('<a href="#">' + code + '</a>');
        code = $( 'div.slide div.images div.thumbnails' ).html();
        //console.log(code);
        $( 'div.slide div.images div.thumbnails a.zoom' ).each(function () {
            code = $( this ).html();
            //console.log(code);
            $( 'div#product_images' ).append('<div class="slide">' + code + '</div>');
            $( '#gallery_links' ).append('<li><a href="#">' + code + '</a></li>');
        });
       $( 'div#product_images div.slide div.images' ).remove();
    }
    initCarousel();
    initOpenClose1();
    initOpenClose2();
    
    code = $( 'div.cart-collaterals tr.cart-subtotal span.amount' ).html();
    //console.log(code);
    if (code !== undefined){
        $( 'div.subtotal-area div.sub-wrap div.data span' ).first().html(code);
    }
    
    code = $( 'div.cart-collaterals tr.order-total span.amount' ).html();
    //console.log(code);
    if (code !== undefined){
        $( 'div.total-area div.sub-wrap div.data span' ).first().html('<strong>' + code + '</strong>');
    }
    
    $( 'form.checkout' ).on('mouseover', 'span.select-country_to_state', function(){ $( this ).css('width', '316px');});
    $( 'body' ).on('mouseover mouseout mousemove', 'div#wrapper', function(){ $( 'span.select-country_to_state' ).trigger('mouseover');});
    $( '.payment_method_paypal img' ).css('width', '70px');

    code = $( 'ul.product-categories' ).html();
    //console.log(code);
    if (code !== undefined){
        var html = '<div class="category_checkboxes">';
        $( 'ul.product-categories' ).children('li').each(function(i, obj){
            var text = $( this ).children('a').html();
            var href = $( this ).children('a').attr('href');
            html += '<div class="widget"><h4>' +text+ '</h4>';

            code = $( this ).children('ul').children('li').children('ul').children('li').html();
            if (code === undefined){
                html += '<ul class="check-list">';
                
                $( this ).children('ul').children('li').each(function(i, obj){
                    text = $( this ).children('a').html();
                    href = $( this ).children('a').attr('href');
                    html +=	'<li><input type="checkbox" value="'+href+ '">'+
                            '<label for="Pak">' +text+ '</label>';
                    html += '</li>';
                });
                
                html += '</ul>';
            }
            else{
                $( this ).children('ul').children('li').each(function(i, obj){
                    text = $( this ).children('a').html();
                    href = $( this ).children('a').attr('href');
                    html += '<div class="check-block"><div class="head-checkbox"><input type="checkbox" value="' +href+ '">'+
                        '<label for="classic">' +text+ '</label></div><ul class="check-list">';

                    $( this ).children('ul').children('li').each(function(i, obj){
                        text = $( this ).children('a').html();
                        href = $( this ).children('a').attr('href');
                        html +=	'<li><input type="checkbox" value="'+href+ '">'+
                                '<label for="Pak">' +text+ '</label>';

                        //Traverse here for more children in a common html structure with recursion
                        //$( this ).children('ul').children('li').each(function(i, obj){});
                        //console.log('LOADED----------------------------------------');
                        categoryHtml = '';
                        categoryHtml = makeSubCategories($( this ));
                        //console.log('L-----------------------------' + categoryHtml + '-------------------L');
                        html += categoryHtml;
                        html += '</li>';
                    });

                    html += '</ul></div>';
                });   
            }
            
            html += '</div>';
        });
        html += '</div>';
        $( 'ul.product-categories' ).replaceWith(html);
        
//        $( 'div.category_checkboxes' ).on('mouseover mouseenter mousemove mouseout mousedown mouseleave mouseup', 'div.chk-area', function(e){
//            if ($( this ).hasClass('chk-checked')){
//                $( this ).siblings('input').attr('checked', 'checked');
//                setCookie("selectedCategory", $( this ).siblings('input').val());
//                if (document.URL !== $( this ).siblings('input').val()){
//                    window.location.href = $( this ).siblings('input').val();
//                }
//            }
//        });
        $( 'div.category_checkboxes' ).on('change', 'input:checkbox', function(e){
            setCookie("selectedCategory", $( this ).val());
            if ($( this ).prop('checked')){
                if (document.URL !== $( this ).val()){
                    window.location.href = $( this ).val();
                }
            }
            else if (!$( this ).prop('checked')){
                window.location.href = siteUrl + '/shop';
            }
        });
    }
    
    code = $( '#searchform' ).parent('div').html();
    //console.log(code);
    if (code !== undefined){
        $( '#searchform' ).remove();
        $( '.search-form' ).replaceWith(code);
        $( '#searchform' ).addClass('search-form');
        $( '#searchform input' ).first().addClass('search');
        $( '#searchform label' ).first().remove();
        $( '#searchform input' ).first().attr('placeholder', 'SEARCH....');
    }
    
    code = $( 'nav.woocommerce-breadcrumb' ).html();
    //console.log(code);
    if (code !== undefined){
        var html = '<div class="breadcrumbs"><ul>';
        $( 'nav.woocommerce-breadcrumb' ).find('a').each(function(){
            html += '<li><a href="' +$( this ).attr('href')+ '">' +$( this ).html()+ '</a></li>';
        });
        var breadCrumbs = code.split('</a> /');
        html += '<li>' +breadCrumbs[breadCrumbs.length-1]+ '</li></ul></div>';
        $( '#main h2' ).first().replaceWith(html);
        
        $( 'nav.woocommerce-breadcrumb' ).remove();
    }
    
    $( 'div.select-wrap input' ).first().after('');
    $( 'div.select-wrap input' ).attr('style', 'width: 86px !important;');
    
    var width = '';
    var height = '';
    $( '.wp-post-image' ).each(function(i, obj){
            height = $( this ).attr('height');
            
           /* if (parseInt(height) < 150){
                $( this ).css('height', '161px');
            }*/
    });
    
    var categoryCookie = getCookie('selectedCategory');
    $( '.category_checkboxes li input' ).each(function(i, obj){
        if (categoryCookie !== false && categoryCookie !== ''){
            categoryCookie = categoryCookie.trim();
            if (categoryCookie === $( this ).val()){
                // Check if it is current URl then do not delete the cookie
                if (document.URL !== categoryCookie){
                    setCookie("selectedCategory", '');
                }
                else{
                    checkParentCategoriesCheckBoxes($( this ));
                }
            }
        }
    });
    
    $( '.woocommerce-result-count' ).after($( '.form-wppp-select' ));
    
    code = $( 'div.price_slider_wrapper' ).html();
    //console.log(code);
    if (code !== undefined){
        var form = $( 'div.price_slider_wrapper' ).parent('form');
        var min = $( '#min_price' ).data('min');
        var max = $( '#max_price' ).data('max');
        form.siblings('h3').remove();
        
        form.html(
            '<div class="leftLabel"></div><div class="rightLabel"></div>'+
            '<a href="javascript:" class="filter_price">Go</a>'+
            '<div class="nstSlider" data-range_min="0" data-range_max="' +max+ '" data-cur_min="0"  data-cur_max="' +max+ '">'+
                '<div class="highlightPanel"></div>'+
                '<div class="bar"></div>'+
                '<div class="leftGrip"></div>'+
                '<div class="rightGrip"></div>'+
                '<input type="hidden" id="min_price" name="min_price" value="" data-min="' +min+ '" placeholder="Min price">'+
                '<input type="hidden" id="max_price" name="max_price" value="" data-max="' +max+ '" placeholder="Max price">'+
            '</div>'
            
            );
            
//        form.parent('form').css('width', '70%');
    }
    
    $( '.filter_price' ).click(function(){
        $( this ).parent('form').submit();
    });

    function checkParentCategoriesCheckBoxes(obj){
        var code = obj.parent('li').html();
        if (code !== undefined){
            obj.prop('checked', true);
            obj.parent('li').parent('ul').siblings('input').prop('checked', true);
            obj.parent('li').parent('ul').siblings('div.head-checkbox').children('input').prop('checked', true);
            checkParentCategoriesCheckBoxes(obj.parent('li').parent('ul').siblings('input'));
        }
    }
    
    function makeSubCategories(obj){
        var html = '';
        var code = obj.children('ul').children('li').html();
        if (code !== undefined){
            html += '<ul class="check-list">';
            obj.children('ul').children('li').each(function(i, obj){
                var text = $( this ).children('a').html();
                var href = $( this ).children('a').attr('href');

                html +=	'<li><input type="checkbox" value="'+href+ '">'+
                        '<label for="Pak">' +text+ '</label>';

                html += makeSubCategories($( this ));
                html += '</li>';
            });
            html += '</ul>';
        }
        return html;
    }
    
    function writeCookie(key, value)
    {
        var now = new Date();
        now.setMonth( now.getMonth() + 1 ); 
        var cookievalue = value + ";"
        document.cookie = key + "=" + cookievalue;
        document.cookie = "expires=" + now.toUTCString() + ";"
        //alert("Setting Cookies : " + key + "=" + cookievalue );
    }

    function getCookie(Name){ 
            var re=new RegExp(Name+"=[^;]+", "i") //construct RE to search for target name/value pair
            if (document.cookie.match(re)) //if cookie found
                    return document.cookie.match(re)[0].split("=")[1] //return its value
            return false;
    }
    function setCookie(name, value){
            document.cookie = name + "=" + value + "; path=/"
    }

    function readCookie()
    {
        var allcookies = document.cookie;
        alert("All Cookies : " + allcookies );

        // Get all the cookies pairs in an array
        cookiearray  = allcookies.split(';');

        // Now take key value pair out of this array
        /*for(var i=0; i<cookiearray.length; i++){
            name = cookiearray[i].split('=')[0];
            value = cookiearray[i].split('=')[1];
            alert("Key is : " + name + " and Value is : " + value);
        }*/
    }

    function readSingleCookie(key)
    {
        var allcookies = document.cookie;
        //alert("All Cookies : " + allcookies );

        // Get all the cookies pairs in an array
        cookiearray  = allcookies.split(';');

        // Now take key value pair out of this array
        for(var i=0; i<cookiearray.length; i++){
            var name = cookiearray[i].split('=')[0];
            var value = cookiearray[i].split('=')[1];
            alert("Key is : " + name + " and Value is : " + value);
            if(name == key){
                return value;
            }
        }

        return false;
    }


    function deleteCookie(key)
    {
        var now = new Date();
        now.setMonth( now.getMonth() - 1 ); 
        var cookievalue = escape('') + ";"
        document.cookie=key + "=" + cookievalue;
        document.cookie = "expires=" + now.toUTCString() + ";"
//        alert("Deleting Cookies : " + key + "=" + cookievalue );
    }


    $(window).on('load',function(){
        $( '.goog-te-banner-frame').hide();
        var language_widget=jQuery('#primary-sidebar').find('#google_translate_element').html();
        jQuery('.panel').append('<div id="google_translate_carpets"></div>');
        $( '#google_translate_carpets').replaceWith($( '#google_translate_element' ));
        $( '#google_translate_element').hide();
        $('.lang ul').html('');
        $.each(jQuery('.goog-te-menu-frame').eq(0).contents().find('table td a'),function(k,v){

            var obj = $( this );
            $('.lang ul').append('<li><a href="javascript:">' + $(this).find('span').eq(1).html() + '</a></li>');
            $('.lang ul li').last().bind('click',function(){
                obj[0].click();
               $( '.goog-te-banner-frame').hide();
            });

        });

        $('.lang ul li').first().remove();
        jQuery('#header .panel .drop .list').css('width','150%');

        setTimeout(function(){
            $( '.scc_tooltip_settings' ).click(function(){jQuery(".scc_configpop").bPopup({closeClass:"scc_closeBtn"});});
            $( '.scc_settings_icon' ).remove();

            $( '.switch_currency' ).click(function(e){
                e.preventDefault();


                $( '#scc_currencySelect' ).val($( this ).attr('href'));
                $( '.scc_upd' ).click();
            });
        }, 1000);
    });
});
})(jQuery);