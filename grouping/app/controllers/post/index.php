<?php
if (!$account->has_perm($board, 'read')) {
	access_denied();
}
if ($post->secret) {
	if ($post->user_id != $account->id && !$account->is_admin()) {
		access_denied();
	} else if ($post->user_id == 0 && $account->is_guest()) {
		if (is_post() && md5($_POST['password']) == $post->password) {
		} else {
			$action = 'secret';
			return;
		}
	}
}

if (isset($_GET['search'])) {
	$board->search = array_merge($board->search, $_GET['search']);
}
$seen_posts = explode(',', cookie_get('seen_posts'));
if (!in_array($post->id, $seen_posts)) {
	$post->update_view_count();
	$seen_posts[] = $post->id;
	cookie_register('seen_posts', implode(',', $seen_posts));
}

$comments = $post->get_comments();
$attachments = $post->get_attachments();
$trackbacks = $post->get_trackbacks();

$name = cookie_get('name');
if ($post->user_id) {
	$user = $post->get_user();
	if ($user->exists() && $user->signature)
		$signature = format_plain($user->signature);
}
apply_filters('PostView', $post);
apply_filters_array('PostViewComment', $comments);

$link_list = url_for($board, '', array('page' => get_requested_page()));
$link_new_post = $account->has_perm($board, 'write') ? url_for($board, 'post') : null;

$owner = $post->user_id == 0 || $account->id == $post->user_id || $account->has_perm($board, 'moderate');
if ($owner) {
	$link_edit = url_for($post, 'edit');
	$link_delete = url_for($post, 'delete');
}

$commentable = $account->has_perm($board, 'comment');

$newer_post = $post->get_newer_post();
$older_post = $post->get_older_post();
?>