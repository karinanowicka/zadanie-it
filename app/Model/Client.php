<?php
App::uses('AppModel', 'Model');
/**
 * Client Model
 *
 */
class Client extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'email';
/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Subscription', 'ClientsGame'
	);


}
