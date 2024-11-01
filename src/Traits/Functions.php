<?php
namespace GS\GSTraits;

/**
 * check active menu
 * 
 * @param string $item
 * @return void
 */
trait activeItem {
	function activeItem($item)
	{
		$active = '';

		if (!isset($_GET['page'])) return;

		if ($_GET['page'] == $item) {
			$active = 'active';
		}

		echo $active;
	}
}