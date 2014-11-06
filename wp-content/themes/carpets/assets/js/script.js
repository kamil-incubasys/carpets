(function($){
$(document).ready(function () {
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
    console.log(code);

    code = $('div.images div.thumbnails').html();
    console.log(code);

    var src = 'http://localhost/carpets/wp-content/plugins/woocommerce/assets/images/placeholder.png';
    if (code === undefined) {
        code = $( 'div.slide div.images' ).html();
        console.log(code);
        $( 'div#product_images div.slide' ).html(code);
        $( 'div#product_images' ).append('<div class="slide"><img src="' + src + '" alt=""></div><div class="slide"><img src="' + src + '" alt=""></div><div class="slide"><img src="' + src + '" alt=""></div>');
        $( '#gallery_links' ).append('<li><a href="#"><img src="' + src + '" alt=""></a></li><li><a href="#"><img src="' + src + '" alt=""></a></li><li><a href="#"><img src="' + src + '" alt=""></a></li>');
        $( '#gallery_links li' ).first().html('<a href="#"><img src="' + src + '" alt=""></a>');
    }
    else {
        code = $( 'div.slide div.images a' ).html();
        console.log(code);
        $( 'div#product_images div.slide' ).append('<div class="slide">' + code + '</div>');
        $( '#gallery_links li' ).first().html('<a href="#">' + code + '</a>');
        code = $( 'div.slide div.images div.thumbnails' ).html();
        console.log(code);
        $( 'div.slide div.images div.thumbnails a.zoom' ).each(function () {
            code = $( this ).html();
            console.log(code);
            $( 'div#product_images' ).append('<div class="slide">' + code + '</div>');
            $( '#gallery_links' ).append('<li><a href="#">' + code + '</a></li>');
        });
       $( 'div#product_images div.slide div.images' ).remove();
    }
    initCarousel();
    
    code = $( 'div.cart-collaterals tr.cart-subtotal span.amount' ).html();
    console.log(code);
    if (code !== undefined){
        $( 'div.subtotal-area div.sub-wrap div.data span' ).first().html(code);
    }
    
    code = $( 'div.cart-collaterals tr.order-total span.amount' ).html();
    console.log(code);
    if (code !== undefined){
        $( 'div.total-area div.sub-wrap div.data span' ).first().html('<strong>' + code + '</strong>');
    }
    
    $( 'form.checkout' ).on('mouseover', 'span.select-country_to_state', function(){ $( this ).css('width', '316px');});
    $( 'body' ).on('mouseover mouseout mousemove', 'div#wrapper', function(){ $( 'span.select-country_to_state' ).trigger('mouseover');});
    $( '.payment_method_paypal img' ).css('width', '70px');

    code = $( 'ul.product-categories' ).html();
    console.log(code);
    if (code !== undefined){
        var html = '<div class="category_checkboxes">';
        $( 'ul.product-categories' ).children('li').each(function(i, obj){
            var text = $( this ).children('a').html();
            var href = $( this ).children('a').attr('href');
            html += '<div class="widget"><h4>' +text+ '</h4>';

            $( this ).children('ul').children('li').each(function(i, obj){
                text = $( this ).children('a').html();
                href = $( this ).children('a').attr('href');
                html += '<div class="check-block"><div class="head-checkbox"><input type="checkbox" value="' +href+ '">'+
                '<label for="classic">' +text+ '</label></div><ul class="check-list">';

                $( this ).children('ul').children('li').each(function(i, obj){
                    text = $( this ).children('a').html();
                    href = $( this ).children('a').attr('href');

                    html +=	'<li><input type="checkbox" value="'+href+ '">'+
                            '<label for="Pak">' +text+ '</label></li>';

                    //Traverse here for more children in a common html structure with recursion
                    //$( this ).children('ul').children('li').each(function(i, obj){});
                });

                html += '</ul></div>';
            });

            html += '</div>';
        });
        html += '</div>';
        $( 'ul.product-categories' ).replaceWith(html);
        
        $( 'div.category_checkboxes' ).on('mouseover mouseenter mousemove mouseout mousedown mouseleave mouseup', 'div.chk-area', function(e){
            if ($( this ).hasClass('chk-checked')){
                $( this ).siblings('input').attr('checked', 'checked');
                window.location.href = $( this ).siblings('input').val();
            }
        });
    }
    
    code = $( '#searchform' ).parent('div').html();
    console.log(code);
    if (code !== undefined){
        $( '#searchform' ).remove();
        $( '.search-form' ).replaceWith(code);
        $( '#searchform' ).addClass('search-form');
        $( '#searchform input' ).first().addClass('search');
        $( '#searchform label' ).first().remove();
        $( '#searchform input' ).first().attr('placeholder', 'SEARCH....');
    }
    
    code = $( 'nav.woocommerce-breadcrumb' ).html();
    console.log(code);
    if (code !== undefined){
        
//        			<div class="breadcrumbs">
//				<ul>
//					<li><a href="#">Home</a></li>
//					<li><a href="#">Collections</a></li>
//					<li><a href="#">Tribal</a></li>
//					<li>Kashan</li>
//				</ul>
//			</div>
        $( '#main h2' ).first().replaceWith('<h2>' +code+ '</h2>');
        code = $( 'nav.woocommerce-breadcrumb' ).remove();
    }
    
    $( 'div.select-wrap input' ).first().after('<label for="quantity-select">Quantity</label>');
    $( 'div.select-wrap input' ).attr('style', 'width: 46px !important;');
    
    var width = '';
    var height = '';
    $( '.wp-post-image' ).each(function(i, obj){
            height = $( this ).attr('height');
            
            if (parseInt(height) < 150){
                $( this ).css('height', '161px');
            }
    });
});
})(jQuery);