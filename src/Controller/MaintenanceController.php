<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;

class MaintenanceController extends AppController{


	function beforeRender(Event $event){
		parent::usermodule();
	}

	function initialize() {
		parent::loadAllModels();
		$this->loadComponent('Flash');
		$this->viewBuilder()->layout('template_one');
	}

	function usermodule(){

		$emps = $this->Employees->find('list', ['KeyField' => 'id', 'valueField' => function($q){
			return $q->get('fname') . " " . $q->get('lname');
		}]);
		$module = $this->Modules->find('all');
		$mod_arr = array();
		foreach($module as $row){
			$mod_arr[$row->modcode] = $row->modname;
		}
		$usermod = $this->Employees->find('all')->contain(['Usermodule' => ['Modules']]);
		$this->set(compact('usermod', 'emps', 'mod_arr'));
	}

	function addusermodule(){
		$this->request->allowMethod('post');
		$new = $this->Usermodule;
		$find = $new->findByEmpIdAndModcode($this->request->data['emp_id'], 
			$this->request->data['modcode']);
		if(!$find->count()){
			$new = $new->newEntity();
			$new = $this->Usermodule->patchEntity($new, $this->request->data);
			if($this->Usermodule->save($new)){
				$this->redirect(['action' => 'usermodule']);
			}
		}		
	}

	function deletemod($id){
		$this->request->allowMethod(['post', 'put']);
		$id = $this->Usermodule->get($id);
		if($this->Usermodule->delete($id)){
			$this->redirect(['action' => 'usermodule']);
		}
	}


}