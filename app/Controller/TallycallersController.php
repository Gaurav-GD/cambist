<?php
	
	APP::uses('AppController','Controller');

	class TallycallersController extends AppController{

		public $uses = array(
	        "Role" ,
	        "User",
	        "Tallycaller",
	        "Superadmin",
	        "Teamleader",
	        "Manager"
	    );
	    
	    public $paginate = array(
	        'limit' => 25,
	        'conditions' => array('status' => '1'),
	        'order' => array('User.username' => 'asc')
	    );

	    public function beforeFilter() {
	        parent::beforeFilter();
	    }

	    public function isAuthorized($user){
			if ( $user['role'] === 'TallyCaller'){
				if( $this->action === 'index' || $this->action === 'add' || $this->action === 'edit' || $this->action === 'delete' ){
					return true;
				}
			}else{
				return false;
			}
		}

	    public function index() {
	    	// $users = $this->Tallycaller->find('all');
	    	// $this->preprint($users);
	        $this->paginate = array(
	            'limit' => 20,
	            'conditions' => array('User.role' => 'TallyCaller'),
	            'order' => array('User.username' => 'asc')
	        );
	        $users = $this->paginate('User');
	        $this->set(compact('users'));
	    }

	    public function add() {
	        $user = $this->Auth->user();
	        if ($this->request->is('post')) {
	        	$this->request->data['User']['created_by'] = $user['id'];
	        	// echo"<pre>";print_r($this->request->data);exit;
	            $this->User->create();
	            if ($this->User->save($this->request->data)) {
	            	$tallycaller['teamleader_id'] = $this->request->data['User']['teamleader_id'] ;
	            	$tallycaller['active'] = $this->request->data['User']['active'] ;
	            	$this->Tallycaller->save($tallycaller);
            		$this->Session->setFlash(__('The user has been created'));
                	$this->redirect(array('action' => 'index'));	
	            	
	            } else {
	                $this->Session->setFlash(__('The user could not be created. Please, try again.'));
	            }
	        }else{
	        	if($user['role'] == 'SuperAdmin' || $user['role'] == 'Manager'){
		        	$teamleaders = $this->Teamleader->find('all');
		        	$this->set(compact('teamleaders'));
	        	}else{
	        		$this->set(compact('user'));
	        	}
	        	// ,array('contain'=> false)
	        }
	    }

	    public function edit($id = null) {
			if (!$id) {
	            $this->Session->setFlash('Please provide a user id');
	            $this->redirect(array('action' => 'index'));
	        }

	        $user = $this->User->findById($id);
	        if (!$user) {
	            $this->Session->setFlash('Invalid User ID Provided');
	            $this->redirect(array('action' => 'index'));
	        }

	        if ($this->request->is('post') || $this->request->is('put')) {
	            $this->User->id = $id;
	        // echo"<pre>";print_r($this->request->data);exit;
	            if ($this->User->save($this->request->data)) {
	                $this->Session->setFlash(__('The user has been updated'));
	                $this->redirect(array('action' => 'index'));
	            } else {
	                $this->Session->setFlash(__('Unable to update your user.'));
	            }
	        }
	        if (!$this->request->data) {
	            $this->request->data = $user;
	        }
	    }

	    public function delete($id = null) {

	        if (!$id) {
	            $this->Session->setFlash('Please provide a user id');
	            $this->redirect(array('action' => 'index'));
	        }

	        $this->User->id = $id;
	        if (!$this->User->exists()) {
	            $this->Session->setFlash('Invalid user id provided');
	            $this->redirect(array('action' => 'index'));
	        }
	        if ($this->User->saveField('status', 0)) {
	            $this->Session->setFlash(__('User deleted'));
	            $this->redirect(array('action' => 'index'));
	        }
	        $this->Session->setFlash(__('User was not deleted'));
	        $this->redirect(array('action' => 'index'));
	    }

	    public function activate($id = null) {
	        if (!$id) {
	            $this->Session->setFlash('Please provide a user id');
	            $this->redirect(array('action' => 'index'));
	        }

	        $this->User->id = $id;
	        if (!$this->User->exists()) {
	            $this->Session->setFlash('Invalid user id provided');
	            $this->redirect(array('action' => 'index'));
	        }
	        if ($this->User->saveField('status', 1)) {
	            $this->Session->setFlash(__('User re-activated'));
	            $this->redirect(array('action' => 'index'));
	        }
	        $this->Session->setFlash(__('User was not re-activated'));
	        $this->redirect(array('action' => 'index'));
	    }

	    
	}
?>