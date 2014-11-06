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
?>