<?php
/**
* Single template
* 
* @since 1.0.0
* @author Duy Nguyen <duyngha@gmail.com>
*/
remove_action('genesis_entry_header', 'genesis_entry_header_markup_open', 5);
remove_action('genesis_entry_header', 'genesis_post_info', 12);
remove_action('genesis_entry_content', 'genesis_do_post_content');
remove_action('genesis_entry_footer', 'genesis_entry_footer_markup_open', 5);
remove_action('genesis_entry_footer', 'genesis_post_meta');
add_action('genesis_entry_content', 'customTemplate');
function customTemplate()
{
?>
<?php
the_content();
?><?php

}
genesis();
