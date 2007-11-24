<div id="post">
	<h1><div class="title-wrap"><?=$post->title?></div></h1>

	<table>
	<tr>
		<td id="post-side">
			<div class="author"><?=$post->author?></div>
			<div class="date"><?=$post->date?></div>
		</td>

		<td id="post-content">
			<div class="body"><?=$post->body?></div>

			<? if ($signature): ?>
			<div class="signature"><?=$signature?></div>
			<? endif; ?>

			<? if ($attachments): ?>
			<ul id="attachments">
			<? foreach ($attachments as $attachment): ?>
				<li>
					<a href="<?=$attachment->url?>"><?=$attachment->filename?></a> (<?=$attachment->size?>)
					<? if ($attachment->thumbnail_url): ?><br /><img src="<?=$attachment->thumbnail_url?>" alt="<?=$attachment->filename?>" /><? endif; ?>
				</li>
			<? endforeach; ?>
			</ul>
			<? endif; ?>
		</td>
	</tr>
	</table>

<div id="responses">
<? if ($post->trackback_url): ?>
<div id="trackbacks">
	<p id="trackback-url">트랙백 주소: <?=$post->trackback_url?></p>
<? if ($trackbacks): ?>
	<ol>
	<? foreach ($trackbacks as $trackback): ?>
		<li>
			<a href="<?=$trackback->url?>"><?=$trackback->title?></a> from <?=$trackback->blog_name?>
			<? if ($trackback->delete_url): ?><a href="<?=$trackback->delete_url?>">삭제</a><? endif; ?>
		</li>
	<? endforeach; ?>
	</ol>
<? endif; ?>
</div>
<? endif; ?>

<div id="comments">
	<ol>
	<? foreach ($comments as $comment): ?>
		<li class="comment" style="margin-left: <?=$comment->depth * 2?>em">
			<div class="actions">
			<? if ($comment->reply_url): ?><a href="<?=$comment->reply_url?>" class="dialog">답글 달기</a><? endif; ?>
			<? if ($comment->delete_url): ?>| <a href="<?=$comment->delete_url?>" class="dialog">지우기</a><? endif; ?>
			<? if ($comment->edit_url): ?>| <a href="<?=$comment->edit_url?>" class="dialog">고치기</a><? endif; ?>
			</div>
			<span class="author"><?=$comment->author?></span>
			<span class="date"><?=$comment->date?></span>
			<div class="comment-body"><?=$comment->body?></div>
		</li>
	<? endforeach; ?>
	</ol>

	<? include "comment_form.php"; ?>
</div>
</div>
</div>

<div id="meta-nav">
<? if ($link_list): ?><a href="<?=$link_list?>">목록보기</a> <? endif; ?>
<? if ($link_new_post): ?><a href="<?=$link_new_post?>">글쓰기</a> <? endif; ?>
<? if ($link_edit): ?><a href="<?=$link_edit?>">고치기</a> <? endif; ?>
<? if ($link_delete): ?><a href="<?=$link_delete?>">지우기</a> <? endif; ?>
</div>