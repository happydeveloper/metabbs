<?php
if ($post->user_id != 0 && $user->id != $post->user_id
		&& $board->perm_delete > $user->level) {
	redirect_to(url_with_referer_for('user', 'login'));
}
if (is_post()) {
	if ($post->user_id == 0 && $board->perm_delete > $user->level) {
		if ($post->password != md5($_POST['post']['password'])) {
			redirect_to(url_for($post, 'edit'));
		}
	}

	$post->import($_POST['post']);
	if ($_POST['delete']) {
		foreach ($_POST['delete'] as $id) {
			$attachment = Attachment::find($id);
			$attachment->delete();
			@unlink('data/uploads/'.$id);
		}
	}
	define('SECURITY', 1);
	include 'actions/post/save.php';
}
render('edit');
?>
