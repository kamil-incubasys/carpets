<?php
/**
 * Cart Page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

<form action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">

<?php do_action( 'woocommerce_before_cart_table' ); ?>

<!--<table class="shop_table cart" cellspacing="0">
	<thead>
		<tr>
			<th class="product-remove">&nbsp;</th>
			<th class="product-thumbnail">&nbsp;</th>
			<th class="product-name"><?php _e( 'Product', 'woocommerce' ); ?></th>
			<th class="product-price"><?php _e( 'Price', 'woocommerce' ); ?></th>
			<th class="product-quantity"><?php _e( 'Quantity', 'woocommerce' ); ?></th>
			<th class="product-subtotal"><?php _e( 'Total', 'woocommerce' ); ?></th>
		</tr>
	</thead>
	<tbody>-->
    <div class="shoping-holder">
		<?php do_action( 'woocommerce_before_cart_contents' ); ?>

		<?php
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				?>
				<div class="item-holder <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

                                    <div class="item-wrap">
                                        <div class="image-area product-thumbnail">
                                                <?php
							$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

							if ( ! $_product->is_visible() )
								echo $thumbnail;
							else
								printf( '<a href="%s">%s</a>', $_product->get_permalink(), $thumbnail );
						?>
                                        </div>
                                        <div class="detail-area">
                                	<ul>
                                    	<li class="item">
                                            <div class="head-area">
                                            	<strong class="title product-name">ITEM NAME</strong>
                                                <span class="serial-no">
                                                    <?php
							if ( ! $_product->is_visible() )
								echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
							else
								echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', $_product->get_permalink(), $_product->get_title() ), $cart_item, $cart_item_key );

							echo '<pre>';

//                                                    print_r($_product);
                                                    ?>
							<?php // Meta data
//							echo WC()->cart->get_item_data( $cart_item );
//                                                    die(WC()->cart->get_item_data( $cart_item ));

                                                        // Backorder notification
                                                        if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) )
                                                        echo '<p class="backorder_notification">' . __( 'Available on backorder', 'woocommerce' ) . '</p>';
                                                    ?>
                                                </span>
                                            </div>
                                        </li>
                                        <li class="unit-price product-price">
                                        	<div class="head-area">
                                            	<strong class="title">price</strong>
                                            </div>
                                            <span class="data-list">						
                                                <?php
                                                    echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
						?>
                                            </span>
                                        </li>
                                        <li class="quantity product-quantity">
                                            <div class="head-area">
                                            	<strong class="title">quantity</strong>
                                            </div>
                                            <?php
                                                    if ( $_product->is_sold_individually() ) {
                                                            $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                                                    } else {
                                                            $product_quantity = woocommerce_quantity_input( array(
                                                                    'input_name'  => "cart[{$cart_item_key}][qty]",
                                                                    'input_value' => $cart_item['quantity'],
                                                                    'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
                                                                    'min_value'   => '0'
                                                            ), $_product, false );
                                                    }

                                                    echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
                                            ?>
                                        </li>
                                        <li class="t-price product-subtotal">
                                        	<div class="head-area">
                                            	<strong class="title">Total</strong>
                                            </div>
                                            <span>
                                                <?php
                                                    echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
						?>
                                            </span>
                                        </li>
                                        </ul>
                                            <div class="cross">
                                                <?php
                                                        echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="remove" title="%s">&times;</a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'woocommerce' ) ), $cart_item_key );
                                                ?>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
				<?php
			}
		}

		do_action( 'woocommerce_cart_contents' );
		?>
                    <div class="subtotal-area" style="border-bottom: 0;padding: 0 0 15px;">
                    	<div class="sub-wrap">
                        	<div class="title">
                            	<strong>SUBTOTAL</strong>
                            </div>
                            <div class="data">
                            	<span>$ 7,675.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="subtotal-area total-area">
                    	<div class="sub-wrap">
                            <div class="title">
                            	<strong>TOTAL</strong>
                            </div>
                            <div class="data">
                            	<span style="margin-left: 42px;">$7,675.00</span>
                                <span style="margin-left: 42px;">Excluding tax &amp; shipping</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="update-total">
                    	<div class="sub-wrap">
                                <?php if ( WC()->cart->coupons_enabled() ) { ?>
                                    <div class="title">
					<div class="coupon">

						<label for="coupon_code"><?php _e( 'Coupon', 'woocommerce' ); ?>:</label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php _e( 'Coupon code', 'woocommerce' ); ?>" /> <input type="submit" class="button" name="apply_coupon" value="<?php _e( 'Apply Coupon', 'woocommerce' ); ?>" />

						<?php do_action('woocommerce_cart_coupon'); ?>

					</div>
                                    </div>
				<?php } ?>
                            <div class="title">

                                <input type="submit" class="button check-btn checkout-button button alt wc-forward" name="update_cart" value="<?php _e( 'Update Cart', 'woocommerce' ); ?>" />
                            </div>
                            <div class="data">
                                <input type="submit" class="check-btn checkout-button button alt wc-forward" name="proceed" value="<?php _e( 'Proceed to Checkout', 'woocommerce' ); ?>" />
                                <?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
                                <?php do_action( 'woocommerce_proceed_to_checkout' ); ?>

				<?php wp_nonce_field( 'woocommerce-cart' ); ?>
                                <!--<a class="check-btn">CHECKOUT</a>-->
                            </div>
                            
                        </div>
                    </div>

		<?php do_action( 'woocommerce_after_cart_contents' ); ?>
<!--	</tbody>
</table>-->

<?php do_action( 'woocommerce_after_cart_table' ); ?>

</form>

<div class="cart-collaterals">

	<?php do_action( 'woocommerce_cart_collaterals' ); ?>

	<div style="display: none;"><?php woocommerce_cart_totals(); ?></div>

	<?php woocommerce_shipping_calculator(); ?>

</div>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
