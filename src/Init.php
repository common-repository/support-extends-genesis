<?php
namespace GS\src;

/**
 * Initiliaze plugin core
 * 
 * @todo create method check activate/deactivate plugin
 * @todo permission of user
 * @since 1.0.0
 */
if (!class_exists('gsConstruct')) {
	class gsConstruct
	{
		/**
		 * @var array $constants_map constants map
		 */
		protected $constants_map;

		/**
		 * admin pages map
		 */
		protected $admin_map = [
			'GsDashboard',
			'GsHeader',
			'GsFooter',
			'GsCustomCss',
			'GsSingleTemp',
			'GsTitleBar',
		];

		/**
		 * Initiliaze
		 */
		public function __construct($const)
		{	
			$this->constants_map = $const;
			$this->defineConstants();
			$this->createPages();
			$this->hooks();
		}

		/**
		 * hooks
		 */
		public function hooks()
		{
			add_action('admin_enqueue_scripts', array($this, 'loadMedia'));
			register_activation_hook(
				GSPL_PRI,
				array($this, 'activate')
			);
		}

		/**
		 * define constants
		 */
		public function defineConstants()
		{
			foreach ($this->constants_map as $key => $value) {
				define($key, $value);
			}
		}

		/**
		 * create admin pages
		 */
		public function createPages()
		{
			foreach ($this->admin_map as $page) {
				$page_class = 'GS\GSViews\\GSItems\\'.$page;
				new $page_class;
			}
		}

		/**
		 * Load media files needed for Uploader
		 */
		public function loadMedia() {
			wp_enqueue_media();
		}

		/**
		 * @todo active plugin method
		 */
		public function activate()
		{

			if (version_compare(get_bloginfo('version'), GSPL_REQ, '<')) {
				$message = 'Plugin cannot activate because current version of Wordpress is lower '.GSPL_REQ;
				$this->deactiveNotification( basename( __FILE__ ) );
			}

			if (GSPL_PRI) {
				$message = 'Plugin was activated.';
				$this->deactiveNotification($message);
			}

			if (!defined('PARENT_THEME_VERSION')) {
				$message = 'Genesis framework wasn\'t activated';
				$this->deactiveNotification($message);
			}

			if (!version_compare(PARENT_THEME_VERSION, '2.0.0', '>=')) {
				$message = 'Plugin cannot activate because current version of Genesis is lower 2.0.0';
				$this->deactiveNotification($message);
			}
		}

		/**
		 * @todo deactive plugin method
		 * @param string $message
		 * @return void
		 */
		public function deactiveNotification($message)
		{
			deactivate_plugins(plugin_basename(GSPL_PRI));
			wp_die($message);
		}

	} // end class
} else {
	wp_die('This class is existed');
}
