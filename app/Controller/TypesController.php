<?php
App::uses('AppController', 'Controller');
/**
 * Types Controller
 *
 * @property Type $Type
 * @property PaginatorComponent $Paginator
 */
class TypesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Type->recursive = 0;
		$this->set('types', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Type->exists($id)) {
			throw new NotFoundException(__('Invalid type'));
		}
		$options = array('conditions' => array('Type.' . $this->Type->primaryKey => $id));
		$this->set('type', $this->Type->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
//	public function add() {
//		if ($this->request->is('post')) {
//			$this->Type->create();
//			if ($this->Type->save($this->request->data)) {
//				return $this->flash(__('The type has been saved.'), array('action' => 'index'));
//			}
//		}
//	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
//	public function edit($id = null) {
//		if (!$this->Type->exists($id)) {
//			throw new NotFoundException(__('Invalid type'));
//		}
//		if ($this->request->is(array('post', 'put'))) {
//			if ($this->Type->save($this->request->data)) {
//				return $this->flash(__('The type has been saved.'), array('action' => 'index'));
//			}
//		} else {
//			$options = array('conditions' => array('Type.' . $this->Type->primaryKey => $id));
//			$this->request->data = $this->Type->find('first', $options);
//		}
//	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
//	public function delete($id = null) {
//		$this->Type->id = $id;
//		if (!$this->Type->exists()) {
//			throw new NotFoundException(__('Invalid type'));
//		}
//		$this->request->allowMethod('post', 'delete');
//		if ($this->Type->delete()) {
//			return $this->flash(__('The type has been deleted.'), array('action' => 'index'));
//		} else {
//			return $this->flash(__('The type could not be deleted. Please, try again.'), array('action' => 'index'));
//		}
//	}
}
