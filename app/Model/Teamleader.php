<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

APP::uses('AppModel','Model');

class Teamleader extends AppModel{
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
		'Manager' => array(
			'className' => 'Manager',
			'foreignKey' => 'manager_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
    );
    Public $hasMany = array(
        'Telecaller' => array(
            'className' => 'Telecaller',
            'foreign_key' => 'teamleader_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
}
