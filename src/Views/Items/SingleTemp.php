<?php
namespace GS\GSViews\GSItems;

use GS\GSViews\GsItems as GsItems;

/**
 * Create single template for custom post type
 * 
 * @uses Views\Items
 * @since 1.0.0
 */

if (!class_exists('GsSingleTemp')) {
	final class GsSingleTemp extends GsItems
	{   
		/**
		 * @var array $post_types
		 */
		public $post_types = array();

		/**
		 * @var array $except except post type array
		 */
		public $except = array(
			'acf',
			'product_variation',
			'shop_order',
			'shop_coupon',
			'shop_webhook',
			'shop_order_refund',
			'wpcf7_contact_form',
		);

		/**
		 * Initilize
		 */
		public function __construct()
		{
			$this->defineOption('GSPL_SINGLETEMP', 'singletemp_options');
            $this->page_id = 'gsingletemp';
            $this->menu_ops = array(
                'submenu' => array(
                	'parent_slug' => '',
                    'page_title' => 'Single Template',
                    'menu_title' => 'Single Template',
                    'capability' => 'edit_theme_options',
                )
            );
            $this->settings_field = GSPL_SINGLETEMP;
			$this->default_settings = array();
            parent::__construct();
            $this->createRequest('singletemp', GSPL_SINGLETEMP);
		}

		/**
		 * redeclared parent method
		 */
		public function form()
		{	
			$this->getFormDetail('single_template');
		}

		/**
		 * hooks
		 */
		public function hooks()
		{
			add_action('admin_init', array($this, 'getPostTypes'));
		}

		public function getPostTypes()
		{
			$all_post_types = get_post_types(array('_builtin' => false));
			array_unshift($all_post_types, 'post');
			$post_types = array_diff($all_post_types, $this->except);
			$this->post_types = $post_types;
		}

		/**
		 * create hidden inputs
		 */
		public function createHiddenInputs()
		{
			$hidden = '';
			if (empty($this->post_types)) return $hidden;
			foreach ($this->post_types as $key => $type) {
				$hidden_name = 'single_'.$type;
				$name = $this->get_field_name($hidden_name);
				$value = $this->get_field_value($hidden_name);
				$hidden .= '<textarea class="hidden" id="hidden_input_'.$type.'"';
				$hidden .= ' name="'.$name.'">';
				$hidden .= $value.'</textarea>';
			}
			return $hidden;
		}

		/**
		 * create post type select box
		 */
		public function selectPostType()
		{
			$select_type = '';
			if (empty($this->post_types)) return $select_type;
	        $select_type .= '<ul class="dropdown-menu pull-right">';
	        foreach ($this->post_types as $type) {
	            $select_type .= '<li><a href="?page=gsingletemp&cpt='.$type.'">'.$type.'</a></li>';
	        }
	        $select_type .= '</ul>';
	        return $select_type;
		}

		/**
		 * edit post type
		 */
		public function getType()
		{
			$type = 'post';
			if (!isset($_GET['cpt'])) return $type;
			$type = $_GET['cpt'];
			return $type;
		}

		/**
		 * create request options
		 */
		public function createRequestCheckbox()
		{
			$req_checkbox = '<div class="md-checkbox">';
			if (empty($this->post_types)) {
				$req_checkbox .= '</div>';
				return $req_checkbox;
			}
			$count = 0;
			foreach ($this->post_types as $key => $type) {
				//var_dump($key);
				$req_name = 'req_'.$type;
				$classes = $this->createClasses($type);
				$name = $this->get_field_name($req_name);
				$req_checkbox .= '<input id="checkbox' . $count . '" class="md-check ' . $classes . '" value="1" type="checkbox" ';
				$req_checkbox .= 'name="' . $name.'" ' . $this->checked($this->get_field_value($req_name), '1' ) . '>';
				$req_checkbox .= '<label class="' . $classes . '" for="checkbox' . $count . '"><span class="inc"></span>';
				$req_checkbox .= '<span class="check"></span>';
				$req_checkbox .= '<span class="box"></span> </label>';
				$count++;
			}
			$req_checkbox .= '</div>';
			echo $req_checkbox;
		}

		/**
		 * check type for request input type
		 */
		public function createClasses($type = '')
		{
			$classes = 'hidden';
			if ($type == '' || $type != $this->getType() ) return $classes;
			$classes = '';
			return $classes;
		}

		/**
		 * checked checkbox
		 */
		public function checked($value, $compare)
		{
			$checked = '';
			if ($value == $compare) {
				$checked .= 'checked="checked"';
			}
			return $checked;
		}

	}// end class
} else {
	wp_die(__('This class is existed'));
}