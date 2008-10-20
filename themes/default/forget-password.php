<h1><?=i('Forget Password')?></h1>

<?=flash_message_box()?>
<?=error_message_box($error_messages)?>

<? if (!isset($user) || !$user->get_attribute('pwresetcode', false)) { ?>
<form method="post" action="" id="forget-password-form">
<p>
	<label><?=i('User ID')?><span class="star">*</span></label>
	<input type="text" name="user" id="user" value="<?=isset($params['user'])?$params['user']:''?>" class="<?=marked_by_error_message('user', $error_messages)?>"/>
</p>
<p>
	<label><?=i('Screen name')?><span class="star">*</span></label>
	<input type="text" name="name" id="name" value="<?=isset($params['name'])?$params['name']:''?>" class="<?=marked_by_error_message('name', $error_messages)?>"/>
</p>
<p><input type="submit" value="<?=i('Reset Password')?>" /> 
<? if (isset($params['url']) && !empty($params['url'])): ?><a href="<?=$params['url']?>"><?=('Cancel')?></a><? endif; ?></p>
</form>
<? } ?>