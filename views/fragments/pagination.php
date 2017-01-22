<!-- For this to work the $count variable MUST be set. -->
<ul class="pagination" role="menubar" aria-label="Pagination">
<?php
  $limit = $_GET['limit'];
  $page = $_GET['page'];

  if(!isset($page)){
    $page = 1;
  }

  if(!isset($limit)){
    $limit = 10;
  }

  $pages = ceil($count/$limit);
  $elipse = false;

  if($page > 1){
    $previous = $page - 1;
    echo '<li class="arrow" aria-disabled="true"><a href="http://tmilner.co.uk/archive?page='.$previous.'&limit='.$limit.'">&laquo; Previous</a></li>';
  }else{
    echo '<li class="arrow unavailable" aria-disabled="true"><a href="">&laquo; Previous</a></li>';
  }

  for($i = 1; $i <= $pages; $i++){
    if($i > 5 && $i < $pages-5 && $pages > 10){
      if($elipse == false){
        echo '<li class="unavailable"><a href="">&hellip;</a></li>';
        $elipse = true;
      }
      if($i == $page){
        echo '<li class="current"><a href="http://tmilner.co.uk/archive?page='.$i.'&limit='.$limit.'">'.$i.'</a></li>';
        echo '<li class="unavailable"><a href="">&hellip;</a></li>';
      }
    }else{
      if($i == $page){
        echo '<li class="current"><a href="http://tmilner.co.uk/archive?page='.$i.'&limit='.$limit.'">'.$i.'</a></li>';
      }else{
        echo '<li><a href="http://tmilner.co.uk/archive?page='.$i.'&limit='.$limit.'">'.$i.'</a></li>';
      }
    }
  }

  if($page != $pages){
    $next = $page + 1;
    echo '<li class="arrow"><a href="http://tmilner.co.uk/archive?page='.$next.'&limit='.$limit.'">Next &raquo;</a></li>';
  }else{
    echo '<li class="arrow unavailable"><a href="">Next &raquo;</a></li>';
  }
?>
</ul>
