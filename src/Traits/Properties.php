<?php
namespace GS\GSTraits;

/**
 * trait a assets files map
 */
trait assetsMap {
	/**
	 * pattern s:c:key:file_name
	 * s::: type of file. s mean it is script file 
	 * j::: mean js or script files
	 * c,g,d... are directories
	 * 
	 * @var array assest map
	 */
	protected $assets_map = array(
		//css
		's:c:font-awesome:font-awesome.min',
		's:c:simple_line_icons:simple-line-icons.min',
		's:c:bootstrap:bootstrap.min',
		's:c:uniform:uniform.default.min',
		's:c:switch:bootstrap-switch.min',
		's:c:touchspin:bootstrap.touchspin.min',
		's:c:summernote:summernote',
		's:c:colorpicker:colorpicker',
		's:g:components:components.min',
		's:g:plugins:plugins.min',
		's:g:layout:layout.min',
		's:g:darkblue:darkblue.min',
		//'s:g:light:light.min',
		's:g:fixed:fix',
		//js
		'j:c:bootstrap:bootstrap.min',
		'j:c:jscookie:js.cookie.min',
		'j:c:bootstrap-hover-dropdown:bootstrap-hover-dropdown.min',
		'j:c:slimscroll:jquery.slimscroll.min',
		'j:c:blockui:jquery.blockui.min',
		'j:c:uniform:jquery.uniform.min',
		'j:c:switch:bootstrap-switch.min',
		'j:c:touchspin:bootstrap.touchspin.min',
		'j:c:summernote:summernote.min',
		'j:c:bootstrap-colorpicker:bootstrap-colorpicker',
		'j:g:app:app.min',
		'j:g:layout:layout.min',
		'j:g:admin-script:admin',
	);
}