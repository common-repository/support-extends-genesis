<?php
namespace GS\GSViews\GSItems;

use GS\GSViews\GsItems as GsItems;
use GS\GSViews\GSItems\GsPageTitleBar as GsPageTitleBar;

/**
 * Create header submenu page
 * 
 * @uses Views\Items
 * @since 1.0.0
 */

if (!class_exists('GsTitleBar')) {
	class GsTitleBar extends GsItems
	{        
		/**
		 * Initilize
		 */
		public function __construct()
		{
			$this->defineOption('GSPL_TITLEBAR', 'titlebar_options');
            $this->page_id = 'gstitlebar';
            $this->menu_ops = array(
                'submenu' => array(
                	'parent_slug' => '',
                    'page_title' => 'Title Bar',
                    'menu_title' => 'Title Bar',
                    'capability' => 'edit_theme_options',
                )
            );
			$this->default_settings = array(

			);
            $this->settings_field = GSPL_TITLEBAR;
            $this->default_settings = array(
            	'req_titlebar' => 0,
            	'title_content' => '',
            	'title_height' => 150,
            	'title_bgcolor' => '',
            	'title_bgimg' => '',
            );
            parent::__construct();
            $this->createRequest('titlebar', GSPL_TITLEBAR);
            $this->metaboxTitleBar();
		}

		/**
		 * render form
		 */
		public function form()
		{
			$this->getFormDetail('form_titlebar');
		}

		/**
		 * Create title metabox form section
		 */
		public function metaboxTitleBar()
		{
			new GsPageTitleBar;
		}

	}// end class
} else {
	wp_die(__('This class is existed'));
}