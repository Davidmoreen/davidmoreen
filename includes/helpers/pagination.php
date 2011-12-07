<?php   if ( ! defined("_VALID_")) die("No direct script access");
/**
 * Pagination helper
 * 
 * @author Davidmoreen <davidmoreen@gmail.com>
 * @version 1.0
 */


/**
 * Generate pagination code
 */
function paginate($page = 1, $total_items, $limit = 15, $adjacents = 1, $target_page = "/", $page_string = "page") {
	$lastpage = ceil($total_items / $limit);	
	$lpm1 = $lastpage - 1;
	$pagination = "";
	
	if ($lastpage > 1) {	
		$pagination .= '<ul class="pagination">';
		
		if ($lastpage < 7 + ($adjacents * 2)) {	
			for ($counter = 1; $counter <= $lastpage; $counter++) {
				if ($counter == $page)
					$pagination .= '<li class="standard">' .$counter. '</li>';
				else
					$pagination .= '<li><a href="' .$target_page . modify_url(array($page_string=>$counter)). '">' .$counter. '</a></li>';					
			}
		} elseif ($lastpage >= 7 + ($adjacents * 2)) {
		
			if ($page < 1 + ($adjacents * 3)) {
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
					if ($counter == $page)
						$pagination .= '<li class="standard">' .$counter. '</li>';
					else
						$pagination .= '<li><a href="' .$target_page . modify_url(array($page_string=>$counter)). '">' .$counter. '</a></li>';
				}
				
				$pagination .= '<li><a href="' .$target_page . modify_url(array($page_string=>$lpm1)). '">' .$lpm1. '</a></li>';
				$pagination .= '<li><a href="' .$target_page . modify_url(array($page_string=>$lastpage)). '">' .$lastpage. '</a></li>';
			} elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
			
				$pagination .= '<li><a href="' .$target_page . modify_url(array($page_string=>1)). '">1</a></li>';
				$pagination .= '<li><a href="' .$target_page . modify_url(array($page_string=>2)). '">2</a></li>';
			
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
					if ($counter == $page)
						$pagination .= '<li class="current standard">' .$counter. '</li>';
					else
						$pagination .= "<li class=\"current\"><a href=\"" . $target_page . modify_url(array($page_string=>$counter)) . "\">$counter</a></li>";
				}
				
				$pagination .= '<li><a href="' .$target_page . $target_page . modify_url(array($page_string=>$lpm1)). '">' .$lpm1. '</a></li>';	
			} else {
				$pagination .= '<li><a href="' .$target_page . modify_url(array($page_string=>1)). '">1</a></li>';
				$pagination .= '<li><a href="' .$target_page . modify_url(array($page_string=>2)). '">2</a></li>';
				
				for ($counter = $lastpage - (1 + ($adjacents * 3)); $counter <= $lastpage; $counter++) {
					if ($counter == $page)
						$pagination .= "<li class=\"current standard\">$counter</li>";
					else
						$pagination .= "<li class=\"current\"><a href=\"" . $target_page . modify_url(array($page_string=>$counter)) . "\">$counter</a></li>";
				}
			}
		}
		
		$pagination .= "</ul>\n";
	}
	
	return $pagination;
}