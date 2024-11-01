<?php
namespace GS\GSViews\GSItems;

use GS\GSViews\GsItems as GsItems;

/**
 * Create submenu footer page
 * 
 * @uses Views\Items
 * @since 1.0.0
 */

if (!class_exists('GsFooter')) {
	final class GsFooter extends GsItems
	{   
		/**
		 * Initilize
		 */
		public function __construct()
		{
			$this->defineOption('GSPL_FOOTER', 'footer_options');
            $this->page_id = 'gsfooter';
            $this->menu_ops = array(
                'submenu' => array(
                	'parent_slug' => '',
                    'page_title' => 'Footer',
                    'menu_title' => 'Footer',
                    'capability' => 'edit_theme_options',
                )
            );
            $this->settings_field = GSPL_FOOTER;
			$this->default_settings = array(
				//req widget
				'req_widget' => 0,
				'number_widget' => 1,
				'footer_layout' => 'layout0',
				//req copyright
				'req_copyright' => 0,
				'copyright'     => _('2015 © Fresh Air. Plugins for Wordpress'),
				//req style
				'req_footerstyle' => 0,
				'footer_widget_bgcolor' => '#333333',
				'footer_bgcolor' => '#FFFFFF',
				'footer_font_color' => '#333333'
			);
            parent::__construct();
            $this->createRequest('footer', GSPL_FOOTER);
		}

		/**
		 * redeclared parent method
		 */
		public function form()
		{
			$this->getFormDetail('form_footer');
		}

	}// end class
} else {
	wp_die(__('This class is existed'));
}