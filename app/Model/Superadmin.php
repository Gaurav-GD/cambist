<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel','Model');

class Superadmin extends AppModel{
    // public $primaryKey = "user_id";
    public $actsAs = array("Containable");
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    Public $hasMany = array(
        'Manager' => array(
            'className' => 'Manager',
            'foreign_key' => 'superadmin_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
}