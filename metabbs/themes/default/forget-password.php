<h1 class="account-title"><?=i('Forget Password')?></h1>

<?=flash_message_box()?>
<?=error_message_box($error_messages)?>

<? if (!isset($user) || !$user->get_attribute('pwresetcode', false)) { ?>
<form method="post" action="" id="forget-password-form" class="account-form">
<p>
	<label for="user" class="field"><?=i('User ID')?><span class="star">*</span></label>
	<input type="text" name="user" id="user" value="<?=isset($params['user'])?$params['user']:''?>" class="<?=marked_by_error_message('user', $error_messages)?>"/>
</p>
<p>
	<label for="name" class="field"><?=i('Screen name')?><span class="star">*</span></label>
	<input type="text" name="name" id="name" value="<?=isset($params['name'])?$params['name']:''?>" class="<?=marked_by_error_message('name', $error_messages)?>"/>
</p>
<p><input type="submit" value="<?=i('Reset Password')?>" class="button"/> 
<? if (isset($params['url']) && !empty($params['url'])): ?> <a href="<?=$params['url']?>"><?=i('Cancel')?></a><? endif; ?></p>
</form>
<? } ?>