<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;
use Cake\Collection\Collection;

class ProfileController extends AppController{

	function beforeRender(Event $event){
		parent::usermodule();
	}

	function initialize() {
		parent::loadAllModels();
		$this->loadComponent('Flash');
		$this->viewBuilder()->layout('template_one');
	}


	function user(){
		$emp_id = $this->Auth->user('emp_id');

		$user = $this->Employees->findById($emp_id)->contain(['Gender', 'Empposition', 'Empstatus', 'Users'])->first();

		$ratings = $this->Studratings->findAllByEmpId($emp_id);
		$performace_rating = 0;
		if($ratings->count()){
			$collection = new Collection($ratings);
			$performace_rating  =  ($collection->sumOf('rating') / ($ratings->count() * 50)) * 100;
		}
		/*
		$no_stud = $this->Assigntutor->findAllByEmpId($emp_id)->group(['stud_id']);

		$tutor = $this->Assigntutor->findAllByEmpId($emp_id);
		$total_hrs= 0;
		$total_min = 0;
		if($tutor){
			foreach($tutor as $row){
				$start = date_create($row->start_time);
				$end = date_create($row->end_time);
				$total_hrs += intval(date_diff($start, $end)->format("%h"));
				$total_min += intval(date_diff($start, $end)->format("%i"));
				if($total_min > 59){
					$total_hrs++;
					$total_min = $total_min - 60;
				}
			}
		}
		
		$total_hrs = $total_hrs . " HRS " . $total_min . " MINS";
		*/
		$tutor = $this->Assigntutor->findAllByEmpId($emp_id)->contain(['Students']);

		$this->set(compact('user', 'performace_rating', 'no_stud', 'total_hrs', 'tutor'));
	}


	function changelogin(){
		$user = $this->Users;
		$update = $user->findByEmpId($this->Auth->user('emp_id'))->first();
		if($update){
			$update->username = $this->request->data['username'];
			$update->password = $this->request->data['password'];
			if($user->save($update)){
				$this->redirect(['action' => 'user']);
			}
		}
	}

	function updatepropic(){
		$pic = $this->request->data['orig_name_pic_btn'];            
        $emp_= $this->Employees;            
        $emp = $emp_->find('all')->where(['id' => $this->Auth->user('emp_id')])->first();            
        $emp->pro_pic = $pic;            
        $emp_->save($emp);            
        $this->redirect(['action' => 'user']);
	}

}