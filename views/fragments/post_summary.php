<div class="panel summary">
	<div class="clearfix" id="summarytitle">
	  <h4 class="left"><?= $post->title; ?> <small><?= $post->date_posted; ?></small></h4>
		<div class="right">
			<a href="/admin/edit_post/<?= $post->id; ?>" class="small radius button summaryedit">Edit</a>
	    <a href="/admin/delete_post/<?= $post->id; ?>" data-reveal-id="deleteModal" class="small radius alert button deleteLink">Delete</a>
			<a href="/<?= $post->permalink; ?>" class="small radius button info">View</a>
		</div>
	</div>
	<?= Post::convertContent($post->content); ?>
</div>
