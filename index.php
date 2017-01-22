<?php
require 'vendor/autoload.php';

require_once 'includes/Router.php';
require_once 'includes/View.php';
require_once 'includes/Controller.php';
require_once 'includes/Michelf/MarkdownInterface.php';
require_once 'includes/Michelf/Markdown.php';
require_once 'includes/Michelf/MarkdownExtra.php';
//Autoload classes, saves loads of requires.
function autoloader($class_name){
	$classesDir = array (
		'includes/',
		'controllers/',
		'models/'
	);

	foreach ($classesDir as $directory) {
		if (file_exists($directory . $class_name . '.php')) {
			require_once ($directory . $class_name . '.php');
			return;
		}
	}
}
spl_autoload_register('autoloader');

ini_set('session.cookie_lifetime', 60 * 60 * 24 * 7);
session_start();

$config = simplexml_load_file("includes/config.xml");

ORM::configure('mysql:host='.$config->host.';dbname='.$config->database);
ORM::configure('username', $config->username);
ORM::configure('password', $config->password);
ORM::configure('charset', 'utf8');

$router = new Router();

$router->addRoute('/',function(){
	$controller = new PostController();
	$controller->index();
});

$router->addRoute('/index',function(){
	$controller = new PostController();
	$controller->index();
});

$router->addRoute('/archive/:tag',function($tag){
	$controller = new PostController();
	$controller->archive($tag);
});

$router->addRoute('/archive',function(){
	$controller = new PostController();
	$controller->archive();
});

$router->addRoute('/admin',function(){
	if($_SESSION['user']){
		$controller = new AdminController();
		$controller->index();
	}else{
		header( 'Location: http://tmilner.co.uk' ) ;
	}
});

$router->addRoute('/admin/add_post',function(){
	if($_SESSION['user']){
		$controller = new PostController();
		$controller->addPost();
	}else{
		header( 'Location: http://tmilner.co.uk' ) ;
	}
});

$router->addRoute('/admin/edit_post/:id',function($id){
	if($_SESSION['user']){
		$controller = new PostController();
		$controller->editPost($id);
	}else{
		header( 'Location: http://tmilner.co.uk' ) ;
	}
});

$router->addRoute('/admin/delete_post/:id',function($id){
	if($_SESSION['user']){
		$controller = new PostController();
		$controller->deletePost($id);
	}else{
		header( 'Location: http://tmilner.co.uk' ) ;
	}
});

$router->addRoute('/admin/login',function(){
	$controller = new AdminController();
	$controller->login();
});

$router->addRoute('/admin/logout',function(){
	if($_SESSION['user']){
		$controller = new AdminController();
		$controller->logout();
	}else{
		header( 'Location: http://tmilner.co.uk' ) ;
	}
});

$router->addRoute('/:permalink',function($permalink){
	$controller = new PostController();
	$controller->getPost($permalink);
});

$router->dispatch();

?>
