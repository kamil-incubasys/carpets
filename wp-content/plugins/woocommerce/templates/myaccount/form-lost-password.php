<?php
/**
 * Lost password form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<?php wc_print_notices(); ?>
<section id="content">
<form method="post" class="form lost_reset_password">

	<?php if( 'lost_password' == $args['form'] ) : ?>

        <p class="red"><?php echo apply_filters( 'woocommerce_lost_password_message', __( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'woocommerce' ) ); ?></p>

        <!--<p class="form-row form-row-first"><label for="user_login"><?php _e( 'Username or email', 'woocommerce' ); ?></label> <input class="input-text" type="text" name="user_login" id="user_login" /></p>-->
        <div class="col">
                <div class="left">
                    <input class="input-text" type="text" name="user_login" id="user_login" placeholder="Username or email" />
                </div>
        </div>
	<?php else : ?>

        <p><?php echo apply_filters( 'woocommerce_reset_password_message', __( 'Enter a new password below.', 'woocommerce') ); ?></p>
<!--
        <p class="form-row form-row-first">
            <label for="password_1"><?php _e( 'New password', 'woocommerce' ); ?> <span class="required">*</span></label>
            <input type="password" class="email" name="password_1" id="password_1" />
        </p>
        <p class="form-row form-row-last">
            <label for="password_2"><?php _e( 'Re-enter new password', 'woocommerce' ); ?> <span class="required">*</span></label>
            <input type="password" class="input-text" name="password_2" id="password_2" />
        </p>-->

        <div class="col">
                <div class="left">
                    <input type="password" class="email" name="password_1" id="password_1" placeholder="Password*" />
                </div>
        </div>

        <div class="col">
                <div class="left">
                    <input type="password" class="input-text" name="password_2" id="password_2" placeholder="Re-enter Password*" />
                </div>
        </div>

        <input type="hidden" name="reset_key" value="<?php echo isset( $args['key'] ) ? $args['key'] : ''; ?>" />
        <input type="hidden" name="reset_login" value="<?php echo isset( $args['login'] ) ? $args['login'] : ''; ?>" />

    <?php endif; ?>

    <div class="clear"></div>
    <div class="col">
            <div class="left">
                <input type="submit" class="button" name="wc_reset_password" value="<?php echo 'lost_password' == $args['form'] ? __( 'Reset Password', 'woocommerce' ) : __( 'Save', 'woocommerce' ); ?>" />
            </div>
    </div>
    <!--<p class="form-row"><input type="submit" class="button" name="wc_reset_password" value="<?php echo 'lost_password' == $args['form'] ? __( 'Reset Password', 'woocommerce' ) : __( 'Save', 'woocommerce' ); ?>" /></p>-->
	<?php wp_nonce_field( $args['form'] ); ?>

</form>
    </section>
<script type="text/javascript">
    jQuery('#reg_passmail').html('');
    jQuery('#reg_passmail').append('<div class="col"></div>');
</script>