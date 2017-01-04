<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;

class AttendanceController extends AppController{

	
	function beforeRender(Event $event){
		parent::usermodule();
	}

	function initialize() {
		parent::loadAllModels();
		$this->loadComponent('Flash');
		$this->viewBuilder()->layout('template_one');
	}

	function index(){
		$from = $this->request->query("from");
		$to = $this->request->query("to");

		$attend = $this->Attendance->find('all')->contain(['Employees', 'Empshifting']);

		if(!empty($from) && !empty($to)){
			$from = date('Y-m-d', strtotime($from));
			$to = date('Y-m-d', strtotime($to));
			$attend = $this->Attendance->find('all', ["conditions" => "
				Attendance.date_created between '{$from}' and '{$to}'"])->contain(['Employees', 'Empshifting']);
		}
		
		$this->set(compact('attend'));
	}	

	function addattendance(){
		$this->autoRender = false;
		$photo = $this->request->data['photo'];
		$type = $this->request->data['type'];

		$attend = $this->Attendance->newEntity();
		$emp_id = $this->Auth->user('emp_id');
		$shifting = $this->Empshifting->findByEmpId($emp_id);

		if($type == "time_in"){
			$today = $this->Attendance->findByEmpIdAndDateCreated($emp_id, date('Y-m-d', time()));
			if($today->count()){
				$today = $today->first();
				$attend = $this->Attendance->get($today->id);
				$attend->start_time = date('H:i:s', time());
				$attend->attendance_start_pic = $photo;				
			}else{
				$attend->emp_id = $emp_id;
				$attend->start_time = date("H:i:s", time());
				$attend->end_time = '00:00:00';
				$attend->shifting_id = ($shifting->count()) ? $shifting->first()->id : 0;
				$attend->attendance_start_pic = $photo;
			}			
		}

		if($type == "time_out"){
			$today = $this->Attendance->findByEmpIdAndDateCreated($emp_id, date('Y-m-d', time()));
			if($today->count()){
				$today = $today->first();
				$attend = $this->Attendance->get($today->id);
				$attend->attendance_end_pic = $photo;
				$attend->end_time = date('H:i:s', time());
			}
		}

		if($this->Attendance->save($attend)){
			echo "true";
			return;
		}
		echo "false";
		return;
	}	

	function view($id){
		$attend = $this->Attendance->findById($id)->contain(['Employees' => ['Empstatus'], 'Empshifting'])->first();
		$this->set(compact('attend'));
	}

}

?>