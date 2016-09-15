<?php
App::uses('AppModel', 'Model');
/**
 * ClientsGame Model
 *
 * @property Client $Client
 * @property Game $Game
 */
class ClientsGame extends AppModel {



	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Client' => array(
			'className' => 'Client',
			'foreignKey' => 'client_id',

		),
		'Game' => array(
			'className' => 'Game',
			'foreignKey' => 'game_id',
		)
	);
        
        public function buy($client_id, $game_id)  {
            
            return $this->save(['client_id'=>$client_id,'game_id'=>$game_id]);
            
        }
}
