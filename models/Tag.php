<?php
class Tag extends Model {
	public function posts(){
    	return $this->has_many_through('Post');
    }
}
?>
