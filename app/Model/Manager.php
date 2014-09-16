<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

APP::uses('AppModel','Model');

class Manager extends AppModel{
    public $actsAs = array('Containable');
    // public $primaryKey = "user_id";
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Superadmin' => array(
            'className' => 'Superadmin',
            'foreignKey' => 'superadmin_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
    Public $hasMany = array(
        'Teamleader' => array(
            'className' => 'Teamleader',
            'foreign_key' => 'manager_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
    
    
}