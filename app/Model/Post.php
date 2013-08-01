<?php
class Post extends AppModel{
	public $validate = array(
		'title'=>array('rule'=>'NotEmpty'),
		'body'=>array('rule'=>'NotEmpty')
	);
	
	public function isOwnedBy($post, $user) {
		return $this->field('id', array('id' => $post, 'user_id' => $user)) === $post;
	}
}