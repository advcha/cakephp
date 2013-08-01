<?php
class UsersController extends AppController{
	public function index(){
		$this->User->recursive=0;
		$this->set('users',$this->paginate());
	}
	
	public function view($id=null){
		if(!$id){
			throw new NotFoundException(__('Invalid User'));
		}
		$user = $this->User->findById($id);
		if(!$user){
			throw new NotFoundException(__('Invalid User'));
		}
		$this->set('user',$user);
	}
	
	public function add(){
		if($this->request->is('post')){
			$this->User->create();
			if($this->User->save($this->request->data)){
				$this->Session->setFlash(__('The user has been saved.'));
				$this->redirect(array('action'=>'index'));
			}else{
				$this->Session->setFlash(__('The user could not be saved. Please try again'));
			}
		}
	}
	
	public function edit($id=null){
		if(!$id){
			throw new NotFoundException(__('Invalid User'));
		}
		$user = $this->User->findById($id);
		if(!$user){
			throw new NotFoundException(__('Invalid User'));
		}
		if($this->request->is('post') || $this->request->is('put')){
			$this->User->id = $id;
			if($this->User->save($this->request->data)){
				$this->Session->setFlash(__('The user has been updated.'));
				$this->redirect(array('action'=>'index'));
			}else{
				$this->Session->setFlash(__('Unable to update the user.'));
			}
		}
		if(!$this->request->data){
			$this->request->data = $user;
		}
	}
	
	public function delete($id){
		if(!$id){
			throw new NotFoundException(__('Invalid User'));
		}
		$user = $this->User->findById($id);
		if(!$user){
			throw new NotFoundException(__('Invalid User'));
		}
		if($this->request->is('get')){
			throw new MethodNotAllowedException();
		}
		if($this->User->delete($id)){
			$this->Session->setFlash(__('The user with id: %s has been deleted.',$id));
			$this->redirect(array('action'=>'index'));
		}
	}
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('add');
	}
	
	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash(__('Invalid username or password, try again'));
			}
		}
	}
	
	public function logout() {
		$this->redirect($this->Auth->logout());
	}
}