<?php
namespace GS\GSViews;

use GS\GSController\GsController as GsController;

/**
 * This class creates submenu pages
 * It is extend from Genesis_Admin_Form class
 * 
 * @since 1.0.0
 */

if (!class_exists('GsItems')) {
	class GsItems extends \Genesis_Admin_Form
	{
        use \GS\GSTraits\assetsMap;
        use \GS\GSTraits\registerAssets;
		use \GS\GSTraits\createButton;

		/**
		 * initiliaze
		 * 
		 * @return void
		 */
		public function __construct()
		{
			$this->create();
			$this->hooks();
		}

		/**
		 * hooks()
		 */
		public function hooks()
		{
		}

		/**
		 * define constant for item
		 * 
		 * @param string $const
		 * @param string $value
		 * @return void
		 */
		public function defineOption($const, $value)
		{
			define($const, $value);
		}

		/**
		 * 
		 */
		public function form(){}

		/**
		 * get form detail file
		 * 
		 * @param string $file_name
		 * @param string $extension
		 */
		public function getFormDetail($file_name, $extension = 'phtml')
		{
			$path = GSPL_PATH .'resources/forms/'.$file_name.'.'.$extension;
			include $path;
		}

		/**
		 * 
		 */
		public function admin()
		{
			include GSPL_PATH .'resources/pages/items.phtml';
		}

		/**
		 * create request
		 */
		public function createRequest($request_code, $request_value)
		{
			new GsController($request_code, $request_value);
		}

		/**
		 * get subpage menu
		 */
		public function getAdminPageTitle()
		{
			$page = $_GET['page'];
			$page_available = array(
				'gsfooter' => 'Footer',
				'gsheader' => 'Header',
				'gsingletemp' => 'Single Template',
				'gscustomcss' => 'Custom CSS',
				'gstitlebar' => 'Title Bar',
			);
			if (array_key_exists($page, $page_available)) return $page_available[$page];
		}

	}// end class
} else {
	wp_die(__('This class is existed'));
}