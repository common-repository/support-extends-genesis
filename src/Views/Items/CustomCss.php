<?php
namespace GS\GSViews\GSItems;

use GS\GSViews\GsItems as GsItems;

/**
 * Create header submenu page
 * 
 * @uses Views\Items
 * @since 1.0.0
 */

if (!class_exists('GsCustomCss')) {
	final class GsCustomCss extends GsItems
	{   
		/**
		 * Initilize
		 */
		public function __construct()
		{
			$this->defineOption('GSPL_CUSTOMCSS', 'customcss_options');
            $this->page_id = 'gscustomcss';
            $this->menu_ops = array(
                'submenu' => array(
                	'parent_slug' => '',
                    'page_title' => 'Custom CSS',
                    'menu_title' => 'Custom CSS',
                    'capability' => 'edit_theme_options',
                )
            );
            $this->settings_field = GSPL_CUSTOMCSS;
			$this->default_settings = array(
				'req_customcss' => 0,
				'custom_css' => '',
			);
            parent::__construct();
            $this->createRequest('customcss', GSPL_CUSTOMCSS);
		}

		/**
		 * redeclared parent method
		 */
		public function form()
		{
			$this->getFormDetail('custom_css');
		}

	}// end class
} else {
	wp_die(__('This class is existed'));
}