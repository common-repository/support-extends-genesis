<?php
namespace GS\GSViews\GSItems;

/**
 * This class extends Genesis_Admin. It creates a admin page
 * 
 * @since 1.0.0
 */

if (!class_exists('GsDashboard')) {
    class GsDashboard extends \Genesis_Admin
    {
        use \GS\GSTraits\assetsMap;
        use \GS\GSTraits\registerAssets;
        use \GS\GSTraits\createButton;

        /**
         * constructor
         */
        public function __construct()
        {
            $this->page_id = 'gsupport';
            $this->menu_ops = array(
                'main_menu' => array(
                    'page_title' => 'Genesis Support',
                    'menu_title' => 'Genesis Support',
                    'capability' => 'edit_theme_options',
                    'icon_url'   => '',
                    'position'   => '11.02',
                )
            );

            $this->create();
        }

    	/**
		 * 
    	 */
    	public function settings_init(){}

    	/**
		 * 
    	 */
    	public function admin()
    	{
    		include GSPL_PATH .'resources/pages/dashboard.phtml';
    	}
    }
} else {
	wp_die(__('This class is existed'));
}
