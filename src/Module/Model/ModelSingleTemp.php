<?php
namespace GS\GSModule\GSModel;

use GS\GSModule\GsModule as GsModule;

/**
 * customize single template
 *
 * @since 1.0.0
 */
if (!class_exists('GsModelSingleTemp')) {
	class GsModelSingleTemp extends GsModule
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
			add_filter('single_template', array($this, 'registerSingleTemplate'));
		}

		public function registerSingleTemplate($single_template)
		{
			$current_type = get_post_type();
			$req_type = 'req_'.$current_type;
			$options = get_option(GSPL_SINGLETEMP);

			if (!array_key_exists($req_type, $options)) return;

			$cont_type = 'single_'.$current_type;
			$single_content = $options[$cont_type];

			$template_content = "<?php\n";
			$template_content .= "/**\n";
			$template_content .= "* Single template\n";
			$template_content .= "* \n";
			$template_content .= "* @since 1.0.0\n";
			$template_content .= "* @author Duy Nguyen <duyngha@gmail.com>\n";
			$template_content .= "*/\n";
			$template_content .= "remove_action('genesis_entry_header', 'genesis_entry_header_markup_open', 5);\n";
			//$template_content .= "remove_action('genesis_entry_header', 'genesis_do_post_title');\n";
			$template_content .= "remove_action('genesis_entry_header', 'genesis_post_info', 12);\n";

			$template_content .= "remove_action('genesis_entry_content', 'genesis_do_post_content');\n";

			$template_content .= "remove_action('genesis_entry_footer', 'genesis_entry_footer_markup_open', 5);\n";
			$template_content .= "remove_action('genesis_entry_footer', 'genesis_post_meta');\n";
			$template_content .= "add_action('genesis_entry_content', 'customTemplate');\n";

			// get custom template content
			$template_content .= "function customTemplate()\n{\n";
			$template_content .= "?>\n";

			$template_content .= $this->templateMarkups($single_content);

			$template_content .= "<?php\n";
			$template_content .= "\n}\n";
			// end add custom template callback function

			$template_content .= "genesis();\n";

			$single_template = GSPL_PATH . 'public/single.php';

			file_put_contents($single_template, $template_content);

			return $single_template;
		}

		/**
		 * Replace template markups
		 * @param string $plain_html
		 * @return string $html
		 */
		public function templateMarkups($plain_html = '')
		{
			global $post;
			// primary markups
			$post_id = $post->ID;
			$post_title = $post->post_title;
			$post_content = wpautop($post->post_content);
			
			$link = get_permalink( $post_id );
			$excerpt = $post->post_excerpt;
			$author_meta = get_user_meta( $post->post_author );
			$author_name = $author_meta['nickname'][0];
			$author_label = $author_meta['first_name'][0] . ' ' . $author_meta['last_name'][0];
			$author_url = get_author_posts_url( $post->post_author );

			// secondary markups
			$thumbnail_id = get_post_thumbnail_id( $post_id );
			$thumbnail = get_the_post_thumbnail( $post_id, 'thumbnail' );
			$attachment_info = wp_get_attachment_metadata( $thumbnail_id );

			// featured image
			$featured_image_caption = ( $attachment_info != '' ) ? $attachment_info['image_meta']['caption'] : 'image caption';
			$featured_image_url = wp_get_attachment_url( $thumbnail_id );
			$featured_image = '<img src="' . $featured_image_url . '" alt="' . $featured_image_caption . '" />';

			// taxonomy
			$terms_string = '';
			$taxonomies = get_object_taxonomies( $post->post_type );
			foreach ( $taxonomies as $taxonomy ) {
				$terms = wp_get_post_terms( $post_id, $taxonomy );
				//var_dump($terms);
				if ( empty( $terms ) ) continue;
				foreach ( $terms as $term_key => $term ) {
					$term_id = $term->term_id;
					$term_link = get_term_link( $term );
					if ( is_wp_error( $term_link ) ) continue;
					if ( $term_key == count( $terms ) - 1 ) {
						$terms_string .= '<a href="' . $term_link . '">' . $term->name . '</a>';	
					} else {
						$terms_string .= '<a href="' . $term_link . '">' . $term->name . '</a>, ';	
					}
				}
			}

			// tags
			$tags_string = '';
			$tags = get_the_tags( $post_id );
			if ( !empty( $tags ) ) {
				foreach ( $tags as $tag_key => $tag ) {
					$tag_link = get_tag_link( $tag->term_id );
					if ( $tag_key == count( $tags ) - 1 ) {
						$tags_string .=	'<a href="' . $tag_link . '">' . $tag->name . '</a>';
					} else {
						$tags_string .= '<a href="' . $tag_link . '">' . $tag->name . '</a>, ';
					}
				}
			}

			// custom fields
			$list_fields = get_post_custom_keys($post_id);
			//var_dump($list_fields);

			// replace markups with real values
			$search = array(
				'{$post_id}',
				'{$post_title}',
				'{$post_content}',
				'{$link}',
				'{$excerpt}',
				'{$featured_image_url}',
				'{$featured_image}',
				'{$thumbnail_id}',
				'{$thumbnail}',
				'{$author_name}',
				'{$author_label}',
				'{$author_url}',
				'{$terms}',
				'{$tags}',
			);

			$replace = array(
				$post_id,
				$post_title,
				$post_content,
				$link,
				$excerpt,
				$featured_image_url,
				$featured_image,
				$thumbnail_id,
				$thumbnail,
				$author_name,
				$author_label,
				$author_url,
				$terms_string,
				$tags_string,
			);

			// add custom fields into search and replace array
			if ( !empty( $list_fields ) ) {
				foreach ( $list_fields as $field ) {
					$field_value = get_post_meta( $post_id, $field, true );
					array_push( $search, '{$' . $field . '}' );
					array_push( $replace, $field_value  );
				}
			}
			// replace
			$html = str_replace( $search, $replace, $plain_html );

			return $html;
		}
	}// end class
}