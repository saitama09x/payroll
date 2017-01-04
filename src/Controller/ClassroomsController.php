<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;


class ClassroomsController extends AppController{

	
	function beforeRender(Event $event){
		parent::usermodule();
	}

	function initialize() {
		parent::loadAllModels();
		$this->loadComponent('Flash');
		$this->viewBuilder()->layout('template_one');
	}


	function index(){
		$rooms = $this->Classrooms->find('all');
		$this->set(compact('rooms'));
	}

	function add(){
		$room = $this->Classrooms->newEntity();
		if($this->request->is('post')){
			$room = $this->Classrooms->patchEntity($room, $this->request->data);
			if($this->Classrooms->save($room)){
				$this->Flash->success(__('Successfully Added'));
				$this->redirect(['action' => 'index']);
			}
		}
		$this->set(['room' => $room]);
	}


}