<!doctype html>
<html class="no-js" lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Thomas Milners personal webpage. Photography and Programming.">
  <title>
    Thomas Milner | <?= preg_replace('#<[^>]+>#', ' ', $post->title); ?>
  </title>
  <link rel="stylesheet" href="http://tmilner.co.uk/stylesheets/app.css" />
  <link href="http://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css" rel="stylesheet">
  <script src="http://tmilner.co.uk/bower_components/modernizr/modernizr.js"></script>
  <script src="http://yandex.st/highlightjs/8.0/highlight.min.js"></script>
</head>

<body>

  <?php include 'header.php'; ?>

  <?php if(isset($message)) include 'fragments/message.php' ?>

  <div class="row full-width" id="postHeader">
    <img src="<?= $post->image; ?>" />
    <div id="title">
      <h2><a href="/<?= $post->permalink ?>"><?= $post->title; ?></a></h2><br>
      <small class="subheader" id="date"><?= $post->date_posted; ?></small><br>
      <small class="subheader" id="tags">Tags: <?= $post->tags; ?></small>
    </div>
  </div>

  <div class="row">
    <div class="small-12 small-centered columns" id="contentPane">
      <div id="content">
        <?= Post::convertContent($post->content); ?>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="small-12 columns">
      <div class="pagination-centered">
        <ul class="pagination" role="menubar" aria-label="Pagination">
          <?php if(isset($previous)){ ?>
            <li class="arrow"><a href="/<?= $previous ?>">&laquo; Older</a></li>
          <?php }else{ ?>
            <li class="arrow unavailable" aria-disabled="true"><a>&laquo; Older</a></li>
          <?php } ?>
            <li class="current"><?= preg_replace('#<[^>]+>#', ' ', $post->title); ?></li>
          <?php if(isset($next)){ ?>
            <li class="arrow"><a href="/<?= $next ?>">Newer &raquo;</a></li>
          <?php }else{ ?>
            <li class="arrow unavailable" aria-disabled="true"><a> Newer &raquo;</a></li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </div>
  <?php include 'footer.php'; ?>

  <?php if(!$is_loggedin) include 'fragments/login_model.php'; ?>

  <script src="http://tmilner.co.uk/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="http://tmilner.co.uk/bower_components/foundation/js/foundation.min.js"></script>
  <script src="http://tmilner.co.uk/bower_components/foundation/js/foundation/foundation.reveal.js"></script>
  <script src="http://tmilner.co.uk/js/galleria/galleria-1.3.5.min.js"></script>
  <script src="http://tmilner.co.uk/js/galleria/plugins/flickr/galleria.flickr.min.js"></script>
  <script src="http://tmilner.co.uk/js/app.js"></script>

  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-1524575-2', 'tmilner.co.uk');
  ga('send', 'pageview');

  </script>

</body>
</html>
