<?php
App::uses('AppModel', 'Model');
/**
 * Game Model
 *
 * @property Type $Type
 */
class Game extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	// The Associations below have been created with all possible keys, those that are not needed can be removed

	public $belongsTo = array(
		'Type' => array(
			'className' => 'Type',
			'foreignKey' => 'type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        
        public $hasMany = array(
		'ClientsGame'
	);
}
