<?php
/**
 * global functions
 * @since 1.0.0
 */

/**
 * check active menu
 * @since 1.0.0
 * @param string $item
 * @return void
 */
function gsplActiveSubItem($item)
{
	$active = '';

	if (!isset($_GET['page'])) return;

	if (strip_tags($_GET['page']) == $item) {
		$active = 'active';
	}

	echo $active;
}

/**
 * model menu active
 * @package genesis-supporter
 * @since 1.0.3
 */
function gsplActiveModel()
{
	$model = array(
		'gsingletemp',
		'gscustomcss',
		'gsfooter',
		'gstitlebar',
		'gsheader'
	);

	$current_page = $_GET['page'];

	if (in_array($current_page, $model)) {
		echo 'active';
	}
}