<?php
class PostsController extends AppController{
	public $helpers = array('Html','Form','Session');
	public $components = array('Session');
	
	public function index(){
		$this->set('posts',$this->Post->find('all'));
	}
	
	public function view($id=null){
		/*$this->Post->id = $id;
		$this->set('post',$this->Post->read());*/
		if(!$id){
			throw new NotFoundException(__('Invalid Post'));
		}
		$post = $this->Post->findById($id);
		if(!$post){
			throw new NotFoundException(__('Invalid Post'));
		}
		$this->set('post',$post);
	}
	
	public function add(){
		if($this->request->is('post')){
			$this->Post->create();
			$this->request->data['user_id']=$this->Auth->user('id');
			if($this->Post->save($this->request->data)){
				$this->Session->setFlash(__('Your post has been saved.'));
				$this->redirect(array('action'=>'index'));
			}else{
				$this->Session->setFlash(__('Unable to add your post.'));
			}
		}
	}
	
	public function edit($id=null){
		if(!$id){
			throw new NotFoundException(__('Invalid Post'));
		}
		$post = $this->Post->findById($id);
		if(!$post){
			throw new NotFoundException(__('Invalid Post'));
		}
		if($this->request->is('post') || $this->request->is('put')){
			$this->Post->id = $id;
			if($this->Post->save($this->request->data)){
				$this->Session->setFlash(__('Your post has been updated.'));
				$this->redirect(array('action'=>'index'));
			}else{
				$this->Session->setFlash(__('Unable to update your post.'));
			}
		}
		if(!$this->request->data){
			$this->request->data = $post;
		}
	}
	
	public function delete($id){
		if(!$id){
			throw new NotFoundException(__('Invalid Post'));
		}
		$post = $this->Post->findById($id);
		if(!$post){
			throw new NotFoundException(__('Invalid Post'));
		}
		if($this->request->is('get')){
			throw new MethodNotAllowedException();
		}
		if($this->Post->delete($id)){
			$this->Session->setFlash(__('The post with id: %s has been deleted.',$id));
			$this->redirect(array('action'=>'index'));
		}
	}
	
	public function isAuthorized($user) {
		// All registered users can add posts
		if ($this->action === 'add') {
			return true;
		}

		// The owner of a post can edit and delete it
		if (in_array($this->action, array('edit', 'delete'))) {
			$postId = $this->request->params['pass'][0];
			if ($this->Post->isOwnedBy($postId, $user['id'])) {
				return true;
			}
		}

		return parent::isAuthorized($user);
	}
}