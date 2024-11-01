<?php
namespace GS\GSModule\GSModel;

use GS\GSModule\GsModule as GsModule;

/**
 * customize footer
 *
 * @since 1.0.0
 */
if (!class_exists('GsModelFooter')) {
	class GsModelFooter extends GsModule
	{
		/**
		 * number of widgets footer
		 * @var int $number_widget
		 */
		protected $number_widget = 3;

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
				case 'req_widget':
					// actions
					add_action(
						'after_setup_theme',
						array($this, 'registerFooterWidget'),
						12
					);
					add_action(
						'genesis_before_footer',
						array($this, 'footerWidget')
					);
					// remove action
					remove_action(
						'after_setup_theme',
						'genesis_register_footer_widget_areas'
					);
					remove_action(
						'genesis_before_footer',
						'genesis_footer_widget_areas'
					);
					add_filter('genesis_attr_footer-widgets', array($this, 'footerWidgetStyle'));
					break;
				case 'req_copyright':
					// filters
					add_filter(
						'genesis_footer_creds_text',
						array($this, 'copyright'),
						12
					);
					break;
				case 'req_footerstyle':
					add_filter('genesis_attr_site-footer', array($this, 'footerStyle'));
					break;
				default:
					# code...
					break;
			}
		}

		/**
		 * create footer widget columns
		 */
		public function registerFooterWidget()
		{
			$footer_widgets = $this->getNumberWidget();
			$counter = 1;
			while ($counter <= $footer_widgets) {
				genesis_register_widget_area(
					array(
						'id'               => sprintf('footer-%d', $counter),
						'name'             => sprintf(__('Footer %d', 'genesis'), $counter),
						'description'      => sprintf(__('Footer %d widget area.', 'genesis'), $counter),
						'_genesis_builtin' => true,
					)
				);
				$counter++;
			}
		}

		/**
		 * Footer widget style
		 * @param array $attributes
		 * @return array $attributes
		 */
		public function footerWidgetStyle($attributes)
		{
			$style = '';
			$style .= 'background-color:'.$this->data['footer_widget_bgcolor'].';';
			$attributes['style'] = $style;
			return $attributes;
		}

		/**
		 * Footer customize style
		 * @param array $attributes
		 * @return array $attributes
		 * @since 1.0.0
		 */
		public function footerStyle($attributes)
		{
			$style = '';
			$style .= 'background-color:'.$this->data['footer_bgcolor'].';';
			$style .= 'color:'.$this->data['footer_font_color'].';';
			$attributes['style'] = $style;
			return $attributes;
		}

		/**
		 * Adjust copyright text
		 * @param string $creds
		 * @since 1.0.0
		 * @return string $creds
		 */
		public function copyright($creds)
		{
			$creds = $this->data['copyright'];
			return $creds;
		}

		/**
		 * Footer widget
		 * @since 1.0.0
		 */
		public function footerWidget()
		{
			$number = $this->getNumberWidget();
			$layout = $this->getTypeLayout();
			$classes = $this->getWidgetClass($number, $layout);
			$this->layoutFooter($classes);
		}

		/**
		 * Widget default
		 * @since 1.0.0
		 * @param array $classes
		 */
		public function layoutFooter($classes)
		{
			$footer_widgets = $this->getNumberWidget();
			if (!is_active_sidebar('footer-1')) return;

			$inside  = '';
			$output  = '';
		 	$counter = 1;
		 	$count_class = 0;

			while ($counter <= $footer_widgets) {
				//* Darn you, WordPress! Gotta output buffer.
				ob_start();
				dynamic_sidebar('footer-' . $counter);
				$widgets = ob_get_clean();
				$inside .= sprintf(
					'<div class="%s footer-widgets-%d widget-area">%s</div>',
					$classes[$count_class],
					$counter,
					$widgets
				);
				$counter++;
				$count_class++;
			}

			if ($inside) {
				$output .= genesis_markup( array(
					'html5'   => '<div %s>' . genesis_sidebar_title('Footer'),
					'xhtml'   => '<div id="footer-widgets" class="footer-widgets">',
					'context' => 'footer-widgets',
					'echo'    => false,
				) );
				$output .= genesis_structural_wrap('footer-widgets', 'open', 0);
				$output .= $inside;
				$output .= genesis_structural_wrap('footer-widgets', 'close', 0);
				$output .= '</div>';
			}
			echo apply_filters('genesis_footer_widget_areas', $output, $footer_widgets);
		}

		/**
		 * Get number widget
		 * @since 1.0.3
		 * @return int $number | number of widget
		 */
		public function getNumberWidget()
		{
			$number = 3;
			$layout = $this->getLayout();
			if (empty($layout)) return $number;
			$number = $layout[0];
			return (int)$number;
		}

		/**
		 * get type layout
		 * @since 1.0.3
		 * @return int $type | type of widget layout
		 */
		public function getTypeLayout()
		{
			$type = 3;
			$type_layout = $this->getLayout();
			if (empty($type_layout)) return $type;
			$type = $type_layout[1];
			return (int)$type;
		}

		/**
		 * get classes widget
		 * @param int $num        | number of widget
		 * @param int $type       | number of type layout of widget
		 * @since 1.0.3
		 * @return array $classes | an array contains class name of widget
		 */
		public function getWidgetClass($num, $type)
		{
			$classes = array(
				'1' => array(
					'1' => array(),
				),
				'2' => array(
					'11' => array('one-half first', 'one-half'),
					'12' => array('one-third first', 'two-thirds'),
					'21' => array('two-thirds first', 'one-third'), 
				),
				'3' => array(
					'3' => array('one-third first','one-third','one-third'),
				),
				'4' => array(
					'4' => array('one-fourth first', 'one-fourth', 'one-fourth', 'one-fourth'),
				),
			);

			return $classes[$num][$type];
		}

		/**
		 * Get layout value
		 * @since 1.0.3
		 * @return array $value
		 */
		public function getLayout()
		{
			$value = array();
			$value = explode('-', $this->data['footer_layout']);
			return $value;
		}

	}// end class
} else {
	wp_die(__('This class is existed'));
}