<?php
namespace GS\GSModule\GSModel;

use GS\GSModule\GsModule as GsModule;

/**
 * customize footer
 *
 * @since 1.0.0
 */
if (!class_exists('GsModelCustomCss')) {
	class GsModelCustomCss extends GsModule
	{
		/**
		 * initiliaze
		 */
		public function __construct($request, $data)
		{	
			parent::__construct($request, $data);
		}

		/**
		 * add new hooks
		 * 
		 * @param string $key
		 */
		public function hooks($key)
		{
			switch ($key) {
				case 'req_customcss':
					// actions
					add_action('wp_head', array($this, 'dynamicStyle'));
					break;
				default:
					# code...
					break;
			}
		}

		/**
		 * 
		 */
		public function dynamicStyle()
		{
			$style = $this->data['custom_css'];
			if ($style == '') return;
			printf('<style>%s</style>', $style);
		}

	}// end class
}