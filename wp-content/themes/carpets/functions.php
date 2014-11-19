<?php
/**
 * Register our sidebars and widgetized areas.
 *
 */
function arphabet_widgets_init() {

	register_sidebar( array(
		'name' => 'Home right sidebar',
		'id' => 'home_right_1',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="rounded">',
		'after_title' => '</h3>',//border-bottom: 1px solid #bcbcbc
	) );
    register_sidebar( array(
		'name' => 'Home right sidebar',
		'id' => 'home_right_2',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="rounded">',
		'after_title' => '</h3>',//border-bottom: 1px solid #bcbcbc
	) );
}
add_action( 'widgets_init', 'arphabet_widgets_init' );

//function woocommerce_template_loop_product_thumbnail(){
//		global $post;
//
//		if ( has_post_thumbnail() )
//			return get_the_post_thumbnail( $post->ID, $size );
//		elseif ( wc_placeholder_img_src() )
//			return wc_placeholder_img( $size );
//}

/**
 * WooCommerce: show all product attributes listed below each item on Cart page
 */
function isa_woo_cart_attributes($cart_item, $cart_item_key){

    $item_data = $cart_item_key['data'];
    $attributes = $item_data->get_attributes();


    if ( ! $attributes ) {
        return $cart_item;
    }

    $out = $cart_item . '<br />';

    foreach ( $attributes as $attribute ) {

        if ( $attribute['is_taxonomy'] ) {

            // skip variations
            if ( $attribute['is_variation'] ) {
                continue;
            }

            // backwards compatibility for attributes which are registered as taxonomies

            $product_id = $item_data->id;
            $terms = wp_get_post_terms( $product_id, $attribute['name'], 'all' );

            // get the taxonomy
            $tax = $terms[0]->taxonomy;

            // get the tax object
            $tax_object = get_taxonomy($tax);

            // get tax label
            if ( isset ($tax_object->labels->name) ) {
                $tax_label = $tax_object->labels->name;
            } elseif ( isset( $tax_object->label ) ) {
                $tax_label = $tax_object->label;
            }

            foreach ( $terms as $term ) {
                $out .= '<span class="serial-no">';
                $out .= $tax_label . ': ';
                $out .= $term->name . '<span/>';
            }

        } else {

            // not a taxonomy

            $out .= '<span class="serial-no">'.$attribute['name'] . ': ';
            $out .= $attribute['value'] . '</span>';
        }
    }
    echo $out;
}

add_filter( 'woocommerce_cart_item_name', isa_woo_cart_attributes, 10, 2 );
?>