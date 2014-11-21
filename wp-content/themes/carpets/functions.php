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


add_shortcode( 'featured_product_categories', 'jc_featured_products' );
function jc_featured_products($atts){
    $cats = explode(',', $atts['cats']);
    
    //$terms = get_term_by('id', 31, 'product_cat');
    //$args = array( 'taxonomy' => 'product_cat' );
    //$terms = get_terms('product_cat', $args);
    $count = count($cats); 
    if ($count > 0) {

        for ($i = 0 ; $i < $count;$i++) {
            
                $term = get_term_by('id', $cats[$i], 'product_cat');
            	do_action( 'woocommerce_before_subcategory', $term ); ?>
        <div class="img-hold">
	<a href="<?php echo get_term_link( $term->slug, 'product_cat' ); ?>">
                
		<?php
			/**
			 * woocommerce_before_subcategory_title hook
			 *
			 * @hooked woocommerce_subcategory_thumbnail - 10
			 */
			do_action( 'woocommerce_before_subcategory_title', $term );
		?>

                <span class="caption">
                    <?php
                            echo $term->name;
                    ?>
                </span>

		<?php
			/**
			 * woocommerce_after_subcategory_title hook
			 */
			do_action( 'woocommerce_after_subcategory_title', $term );
		?>
	</a>
        </div>

	<?php do_action( 'woocommerce_after_subcategory', $term ); 
        }

    }
}
?>