<div class="leftside">
	<div class="row">
			<div class="large-10 large-offset-2 small-12 columns">
					<h1 id="page-title">Editor  <small><?php if($post->published==1){ echo "Published"; }else{ echo "Draft"; }?></small></h1>
			</div>
	</div>
	<form action="" method="post" id="editor">

		<div class="row">
	    <div class="small-12 medium-2 columns">
				<label for="title" class="inline">Title</label>
	    </div>
	    <div class="small-12 medium-10 columns">
				<input type="text" placeholder="Title" value="<?=$post->title;?>" name="title" id="title">
	    </div>
	  </div>

		<div class="row">
			<div class="small-12 medium-2 columns">
				<label for="tags" class="inline">Tags</label>
	    </div>
	    <div class="small-12 medium-10 columns">
				<input type="text" placeholder="Tags" value="<?=$post->tags;?>" name="tags" id="tags">
	    </div>
		</div>

		<div class="row">
	    <div class="small-12 medium-2 columns">
				<label for="image" class="inline">Image</label>
	    </div>
	    <div class="small-12 medium-6 columns">
				<input type="text" placeholder="Header Image" value="<?=$post->image;?>" name="image" id="image">
	    </div>
			<div class="small-12 medium-1 columns">
				<label for="layout" class="inline">Layout</label>
			</div>
			<div class="small-12 medium-3 columns">
				<select name="layout" id="layout" >
				  <option value="post" <?php if($post->layout == "post") { echo "selected"; } ?>>Post</option>
				  <option value="single" <?php if($post->layout == "single") { echo "selected"; } ?>>Single Post</option>
				  <option value="about" <?php if($post->layout == "about") { echo "selected"; } ?>>About</option>
				  <option value="projects" <?php if($post->layout == "projects") { echo "selected"; } ?>>Projects</option>
				</select>
			</div>
	  </div>

		<div class="row">
	    <div class="small-12 medium-2 columns">
				<label for="content" class="inline">Content</label>
	    </div>
	    <div class="small-12 medium-10 columns">
				<textarea placeholder="Artical" name="content" rows="25" id="content"><?=$post->content;?></textarea>
	    </div>
	  </div>

	  <input type="hidden" name="id" value="<?=$post->id;?>">
	  <input type="hidden" name="author_id" value="<?=$post->author->id;?>">

		<div class="row">
			<div class="small-10 medium-2 columns">
				<label for="publish" class="inline">Published</label>
	    </div>
	    <div class="small-2 medium-1 columns">
				<input type="checkbox" name="publish" value="true" <?php if($post->published==1){ echo "checked"; }?>>
	    </div>
			<div class="small-12 medium-3 columns">
				<a href="http://daringfireball.net/projects/markdown/syntax" class="centered" alt="Markdown syntax guide">Markdown Syntax Guide</a>
			</div>
			<div class="small-12 medium-6 columns">
				<ul class="button-group radius controls">
			    <li><input type="submit" class="button success" name="submit" value="Save"></li>
					<li><input type="submit" class="button success" name="exit" value="Save & Exit"></li>
			    <li><a href="/admin" class="button secondary">Cancel</a></li>
			  </ul>
			</div>
		</div>

	</form>
</div>
<div class="rightside">
	<div class="row">
		<div class="large-12 small-12 columns">
			<h1 id="page-title">Preview</h1>
		</div>
	</div>
	<div id="preview">
	</div>
</div>
