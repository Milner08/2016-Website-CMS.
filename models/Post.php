<?php
use \Michelf\MarkdownExtra;
class Post extends Model {
	public function author(){
    	return $this->belongs_to('User');
    }
    public function tags(){
    	return $this->has_many_through('Tag');
    }
    public function getTagLinks(){
        $tags = [];
        foreach($this->tags()->find_many() as $tag){
            $tags[] = "<a href='/archive/".$tag->tag."'>".$tag->tag."</a>";
        }
        $this->tags = implode(', ', $tags);
    }
		/*public function getNext($id){
			//(select min(id) from post where id > $id)
			return $this
		}
		public function getPrevious($id){
			//(select min(id) from post where id > $id)
			return $this->raw_query("select * from post where id = (select max(id) from post where id < $id) AND published = 1");
		}*/
    public static function convertContent($content){
        $pattern = '/\[gallery id=(\d+)\]/';
        $replacement = "<div style='position: relative; padding-bottom: 76%; height: 0; overflow: hidden;'><iframe id='iframe' src='http://flickrit.com/slideshowholder.php?height=75&size=big&setId=$1&caption=true&counter=true&thumbnails=1&transition=0&layoutType=responsive&sort=0' scrolling='no' frameborder='0' style='width:100%; height:100%; position: absolute; top:0; left:0;'></iframe></div>";
        $content = preg_replace($pattern, $replacement, $content);
        $content = MarkdownExtra::defaultTransform($content);
        return $content;
    }
}
?>
