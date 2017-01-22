<?php class PostController extends Controller{

	public function index(){
		$post = Model::factory('Post')->order_by_desc('date_posted')->where('published', '1')->find_one();

		$next = Model::factory('Post')->raw_query('SELECT * FROM post WHERE id = (select min(id) from post where id > :id AND published = 1)', array('id' => $post->id))->find_one();
		$previous = Model::factory('Post')->raw_query('SELECT * FROM post WHERE id = (select max(id) from post where id < :id AND published = 1)', array('id' => $post->id))->find_one();

		$date = date('l d F Y', strtotime($post->date_posted));
		$post->date_posted = $date;
		$post->getTagLinks();

		if($post === null) $this->message = "Sorry, we cant find the post!";
		$view = new View($post->layout);
		$view->assign('post', $post);
		$view->assign('message', $this->message);
		$view->assign('next', $next->permalink);
		$view->assign('previous', $previous->permalink);
		$view->render();
	}

	public function archive($tag){
		if(isset($_GET['limit'])){
			$limit=$_GET['limit'];
		}else{
			$limit=10;
		}

		if(isset($tag)){
			$selectedTag = Model::factory('Tag')->where('tag', $tag)->find_one();
			if($selectedTag == null){
				$posts = Model::factory('Post')->order_by_desc('date_posted')->where('published', '1')->limit($limit)->find_many();
			}else{
				$posts = $selectedTag->posts()->order_by_desc('date_posted')->where('published', '1')->find_many();
			}
		}else{
			if(isset($_GET['page'])){
				$offset = $limit * ($_GET['page']-1);
				$posts = Model::factory('Post')->order_by_desc('date_posted')->where('published', '1')->limit($limit)->offset($offset)->find_many();
			}else{
				$posts = Model::factory('Post')->order_by_desc('date_posted')->where('published', '1')->limit($limit)->find_many();
			}
			$count = Model::factory('Post')->where('published', '1')->count();
		}

		$view = new View('list');
		foreach($posts as $post){
			$date = date('l d F Y', strtotime($post->date_posted));
			$post->date_posted = $date;
			$post->getTagLinks();
			$post->summary = trim(substr($post->content, 0, 500))."...";
		}
		$view->assign('posts', $posts);
		$view->assign('active', 'archive');
		$view->assign('title', 'Archive');
		$view->assign('message', $this->message);
		$view->assign('count', $count);
		$view->render();
	}

	public function getPost($permalink){
		$post = Model::factory('Post')->where('permalink', $permalink)->find_one();
		$next = Model::factory('Post')->raw_query('SELECT * FROM post WHERE id = (select min(id) from post where id > :id AND published = 1)', array('id' => $post->id))->find_one();
		$previous = Model::factory('Post')->raw_query('SELECT * FROM post WHERE id = (select max(id) from post where id < :id AND published = 1)', array('id' => $post->id))->find_one();

		$date = date('l d F Y', strtotime($post->date_posted));
		$post->date_posted = $date;
		$post->getTagLinks();

		if($post === null) $this->message = "Sorry, we cant find the post!";
		$view = new View($post->layout);
		$view->assign('post', $post);
		$view->assign('message', $this->message);
		$view->assign('next', $next->permalink);
		$view->assign('previous', $previous->permalink);
		$view->render();
	}

	public function addPost(){
		if(isset($_POST['title'])){
			$post = Model::factory('Post')->create();
			$post->title = $_POST['title'];
			$post->date_posted = $_POST['date_posted'];
			$post->author = $_SESSION['user']->id;
			$post->content = $_POST['content'];
			$post->image = $_POST['image'];
			$post->layout = $_POST['layout'];
			$post->permalink = substr(strtolower( str_replace(' ', '_', $post->title) ),0,30);

			if(isset($_POST['publish'])){
				$post->published = 1;
			}else{
				$post->published = 0;
			}

			$post->save();

			$tags = explode(', ', $_POST['tags']);

			//Add new tags.
			foreach($tags as $tag){
				$tag = trim($tag);
				$dbtag = Model::factory('Tag')->where('tag',$tag)->find_one();

				if($dbtag == false){
					$dbtag = Model::factory('Tag')->create();
					$dbtag->tag = trim($tag);
					$dbtag->save();
				}

				$tag = Model::factory('PostTag')->create();
				$tag->post_id = $post->id;
				$tag->tag_id = $dbtag->id;
				$tag->save();
			}

			if(isset($_POST['exit'])){
				header( 'Location: http://tmilner.co.uk/'.$post->permalink ) ;
				return;
			}
			$this->message = $_SESSION['message'] = "Post added sucessfuly";
		}
		$post = Model::factory('Post')->create();
		$post->date_posted = date('Y-m-d H:i:s');

		$view = new View('add_post');
		$view->assign('message', $this->message);
		$view->assign('action', '');
		$view->assign('post', $post);
		$view->assign('active', $this->active);
		$view->render();
	}

	public function editPost($id){
		$post = Model::factory('Post')->find_one($id);
		if(isset($_POST['title'])){
			$post->title = $_POST['title'];
			$post->author = $_SESSION['user']->id;
			$post->content = $_POST['content'];
			$post->image = $_POST['image'];
			$post->layout = $_POST['layout'];

			if(isset($_POST['publish'])){
				$post->published = 1;
			}else{
				$post->published = 0;
			}
			$post->save();

			foreach($post->tags()->find_many() as $tag){
				$tag->delete();
			}

			$tags = explode(', ', $_POST['tags']);

			//Add new tags.
			foreach($tags as $tag){
				$tag = trim($tag);
				$dbtag = Model::factory('Tag')->where('tag',$tag)->find_one();

				if($dbtag == false){
					$dbtag = Model::factory('Tag')->create();
					$dbtag->tag = trim($tag);
					$dbtag->save();
				}

				$tag = Model::factory('PostTag')->create();
				$tag->post_id = $post->id;
				$tag->tag_id = $dbtag->id;
				$tag->save();
			}

			if(isset($_POST['exit'])){
				header( 'Location: http://tmilner.co.uk/'.$post->permalink );
				return;
			}

			$this->message = $_SESSION['message'] = "Post edited sucessfuly";
		}

		$tags = array();
		foreach($post->tags()->find_many() as $tag){
			$tags[] = $tag->tag;
		}

		$post->tags = implode(', ', $tags);

		$view = new View('edit_post');
		$view->assign('message', $this->message);
		$view->assign('post', $post);
		$view->assign('active', $this->active);
		$view->render();
	}

	public function deletePost($id){
		$post = Model::factory('Post')->find_one($id);
		$post->delete();
		header( 'Location: http://tmilner.co.uk/admin' );
	}
}
?>
