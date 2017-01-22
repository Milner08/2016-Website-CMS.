<?php
	class User extends Model{
		public function posts(){
            return $this->has_many('Post');
        }
	}
?>