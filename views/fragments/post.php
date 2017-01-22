<div class="article">
    <h2 id="title"> <a href="/<?= $post->permalink ?>"> <?= $post->title; ?> </a> </h2>
    <div id="meta">
        <small class="subheader" id="date"><?= $post->date_posted; ?></small><br>
        <small class="subheader" id="tags">Tags: <?= $post->tags; ?></small>
    </div>
</div>
