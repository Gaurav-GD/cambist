<?php
	
	APP::uses('AppController','Controller');

	class TelecallersController extends AppController{

		public $uses = array(
	        "Role" ,
	        "User",
	        "Telecaller",
	        "Superadmin",
	        "Teamleader",
	        "Manager",
	        "TelecallersAllocationmaster"
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
			if ( $user['role'] === 'TeleCaller'){
				if( $this->action === 'index' || $this->action === 'add' || $this->action === 'edit' || $this->action === 'delete' || $this->action === 'task_list' || $this->action === 'task_feedback'){
					return true;
				}
			}else{
				return false;
			}
		}

	    public function index() {
	    	// $users = $this->Telecaller->find('all');
	    	// $this->preprint($this->Auth->user());
	        $this->paginate = array(
	            'limit' => 20,
	            'conditions' => array('User.role' => 'TeleCaller'),
	            'order' => array('User.username' => 'asc')
	        );
	        $users = $this->paginate('User');
	        // $this->preprint($users);
	        $this->set(compact('users'));
	    }

	    public function add() {
	        $user = $this->Auth->user();
	        if ($this->request->is('post')) {
	        	$this->request->data['User']['created_by'] = $user['id'];
	        	// echo"<pre>";print_r($this->request->data);exit;
	            $this->User->create();
	            if ($this->User->save($this->request->data)) {
	            	$telecaller['teamleader_id'] = $this->request->data['User']['teamleader_id'] ;
	            	$telecaller['active'] = $this->request->data['User']['active'] ;
	            	$this->Telecaller->save($telecaller);
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


	    public function task_list(){
	    	$tc_id = $this->Auth->user('id');
	    	$tc_username = $this->Auth->user('username');

	    	$tasks = $this->TelecallersAllocationmaster->find('all',array(
	    			"contain" => false,
	    			"fields" => "Allocationmaster.*",
	    			"joins" => array(
	    				array(
	    					"table" => "allocationmasters",
		    				"alias" => "Allocationmaster",
		    				"type" => "INNER",
		    				"conditions" => "TelecallersAllocationmaster.allocationmaster_id = Allocationmaster.id"
	    				)
	    			),
	    			"conditions" => array(
	    				"TelecallersAllocationmaster.telecaller_id" => $tc_id,
	    			)
	    		)

	    	);

	    	$this->set(compact('tasks'));
	    }

	    public function task_feedback($task_id){
	    	$this->set(compact('task_id'));

	    }

	    
	}
?>