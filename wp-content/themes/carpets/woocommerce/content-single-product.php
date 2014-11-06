<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
		/**
		 * woocommerce_before_single_product_summary hook
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
//		do_action( 'woocommerce_before_single_product_summary' );
	?>

	<div class="summary entry-summary">
            <div class="thumbnails-holder">
                <div class="detail-holder">
                    <div class="head">
                        <strong class="serial-no"><?php woocommerce_template_single_price(); ?></strong>
                    </div>
                    <div class="detail-caption">
                        <p><?php woocommerce_template_single_excerpt(); ?></p>
                    </div>
                    <?php
                        /**
                         * woocommerce_after_single_product_summary hook
                         *
                         * @hooked woocommerce_output_product_data_tabs - 10
                         * @hooked woocommerce_upsell_display - 15
                         * @hooked woocommerce_output_related_products - 20
                         */
                        do_action( 'woocommerce_after_single_product_summary' );
                    ?>
		<?php
			/**
			 * woocommerce_single_product_summary hook
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 */
//			do_action( 'woocommerce_single_product_summary' );
                
//                        woocommerce_template_single_title();
                        woocommerce_template_single_rating();
//                        woocommerce_template_single_price(); // this will output the price text
//                        woocommerce_template_single_excerpt(); // this will output the short description of your product.
                        woocommerce_template_single_add_to_cart();
                        woocommerce_template_single_meta();
                        woocommerce_template_single_sharing();
		?>

                </div>
                        <div class="thumbnail-holder">
                        	<div class="slideshow">
                                    <div class="mask">
                                        <div class="slideset" id="product_images">
                                            <div class="slide">
                                                <?php do_action( 'woocommerce_before_single_product_summary' ); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pagination">
                                        <ul id="gallery_links">
                                            <li><a href="#"></a></li>
                                        </ul>
                                    </div>
                                    <?php $arr = wp_upload_dir(); ?>
                                    <input type="hidden" id="wp_upload_dir" value="<?php echo $arr['url']; ?>">

	</div><!-- .summary -->
        </div>
        </div>
        <strong id="related_products_heading" class="sub-title">YOU MIGHT ALSO LIKE THIS</strong>
        <div class="col-details" id="related_products"></div>

	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
