<?php

/**
 * This is an example module with only the basic
 * setup necessary to get it working.
 *
 * @class FLBasicExampleModule
 */
class FLBasicExampleModule extends FLBuilderModule {

    /** 
     * Constructor function for the module. You must pass the
     * name, description, dir and url in an array to the parent class.
     *
     * @method __construct
     */  
    public function __construct()
    {
        parent::__construct(array(
            'name'          => __('Basic Example', 'fl-builder'),
            'description'   => __('An basic example for coding new modules.', 'fl-builder'),
            'category'		=> __('Example Modules', 'fl-builder'),
            'dir'           => FL_MODULE_EXAMPLES_DIR . 'modules/basic-example/',
            'url'           => FL_MODULE_EXAMPLES_URL . 'modules/basic-example/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled'       => true, // Defaults to true and can be omitted.
        ));

         /**********************************************************************************
         * I want to get 'google_api_key' setting to build google map url with API key but it doesn't work
         * I get Notice: Undefined variable: settings on line 34
         * And Notice: Trying to get property of non-object on line 34
         **********************************************************************************/
         $google_api_key = (isset($settings->webdoone_google_api_key) ? $settings->webdoone_google_api_key : false);


        $url = 'https://maps.googleapis.com/maps/api/js';
        if( $google_api_key != false ) {
            $arr_params = array(
                'key' => $google_api_key
            );
            $url = esc_url( add_query_arg( $arr_params , $url ));
            $this->add_js( 'google-map', $url, array(), '', true );
        }
    }
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('FLBasicExampleModule', array(
    'general'       => array( // Tab
        'title'         => __('General', 'fl-builder'), // Tab title
        'sections'      => array( // Tab Sections
            'general'       => array( // Section
                'title'         => __('Section Title', 'fl-builder'), // Section Title
                'fields'        => array( // Section Fields
                    'webdoone_google_api_key'    => array(
                        'type'  => 'text',
                        'label'     => __('Google API key', 'bbgmap'),
                        'size'      => '50',
                        'preview'   => array(
                            'type'      => 'refresh'
                        )
                    ),
                )
            )
        )
    )
));