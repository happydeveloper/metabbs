<?php
function meta_format_date($format, $date) {
	return strftime($format, mktime(substr($date, 8, 2), substr($date, 10, 2), substr($date, 12, 2), substr($date, 4, 2), substr($date, 6, 2),substr($date, 0, 4)));
}
function autolink($string) {
	return preg_replace_callback("#([a-z]+)://(?:[-0-9a-z_.@:~\\#%=+?/]|&amp;)+#i", 'link_url', $string);
}
function link_url($match) {
	$url = $match[0];
	if (is_image($url)) {
		return image_tag($url);
	} else {
		return link_text($url);
	}
}
function is_image($path) {
	$ext = strtolower(strrchr($path, '.'));
	return ($ext == '.png' || $ext == '.gif' || $ext == '.jpg');
}
function format($str) {
	return preg_replace(array("/ {2}/", "/\n /", "/\r?\n/", "/<br \/><br \/>/"), array("&nbsp;&nbsp;", "\n&nbsp;", "<br />", "</p><p>"), autolink(htmlspecialchars($str)));
}
function print_nav($nav = null) {
	echo implode(' | ', !$nav ? $GLOBALS['nav'] : $nav);
}
function human_readable_size($size) {
	$units = array(' bytes', 'KB', 'MB', 'GB', 'TB');
	for ($i = 0; $size > 1024; $size /= 1024, $i++);
	return round($size, 1) . $units[$i];
}
function print_notice($text, $description) {
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
	echo '<html>';
	echo '<body>';
	echo '<h2>' . $text . '</h2>';
	echo '<p>' . $description . '</p>';
	echo '</body>';
	echo '</html>';
	exit;
}
?>
