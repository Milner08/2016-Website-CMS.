<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        Thomas Milner
    </title>
    <link rel="stylesheet" href="http://tmilner.co.uk/stylesheets/app.css" />
    <link href="http://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css" rel="stylesheet">
    <script src="http://tmilner.co.uk/bower_components/modernizr/modernizr.js"></script>
    <script src="http://yandex.st/highlightjs/8.0/highlight.min.js"></script>
</head>

<body>

    <?php include 'header.php'; ?>

    <?php if(isset($message)) include 'fragments/message.php' ?>

    <div class="row">
      <div class="large-9 small-9 columns">
        <h1 id="page-title">Artical List</h1>
      </div>
      <div class="large-3 small-3 columns" id="addbutton">
        <a href="admin/add_post" class="button small radius success controls">Add</a>
      </div>
    </div>

    <div class="row">
      <div class="large-12 small-12 columns">
        <?php foreach($posts as $post){ include 'fragments/post_summary.php'; echo "</hr>"; } ?>
      </div>
    </div>

    <?php include 'fragments/delete_post_model.php' ?>

    <?php include 'footer.php'; ?>

    <?php if(!$is_loggedin) include 'fragments/login_model.php'; ?>

    <script src="http://tmilner.co.uk/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="http://tmilner.co.uk/bower_components/foundation/js/foundation.min.js"></script>
    <script src="http://tmilner.co.uk/bower_components/foundation/js/foundation/foundation.reveal.js"></script>
    <script src="http://tmilner.co.uk/js/galleria/galleria-1.3.5.min.js"></script>
    <script src="http://tmilner.co.uk/js/galleria/plugins/flickr/galleria.flickr.min.js"></script>
    <script src="http://tmilner.co.uk/js/markdown.min.js"></script>
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
