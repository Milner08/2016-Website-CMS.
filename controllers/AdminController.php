<?php
use \Michelf\MarkdownExtra;
class AdminController extends Controller{
  var $active = 'admin';

  public function index(){
    $posts = Model::factory('Post')->order_by_desc('date_posted')->find_many();
    $view = new View('admin_list');
    foreach($posts as $post){
      $date = date('l d F Y', strtotime($post->date_posted));
      $post->date_posted = $date;
      $post->summary = MarkdownExtra::defaultTransform(substr($post->content, 0, 200));
    }

    $view->assign('posts', $posts);
    $view->assign('message', $this->message);
    $view->assign('active', $this->active);
    $view->render();
  }

  public function login(){
    $username = strtolower($_POST['username']);
    $password = $_POST['password'];

    $user = Model::factory('User')->where('username',$username)->find_one();

    if($user){
      $cryptedPassword = hash('sha256', $password . $user->salt);
      for($round = 0; $round < 65536; $round++) {
        $cryptedPassword = hash('sha256', $cryptedPassword . $user->salt);
      }

      if($cryptedPassword === $user->password){
        if(isset($_POST['persistent']) && $_POST['persistent'] == 1){
          $hash = md5($user->salt + $user->name + $_SERVER['REMOTE_ADDR'] + $user->salt);
          setcookie("UAUTH", $hash, time() + (86400 * 30), "/", tmilner.co.uk);
          $user->cookie = $hash;
          $user->save();
        }

        $_SESSION['user'] = $user;

        header( 'Location: http://tmilner.co.uk/admin' ) ;
        return;
      }
    }
    header( 'Location: http://tmilner.co.uk' ) ;
    return;
  }

  public function logout(){
    unset($_SESSION['user']);
    header( 'Location: http://tmilner.co.uk' ) ;
  }
}
?>
