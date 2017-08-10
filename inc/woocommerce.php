<?php
/**
 * SiteEditor Shop WooCommerce class
 *
 * @package SiteEditor
 * @subpackage theme
 * @since 1.0.0
 */

/**
 * SiteEditor Shop WooCommerce class.
 *
 * SiteEditor Shop WooCommerce is for sync with WooCommerce Plugin & their Extensions
 *
 * @since 1.0.0
 */

class SedShopWooCommerce{

    /**
     * @since 1.0.0
     * @var array
     * @access protected
     */
    //protected $theme_options = array();

    /**
     * SedShopWooCommerce constructor.
     */
    public function __construct(  ) { 

        $this->remove_breadcrumb();



    }

    public function remove_breadcrumb(){

        //remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

    }


}

new SedShopWooCommerce();

/**
 * Woocommerce Single Product Module class.
 *
 * Add Options
 *
 * @since 1.0.0
 */

class SedShopWoocommerceSingleProductModule{

    /**
     * SedShopWoocommerceSingleProduct constructor.
     */
    public function __construct(){

        $this->remove_default_hooks();

        $this->add_heading_part();

        $this->add_summary_part();

        $this->add_price_part();

        $this->remove_upsell_related_products();

        add_filter( "woocommerce_product_thumbnails_columns" , array( __CLASS__ , "get_thumbnails_columns" ) );

    }

    /**
     * Remove WooCommerce Default Hooks
     */
    public function remove_default_hooks(){

        //remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
        //remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
        //remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
        //remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
        //remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
        //remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
        //remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

    }

    public function add_heading_part(){

        //add_action( 'sed_shop_single_product_heading_left', 'woocommerce_template_single_title', 5 );

        //add_action( 'sed_shop_single_product_heading_right', 'woocommerce_template_single_rating', 10 );

    }

    public function add_summary_part(){

        //add_action( 'woocommerce_after_single_product_summary', 'woocommerce_template_single_excerpt' , 4 );

    }

    public function add_price_part(){

        //add_action( 'sed_shop_single_product_price', 'woocommerce_template_single_price' , 10 );

        //add_action( 'sed_shop_single_product_price', 'woocommerce_template_single_add_to_cart' , 15 );

    }


    public static function get_thumbnails_columns( $columns ){

        return 3;

    }

    public function remove_upsell_related_products(){

        //remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );

        remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

    }

}

new SedShopWoocommerceSingleProductModule();

/**
 * Woocommerce Single Product Module class.
 *
 * Add Options
 *
 * @since 1.0.0
 */

class SedShopWoocommerceArchiveModule{

    /**
     * SedShopWoocommerceSingleProduct constructor.
     */
    public function __construct(){

        add_filter( 'loop_shop_per_page'                , array( __CLASS__ , 'loop_shop_per_page' ) , 9999 );

        add_filter( 'loop_shop_columns'                 , array( __CLASS__ , 'loop_columns' ) , 9999 );

        add_filter( 'woocommerce_show_page_title'       , array( __CLASS__ , 'remove_page_title' ) , 9999  );

        remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_result_count' , 20 );

        remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_catalog_ordering' , 30 );

        //add_filter( 'sed_shop_before_shop_loop'         , 'woocommerce_pagination' , 10  );

        $this->set_content_product();

    }

    public static function loop_shop_per_page( $per_page ) {

        $per_page = 12;

        return $per_page;
    }

    public static function loop_columns( $columns ) {

        $columns = 4;

        return $columns;
    }

    public static function remove_page_title( $show_title ){

        $show_title = !$show_title ? $show_title : false;

        return $show_title;

    }

    public function set_content_product(){

        remove_action( 'woocommerce_after_shop_loop_item_title' , 'woocommerce_template_loop_rating' , 5 );

        //remove_action( 'woocommerce_after_shop_loop_item_title' , 'woocommerce_template_loop_price' , 10 );

        remove_action( 'woocommerce_after_shop_loop_item' , 'woocommerce_template_loop_add_to_cart' , 10 );

        add_action( 'woocommerce_after_shop_loop_item' , array( __CLASS__ , 'add_more_detail' ) , 10 );

        //add_action( 'woocommerce_shop_loop_item_title' , array( __CLASS__ , 'add_sub_title' ) , 15 );

    }

    public static function add_sub_title(){

        wc_get_template( 'loop/sub_title.php' );

    }

    public static function add_more_detail(){

        ?>

        <a rel="nofollow" href="<?php get_permalink();?>" class="button tanin-more-details-button">
            <?php echo __("More Details" , "tanin" );?>
        </a>

        <?php

    }

}

new SedShopWoocommerceArchiveModule();

/**
 * Woocommerce My Account Module class.
 *
 * Add Options
 *
 * @since 1.0.0
 */
class sedShopWoocommerceMyAccountModule{

    /**
     * sedShopWoocommerceMyAccountModule constructor.
     */
    function __construct(){

        //remove_action( 'woocommerce_account_navigation', 'woocommerce_account_navigation' );

        //add_filter( 'sed_shop_show_login_form_account_page' , array( __CLASS__ , 'show_login_form' ) , 100 , 1 );

        //add_filter( "sed_theme_options_panels_filter" , array( $this , 'register_theme_panels' ) , 100 );

        //add_filter( "sed_theme_options_fields_filter" , array( $this , 'register_theme_fields' ) );

        //add_filter( "woocommerce_process_registration_errors" , array( $this , "validation_error" ) , 100 , 1 );

    }

    public static function show_login_form( $show ){

        $show = false;

        return $show;

    }

    public function register_theme_panels( $panels ){

        $panels['woocommerce_settings'] =  array(
            'type'                  => 'inner_box',
            'title'                 => __('Woocommerce Settings', 'site-editor'),
            'capability'            => 'edit_theme_options' ,
            'priority'              => 50 ,
            'btn_style'             => 'menu' ,
            'has_border_box'        => false ,
            'icon'                  => 'sedico-current-post-customize' ,
            'field_spacing'         => 'sm'
        );

        return $panels;

    }

    /**
     * Register Theme Fields
     */
    public function register_theme_fields( $fields ){

        $fields['woocommerce_user_register_messages'] = array(
            'setting_id'        => 'sed_woocommerce_user_register_messages',
            'label'             => __('User Register Messages', 'site-editor'),
            'description'       => __( 'Show guide Message for users in register form.' , 'site-editor' ),
            'type'              => 'wp-editor',
            'default'           => '',
            'option_type'       => 'theme_mod',
            'transport'         => 'postMessage' ,
            'panel'             => 'woocommerce_settings',
        );

        return $fields;

    }

    public function validation_error( $validation_error ){

        if ( $validation_error->get_error_code() ) {

            return $validation_error;

        }

        if( !isset( $_POST['terms'] ) || $_POST['terms'] != "on" ) {

            return new WP_Error( 'signup_terms_error' , __( 'You must accept term of services if you want to join us.' , 'sed-shop' ) );

        }


        return $validation_error;

    }


}

new sedShopWoocommerceMyAccountModule();

/**
 * Woocommerce New Shortcodes
 *
 * Add New Shortcodes For WooCommerce
 *
 * @since 1.0.0
 */

class SedShopWoocommerceShortcodes{

    /**
     * SedShopWoocommerceShortcodes constructor.
     */
    public function __construct(){

        add_shortcode( 'sed_woocommerce_login', array( __CLASS__ , 'login' ) );

        add_shortcode( 'sed_woo_user_profile', array( __CLASS__ , 'user_profile' ) );
        
    }

    public static function login( $atts ) {

        $defaults = array(
            'message'  => '',
            'redirect' => wc_get_page_permalink( 'myaccount' ),
            'hidden'   => false,
        );

        $atts = shortcode_atts( $defaults , $atts );

        ob_start();

        wc_print_notices();

        woocommerce_login_form( $atts );

        return ob_get_clean();

    }

    public static function user_profile( $atts ) {

        $current_user = wp_get_current_user();

        $user_name = (!empty($current_user->user_firstname) && !empty($current_user->user_lastname)) ? $current_user->user_firstname . " " . $current_user->user_lastname : $current_user->display_name;

        $user_name = ( empty( $user_name ) ) ? $current_user->user_login : $user_name;

        ob_start();

        ?>
        <div class="user_profile_info_module">

            <ul>

                <li>

                    <a class="title">
                        <h3><?php echo $user_name;?></h3>
                    </a>

                </li>

                <li>
                    <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) );?>"><?php echo __("My Profile" , "sed-shop");?></a>
                </li>

                <li>
                    <a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-account' , '' , wc_get_page_permalink( 'myaccount' ) ) );?>"><?php echo __("Change Password" , "sed-shop");?></a>
                </li>

                <li>
                    <a href="<?php echo esc_url( wc_logout_url( wc_get_page_permalink( 'myaccount' ) ) );?>"><?php echo __( 'Logout', 'woocommerce' );?></a>
                </li>

            </ul>

        </div>

        <?php

        return ob_get_clean();

    }

}

new SedShopWoocommerceShortcodes();