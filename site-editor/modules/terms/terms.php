<?php
/*
Module Name: Terms
Module URI: http://www.siteeditor.org/modules/terms
Description: Module Terms For Page Builder Application
Author: Site Editor Team
Author URI: http://www.siteeditor.org
Version: 1.0.0
*/

/**
 * Class PBTermsShortcode
 */
class PBTermsShortcode extends PBShortcodeClass{

    /**
     * Register module with siteeditor.
     */
    function __construct() {

        parent::__construct( array(
                "name"        => "sed_terms",                               //*require
                "title"       => __("Terms","site-editor"),                 //*require for toolbar
                "description" => __("List of terms for built-in and custom taxonomies","site-editor"),
                "icon"        => "icon-terms",                               //*require for icon toolbar
                "module"      =>  "terms"         //*require
                //"is_child"    =>  "false"       //for childe shortcodes like sed_tr , sed_td for table module
            ) // Args
        );

    }

    function get_atts(){

        $atts = array(
            'show_title'                => true,
            'title'                     => '',
            'excerpt_length'            => 50,
            "taxonomy"                  => '',
            'parent_term'               => 0 ,
            'level_type'                => 'all' , //"all" or "top"
            "images_size"               => 'thumbnail'
        );

        return $atts;

    }

    function add_shortcode( $atts , $content = null ){

        extract( $atts );

        $terms = array();

        if( !empty( $taxonomy ) ){

            $args = array(
                'taxonomy'          => $taxonomy,
                'hide_empty'        => false
            );

            if( !empty( $parent_term ) ){

                $parent = $parent_term;

                if( $level_type == "all" ){

                    $args['child_of'] = $parent;

                }else if( $level_type == "top" ){

                    $args['parent'] = $parent;

                }

            }

            $terms = get_terms( $args );

        }

        $this->set_vars( array( "terms" => $terms ) );

    }
    
    function styles(){
        return array(
            array('terms-skin-default', get_stylesheet_directory_uri().'/site-editor/modules/terms/skins/default/css/style.css' ,'1.0.0' ) ,
        );
    }

    function shortcode_settings(){

        $this->add_panel( 'terms_settings_panel' , array(
            'title'               =>  __('Terms Settings',"site-editor")  ,
            'capability'          => 'edit_theme_options' ,
            'type'                => 'inner_box' ,
            'priority'            => 9 ,
            'btn_style'           => 'menu' ,
            'has_border_box'      => false ,
            'icon'                => 'sedico-setting' ,
            'field_spacing'       => 'sm'
        ) );

        $params = array();

        $params['images_size'] = array(
            "type"          => "image-size" ,
            "label"         => __("Image Size Field", "site-editor"),
            "description"   => __("This option allows you to set a title for your image.", "site-editor"),
            "panel"         => "terms_settings_panel" ,
        );

        $params['show_title'] = array(
            'label'             => __('Show Title', 'site-editor'),
            'type'              => 'switch',
            'choices'           => array(
                "on"       =>    "ON" ,
                "off"      =>    "OFF" ,
            ),
            "panel"         => "terms_settings_panel" ,
        );

        $params['title'] = array(
            "type"              => "text" ,
            "label"             => __("Title", "site-editor"),
            "description"       => __("Module Title", "site-editor"),
            "placeholder"       => __("Enter Module Title", "site-editor"),
            "panel"             => "terms_settings_panel",
            'dependency'    => array(
                'queries'  =>  array(
                    array(
                        "key"       => "show_title" ,
                        "value"     => true ,
                        "compare"   => "==="
                    )
                )
            )
        );

        $params['excerpt_length'] = array(
            "type"          => "number" ,
            "label"         => __("Excerpt Length", "site-editor"),
            "description"   => __("Excerpt Length", "site-editor"),
            "js_params"     =>  array(
                "min"  =>  10 ,
            ),
            "panel"         => "terms_settings_panel"
        );

        $args = array(
            'public'   => true,
            //'_builtin' => true
        );

        $output = 'objects';
        $taxonomies = get_taxonomies( $args, $output );

        $taxonomies_choices = array( '' => __("Select Taxonomy" , "site-editor") );

        foreach ( $taxonomies  as $taxonomy ) {

            $taxonomies_choices[$taxonomy->name] = $taxonomy->labels->name;

        }

        $params['taxonomy'] = array(
            "type"          => "select" ,
            "label"         => __("Select Taxonomy", "site-editor"),
            "description"   => __("Select Taxonomy", "site-editor"),
            "choices"       => $taxonomies_choices,
            "panel"         => "terms_settings_panel" ,
        );

        foreach ( $taxonomies  as $taxonomy ) {

            $terms = get_terms( array(
                'taxonomy' => $taxonomy->name,
                'hide_empty' => false,
            ) );

            $terms_choices = array();

            $terms_choices[0] = __("Select term" , "site-editor");

            if( !empty( $terms ) && is_array( $terms ) ) {

                foreach ( $terms as $term ) {

                    $terms_choices[$term->term_id] = $term->name;

                }

            }

            $params[$taxonomy->name . '_parent_term'] = array(
                "type"          => "select" ,
                "label"         => __("Parent Term", "site-editor"),
                "description"   => __("Parent Term", "site-editor"),
                "choices"       => $terms_choices,
                "is_attr"       => true ,
                "attr_name"     => "parent_term",
                "panel"         => "terms_settings_panel",
                'dependency'    => array(
                    'queries'  =>  array(
                        array(
                            "key"       => "taxonomy" ,
                            "value"     => $taxonomy->name ,
                            "compare"   => "=="
                        )
                    )
                )
            );

        }

        $params['skin'] = array(
            "type"                => "skin" ,
            "label"               => __("Change skin", "site-editor"),
            'button_style'        => 'menu' ,
            'has_border_box'      => false ,
            'icon'                => 'sedico-change-skin' ,
            'field_spacing'       => 'sm' ,
            'priority'            => 540
        );

        $params['animation'] =  array(
            "type"                => "animation" ,
            "label"               => __("Animation Settings", "site-editor"),
            'button_style'        => 'menu' ,
            'has_border_box'      => false ,
            'icon'                => 'sedico-animation' ,
            'field_spacing'       => 'sm' ,
            'priority'            => 530 ,
        );

        $params['row_container'] = array(
            'type'          => 'row_container',
            'label'         => __('Module Wrapper Settings', 'site-editor')
        );

        return $params;

    }

}

new PBTermsShortcode();

global $sed_pb_app;                      

$sed_pb_app->register_module(array(
    "group"                 =>  "basic" ,
    "name"                  =>  "terms",
    "title"                 =>  __("Terms","site-editor"),
    "description"           =>  __("List of terms for built-in and custom taxonomies","site-editor"),
    "icon"                  =>  "icon-terms",
    "type_icon"             =>  "font",
    "shortcode"             =>  "sed_terms",
    //"priority"              =>  10 ,
    "transport"             =>  "ajax" ,
));


