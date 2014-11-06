if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) 
    exit();




delete_option( 'scc_currency_options' );
delete_option( 'scc_theme_options' );
delete_option( 'scc_misc_options' );
delete_option( 'scc_adv_options' );
delete_option( 'scc_popup_options' );
delete_option( 'scc_exrate_options' );

