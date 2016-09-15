<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Games Controller
 *
 * @property Game $Game
 * @property PaginatorComponent $Paginator
 */
class GamesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Flash');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		//$this->Game->recursive = 0;
                $types = $this->Game->Type->find('list');
		$this->set('games', $this->Paginator->paginate());
                
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
//	public function view($id = null) {
//		if (!$this->Game->exists($id)) {
//			throw new NotFoundException(__('Invalid game'));
//		}
//		$options = array('conditions' => array('Game.' . $this->Game->primaryKey => $id));
//		$this->set('game', $this->Game->find('first', $options));
//	}

/**
 * buy method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function buy($id = null) {
		if (!$this->Game->exists($id)) {
			throw new NotFoundException(__('Invalid game'));
		}
		if ($this->request->is(array('post', 'put'))) {
                    $game = $this->Game->findById($id);
                    $client_id = $this->buying($game);
                    $ClientsGame = ClassRegistry::init('ClientsGame');
                    if ($ClientsGame->buy($client_id,$game['Game']['id'] )) {
                        $this->Game->save(array(
                                'id'=>$game['Game']['id'],
                                'amount'=> $game['Game']['amount']-1   
                            )); 
// Sending e-mail to admin -> last one is sol
                        if ($game['Game']['amount'] == 1) {
                            $Email = new CakeEmail('smtp');
                            $Email->from(array('info@pogrom.pl' => 'Sklep pogrom.pl'))
                                ->to('admin@admin.pl')
                                ->subject('Ostatni egzemplarz '.$game['Game']['name'])
                                  ->send('Sprzedano właśnie ostatni egzemplarz gry: '. $game['Game']['name']);    
                        }                        
// Sending e-mail to client with information about transaction              
                    $Email = new CakeEmail('smtp');
                    $Email->from(array('info@pogrom.pl' => 'Sklep pogrom.pl'))
                        ->to($this->request->data['Client']['email'])
                        ->subject('Nowy zakup')
                        ->send('Kupiłeś nową grę: '. $game['Game']['name']);
                        $this->Flash->success(__('Gratulujemy zakupy. Potwierdzenie zostało wysłane na podany adres e-mail'));
			return $this->redirect('/');
                    }
		}                				
	}
/**
 * buying method -> checking client existance and subscriptions
 *
 * @throws NotFoundException
 * @param string $game
 * @return void
 */        
        public function buying($game) {
            
            $ClientObj = ClassRegistry::init('Client');
            $Subscription = ClassRegistry::init('Subscription');
                        
//checking client id or creating new one                        
            $client = $ClientObj->findByEmail($this->request->data['Client']['email']);
            $subsribed = array();
            if(empty($client)) {
                $client = $ClientObj->save($this->request->data);   
                $Subscription->subscribe($client['Client']['id'], $game['Game']['type_id']);
            } else {
//checking subscription for client and type
                $subsribed = $Subscription->subscribed($client['Client']['id'], $game['Game']['type_id'] );
                if(empty($subsribed))   {
                   $Subscription->subscribe($client['Client']['id'], $game['Game']['type_id']);
                }
            }
            return $client['Client']['id'];
        }

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Game->recursive = 0;
		$this->set('games', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Game->exists($id)) {
			throw new NotFoundException(__('Invalid game'));
		}
		$options = array('conditions' => array('Game.' . $this->Game->primaryKey => $id));
		$this->set('game', $this->Game->find('first', $options));
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////   ADMIN //////////////////////////////////////////////////////////////////////////
/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Game->create();
			if ($this->Game->save($this->request->data)) {
                            $Subscription = ClassRegistry::init('Subscription');
                            $Client = ClassRegistry::init('Client');
                            
                            $game = $this->Game->findById($this->Game->id);
                            $recipients = $Subscription->subscribedByType($game['Type']['id']);

// Sending e-mail to subscribed clients             
                            $Email = new CakeEmail('smtp');
                            $Email->from(array('no-reply@pogrom.pl' => 'Sklep pogrom.pl'))
                                  ->to('info@pogrom.pl')
                                  ->bcc($recipients)
                                  ->subject('Nowy gra w sklepie pogrom.pl')
                                  ->send('Dodano nową grę'.$game['Game']['name'].' z gatunku '.$game['Type']['name']);
                            $this->Flash->success(__('The game has been saved.'));
                            return $this->redirect(array('action' => 'admin_index'));
			} else {
				$this->Flash->error(__('The game could not be saved. Please, try again.'));
			}
		}
		$types = $this->Game->Type->find('list');
		$this->set(compact('types'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Game->exists($id)) {
			throw new NotFoundException(__('Invalid game'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Game->save($this->request->data)) {
				$this->Flash->success(__('The game has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The game could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Game.' . $this->Game->primaryKey => $id));
			$this->request->data = $this->Game->find('first', $options);
		}
		$types = $this->Game->Type->find('list');
		$this->set(compact('types'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Game->id = $id;
		if (!$this->Game->exists()) {
			throw new NotFoundException(__('Invalid game'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Game->delete()) {
			$this->Flash->success(__('The game has been deleted.'));
		} else {
			$this->Flash->error(__('The game could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
