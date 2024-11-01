<?php
namespace Gs\GSViews\GSItems;

/**
 * This class create title bar section in admin page
 * @author Duy Nguyen <duyngha@gmail.com>
 * @since 1.0.0
 */

if (!class_exists('GsPageTitleBar')) {
	class GsPageTitleBar
	{
		/**
		 * @var string $id id of attribute of the edit screen section
		 */
		protected $id = 'page_title_bar';

		/**
		 * @var string $title title of title bar section
		 */
		protected $title = 'Page Title Bar';

		/**
		 * @var string|array $screen type of screen which to show edit section
		 */
		protected $screen = 'page';

		/**
		 * @var array 
		 */
		protected $titlebar_settings = array(
			'req_titlebar' => 0,
			'title_content' => '',
			'title_height' => '150',
			'title_bgcolor' => '',
			'title_bgimg' => ''
		);

		/**
		 * initiliaze
		 */
		public function __construct()
		{
			$this->hooks();
		}

		/**
		 * hooks
		 */
		public function hooks()
		{
			add_action(
				'admin_menu',
				array($this, 'registerPageTitleBar')
			);
			add_action(
				'save_post',
				array($this, 'saveTitleSettings'),
				1,
				2
			);
		}

		/**
		 * register page title bar meta box for page
		 */
		public function registerPageTitleBar()
		{
			// only add in the page
			add_meta_box(
				$this->id,
				$this->title,
				array($this, 'metaboxCallBack'),
				$this->screen
			);
		}

		/**
		 * include form html
		 */
		public function metaboxCallBack()
		{
			wp_nonce_field('title_save_settings', 'title_save_settings_nonce');
			include GSPL_PATH .'resources/forms/metabox_title_form.phtml';
		}

		/**
		 * save setting
		 * @param int $post_id
		 * @param object $post
		 */
		public function saveTitleSettings($post_id, $post)
		{
			if (!isset($_POST[GSPL_TITLEBAR]))
				return;
			// Merge user submitted options with fallback defaults
			$data = wp_parse_args(
				$_POST[GSPL_TITLEBAR],
				$this->titlebar_settings
			);
			//* Sanitize the title, description, and tags
			global $allowedposttags;

			foreach ((array)$data as $key => $value) {
				$data[$key] = wp_kses($value, $allowedposttags);
			}

			genesis_save_custom_fields(
				$data,
				'title_save_settings',
				'title_save_settings_nonce',
				$post
			);
		}
	}// end class
}