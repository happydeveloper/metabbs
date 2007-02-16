<?php
/**
 * 해당 페이지의 링크를 만든다.
 * @param $board 게시판 명
 * @param $page 페이지
 * @param $text 출력할 문자열
 * @return 게시판 명과 페이지를 기준으로 링크를 만든다.
 * $text가 있는 경우에는 텍스트를 없는 경우엔 페이지 번호를 텍스트로 삼는다.
 */
function link_to_page($page, $text = null) {
	$params = array('page' => $page);
	set_default_params($params);
	return link_text(query_string_for($params), $text ? $text : $page);
}

/**
 * 실제 페이지를 출력한다.
 * @param $board 게시판명
 * @param $padding 앞뒤로 필요한 간격
 */
function print_pages($board, $padding = 2) {
	$page = get_requested_page();
	$count = $board->get_post_count_with_condition();
	_print_pages($page, $count, $board->posts_per_page, $padding);
}

function _print_pages($page, $count, $per_page, $padding = 2) {
	$page_count = $count ? ceil($count / $per_page) : 1;
	$prev_page = $page - 1;
	$next_page = $page + 1;
	$page_group_start = $page - $padding;
	if ($page_group_start < 1) $page_group_start = 1;
	$page_group_end = $page + $padding;
	if ($page_group_end > $page_count) $page_group_end = $page_count;
	
	echo '<ul id="pages">';
	if ($prev_page > 0) {
		echo block_tag('li', link_to_page($prev_page, '&lsaquo;'), array('class' => 'prev'));
	}
	if ($page_group_start > 1) {
		echo block_tag('li', link_to_page(1));
		if ($page_group_start > 2) echo block_tag('li', '...');
	}
	for ($p = $page_group_start; $p <= $page_group_end; $p++) {
		echo block_tag('li', link_to_page($p), $p == $page ? array('class' => 'here') : array());
	}
	if ($page_group_end != $page_count) {
		if ($page_group_end < ($page_count - 1)) echo block_tag('li', '...');
		echo block_tag('li', link_to_page($page_count));
	}
	if ($next_page <= $page_count) {
		echo block_tag('li', link_to_page($next_page, '&rsaquo;'), array('class' => 'next'));
	}
	echo "</ul>";
}
?>
