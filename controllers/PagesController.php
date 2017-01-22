<?php
class PagesController extends Controller{
	public function about(){
		$view = new View('about');
        $view->assign('message', $this->message);
        $view->assign('active', 'about');
        $view->render();
	}
}
?>
