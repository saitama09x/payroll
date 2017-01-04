<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;

class StudentsController extends AppController{
	
	
	function beforeRender(Event $event){
		parent::usermodule();
	}
	
	function initialize() {
		parent::loadAllModels();
		$this->loadComponent('Flash');
		$this->viewBuilder()->layout('template_one');
	}

	function index(){
		$stud = $this->Students->find('all')->contain(['Gender']);
		$this->set(compact('stud'));
	}

	function add(){
		$student = $this->Students->newEntity();
		$gender = $this->Gender->find('list', ['keyField' => 'id', 'valueField' => 'type']);
		if($this->request->is('post')){
			$student = $this->Students->patchEntity($student, $this->request->data);
			if($this->Students->save($student)){
				$this->Flash->success(__('Successfully Added'));
				return $this->redirect(['action' => 'index']);
			}
		}
		$this->set(['student' => $student, 'gender' => $gender]);
	}


	function edit($id){
		$student = $this->Students->get($id);
		$gender = $this->Gender->find('list', ['keyField' => 'id', 'valueField' => 'type']);
		if($this->request->is(['post', 'put'])){
			$this->Students->patchEntity($student, $this->request->data);
			if($this->Students->save($student)){
				$this->Flash->success(__('Successfully Updated'));
				$this->redirect(['action' => 'index']);
			}

		}
		$this->set(['student' => $student, 'gender' => $gender]);
	}

	function delete($id){
		$this->request->allowMethod(['post', 'delete']);
		$student = $this->Students->get($id);
		if($this->Students->delete($student)){
			$this->Flash->success(__('Successfully Deleted'));
			$this->redirect(['action' => 'index']);
		}
	}


}