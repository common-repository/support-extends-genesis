<?php
namespace GS\GSModule\GSModel;

use GS\GSModule\GsModule as GsModule;

/**
 * Create title bar for pages
 * @since 1.0.1
 */
if (!class_exists('GsModelTitleBar')) {
	class GsModelTitleBar extends GsModule
	{
		/**
		 * initiliaze
		 * @since 1.0.0
		 */
		public function __construct($request, $data)
		{	
			parent::__construct($request, $data);
		}

		/**
		 * add new hooks
		 * @since 1.0.0
		 */
		public function hooks($key)
		{
			switch ($key) {
				case 'req_titlebar':
					add_action(
						'genesis_after_header',
						array($this, 'createTitleBar')
					);
					add_filter(
						'genesis_attr_page-title',
						array($this, 'titleBarStyle')
					);
					break;
				default:
					# code...
					break;
			}
		}

		/**
		 * display title content into front-end
		 * @since 1.0.1
		 */
		public function createTitleBar()
		{
			//$current_id = get_the_ID();
			add_theme_support(
				'genesis-structural-wraps',
				array(
					'page-title',
				)
			);

			genesis_markup( array(
				'html5'   => '<div %s>',
				'xhtml'   => '<div id="">',
				'context' => 'page-title',
			) );

			genesis_structural_wrap( 'page-title', 'open' );

			$this->overrideData(get_the_ID());
			echo do_shortcode($this->data['title_content']);

			genesis_structural_wrap( 'page-title', 'close' );

			echo '</div>';

		}

		public function titleBarStyle($attributes)
		{
			$style = '';
			$style .= 'background-color:' . $this->data['title_bgcolor'] . ';';
			$style .= 'background-image:url(' . $this->data['title_bgimg'] . ');';
			$style .= 'background-repeat:no-repeat;background-size:100%;';
			$style .= 'background-position:left top;';
			$style .= 'height:' . $this->data['title_height'] . 'px;';
			$attributes['style'] = $style;
			return $attributes;
		}

		/**
		 * Override individual data
		 * @param int $id | post/page id
		 * @return void
		 * @since 1.0.1
		 */
		public function overrideData($id)
		{
			foreach ($this->data as $key => $value) {
				$mixin = get_post_meta($id, $key, true);
				if ($mixin != '') {
					$this->data[$key] = $mixin;
				}
			}
		}

	}// end class
} else {
	wp_die(__('This class is existed'));
}