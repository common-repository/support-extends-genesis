<?php
namespace GS\GSModule\GSModel;

use GS\GSModule\GsModule as GsModule;

/**
 * customize footer
 *
 * @since 1.0.0
 */
if (!class_exists('GsModelHeader')) {
	class GsModelHeader extends GsModule
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
		 */
		public function hooks($key)
		{
			switch ($key) {
				case 'req_header_upload':
					// filters
					add_filter('genesis_pre_load_favicon', array($this, 'favicon'));
					break;
				case 'req_header_bg':
				case 'req_header_settings':
					// filters
					add_filter('genesis_attr_site-header', array($this, 'headerStyle'));
					break;
				default:
					# code...
					break;
			}
		}

		/**
		 * upload favicon
		 * @param string $favicon_url
		 * @return string $favicon_url
		 */
		public function favicon($favicon_url)
		{
			if ($this->data['favicon'] == '') return;
			$favicon_url = $this->data['favicon'];
			return $favicon_url;
		}

		/**
		 * style for header
		 * @param array $attributes
		 * @return array $attributes
		 */
		public function headerStyle($attributes)
		{
			$style = 'background-image:url('.$this->data['headerbg'].');';
			$style .= 'background-color:'.$this->data['headerbg_color'].';';
			$style .= 'background-repeat:'.$this->data['bgrepeat'].';';
			$style .= 'background-position:'.$this->data['bgposition'].';';
			$style .= 'height:'.$this->data['height'].'px';
			$attributes['style'] = $style;
			return $attributes;
		}

	}// end class
}