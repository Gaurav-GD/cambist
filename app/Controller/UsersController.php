<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

class UsersController extends AppController {

    public $uses = array(
        "Role" ,
        "User",
        "Superadmin"
    );
    
    public $paginate = array(
        'limit' => 25,
        'conditions' => array('status' => '1'),
        'order' => array('User.username' => 'asc')
    );

    public function beforeFilter() {
        parent::beforeFilter();
        $this->layout = 'admin_layout';
    }

    public function login() {
       // echo '<pre>';print_r($this->request->data);exit;
        //phpinfo();
        $this->layout = 'login_layout';
        if ($this->Session->check('Auth.User')) {
            $this->redirect(array('action' => 'index'));
        }

        // if we get the post information, try to authenticate
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $user = $this->Auth->user();
                if(!empty($user)){
                    if($user['role'] == 'SuperAdmin'){
                        $this->Session->setFlash('Welcome, ' . ucfirst($user['username']),'',array(),'success');
                        $this->redirect(array('controller' => 'Superadmins','action' => 'index'));
                    }elseif($user['role'] == 'Manager'){
                        $this->Session->setFlash('Welcome, ' . ucfirst($user['username']),'',array(),'success');
                        $this->redirect(array('controller' => 'Managers','action' => 'index'));
                    }elseif($user['role'] == 'TeamLeader'){
                        $this->Session->setFlash('Welcome, ' . ucfirst($user['username']),'',array(),'success');
                        $this->redirect(array('controller' => 'Teamleaders','action' => 'index'));
                    }else{
                        $this->Session->setFlash('Welcome, ' .  ucfirst($user['username']),'',array(),'success');
                        $this->redirect(array('controller' => 'Telecallers','action' => 'task_list'));
                    }
                }else{
                    $this->Session->setFlash('Login failed Please try again','',array(),'error');
                }
                //$this->Session->setFlash(__('Welcome, ' . $this->Auth->user('username')));
                //$this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Session->setFlash('Invalid username or password','',array(),'error');
            }
        }
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }

    public function index() {
        $this->paginate = array(
            'limit' => 6,
            'order' => array('User.username' => 'asc')
        );
        $users = $this->paginate('User');
        $this->set(compact('users'));
    }

    public function add() {
        if ($this->request->is('post')) {
//echo"<pre>";print_r($this->request->data);exit;
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been created'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be created. Please, try again.'));
            }
        }
        $role_list = $this->Role->find('list',array("fields" => "Role.name"));
        $this->set(array('role_list' => $role_list));
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
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been updated'));
                $this->redirect(array('action' => 'edit', $id));
            } else {
                $this->Session->setFlash(__('Unable to update your user.'));
            }
        }

        if (!$this->request->data) {
            $this->request->data = $user;
            $role_list = $this->Role->find('list',array("fields" => "Role.name"));
            $this->set(array('role_list' => $role_list));
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
