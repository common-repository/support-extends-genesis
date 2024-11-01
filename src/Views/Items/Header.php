<?php
namespace GS\GSViews\GSItems;

use GS\GSViews\GsItems as GsItems;

/**
 * Create header submenu page
 * 
 * @uses Views\Items
 * @since 1.0.0
 */

if (!class_exists('GsHeader')) {
	class GsHeader extends GsItems
	{        
		/**
		 * Initilize
		 */
		public function __construct()
		{
			$this->defineOption('GSPL_HEADER', 'header_options');
            $this->page_id = 'gsheader';
            $this->menu_ops = array(
                'submenu' => array(
                	'parent_slug' => '',
                    'page_title' => 'Header',
                    'menu_title' => 'Header',
                    'capability' => 'edit_theme_options',
                )
            );
			$this->default_settings = array(
				//req header upload
				'req_header_upload' => 0,
				'favicon' => '',
				'req_header_bg' => 0,
				'headerbg_color' => '',
				'headerbg' => '',
				'bgrepeat' => 'no-repeat',
				'bgposition' => 'top left',
				'req_header_settings' => 0,
				'height' => 80,
			);
            $this->settings_field = GSPL_HEADER;
            parent::__construct();
            $this->createRequest('header', GSPL_HEADER);
		}

		/**
		 * render form
		 */
		public function form()
		{
			$this->getFormDetail('form_header');
		}

	}// end class
} else {
	wp_die(__('This class is existed'));
}