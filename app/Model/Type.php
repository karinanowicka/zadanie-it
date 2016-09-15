<?php
App::uses('AppModel', 'Model');
/**
 * Type Model
 *
 * @property Game $Game
 */
class Type extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
        var $name = 'Type';
	public $hasMany = array(
		'Game', 'Subscription'
	);

}
