<?php
App::uses('AppModel', 'Model');
/**
 * Subscription Model
 *
 * @property Client $Client
 * @property Type $Type
 */
class Subscription extends AppModel {

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
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Type' => array(
			'className' => 'Type',
			'foreignKey' => 'type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        
 /**
 * Subscribe client to type and return result
 *
 * @param int $id, int $type_id
 * @return array
 */       
        public function subscribe($client_id, $type_id)  {
            
            return $this->save(['client_id'=>$client_id,'type_id'=>$type_id]);
            
        }

/**
 * Check subscription client to type and return result
 *
 * @param int $client_id, int $type_id
 * @return array
 */               
        public function subscribed($client_id, $type_id)  {
            return $this->findByClient_idAndType_id($client_id,$type_id);
        }
        
/**
 * Check subscription clients to type and return result
 *
 * @param int $type_id
 * @return array
 */               
        public function subscribedByType($type_id)  {
            $data = array();
            foreach ($this->find('all', array(
                    
//                    'contain' =>array('Client.id', 'Client.email'),
                'fields' => array('Client.email'),     
                'conditions' => array('Subscription.type_id' => $type_id))) as $value)
            {
                $data[] = $value['Client']['email'];
            }
           
            return $data;
        }        
}
