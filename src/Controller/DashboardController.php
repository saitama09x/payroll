<?php


namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;
use App\Controller\AppController;
use Cake\Routing\Router;
use Cake\Collection\Collection;

class DashboardController extends AppController{              

function beforeFilter(Event $event)
{
	parent::beforeFilter($event);        
}

function beforeRender(Event $event){
	parent::usermodule();
}

function initialize() {
parent::loadAllModels();
$this->viewBuilder()->layout('template_one');
}

function user(){
	$this->autoRender = false;	
}

function index(){
$query = $this->Assigntutor->find('all');
$this->set(compact('query'));
}

function ajaxTotalTime(){
$this->autoRender = false;
$emp_query = $this->Employees->find('all');

$xAxis = array();
$data = array();
foreach($emp_query as $emp){
$ratings = $this->Studratings->findAllByEmpId($emp->id);
$xAxis[] = $emp->fname . " " . $emp->lname;
$performace_rating = 0;
if($ratings->count()){
$collection = new Collection($ratings);
$performace_rating  =  ($collection->sumOf('rating') / ($ratings->count() * 50)) * 100;
}
$data[] = $performace_rating;
}

$chart["chart"] = array("type" => "column");
$chart["title"] = array("text" => "Teacher Performance Rating");
$chart["subtitle"] = array("text" => "Total Percentage");
$chart["xAxis"] = array("categories" => $xAxis);	
$chart["yAxis"] = array("title" => array("Percentage"));
$chart["series"] = array(array("name" => "Total Percentage", "data" => $data));
echo json_encode($chart);
}

function schedulingcalender(){

	$this->autoRender = false;

	$sched = $this->Assigntutor->find('all')->contain(['Employees', 'Students']);
	foreach($sched as $row){
		$teacher = $row->emps->fname . " " . $row->emps->lname;
		$student = $row->stud->fname . " " . $row->stud->lname;
		$starttime = date('H:i:s', strtotime($row->assign_time));
		$startdate = date('Y-m-d', strtotime($row->assign_date));;
		$url = "javascript:void(0)";
		$bgcolor = "#f39c12";
		$statusname = "Not Started";

		if($row->status == 0){
			$url = Router::url(['controller' => 'dashboard', 'action' => 'view',  $row->id]);			
		}
		else if($row->status == 1){
			$bgcolor = "#00c0ef";
			$statusname = "Started";
		}
		else if($row->status == 2){
			$bgcolor = "#00a65a";
			$statusname = "Done";
		}

		$set['events'][] = array('title' => "Teacher: {$teacher}<br />Student: {$student}<br />Description: {$row->subject}<br />Status: {$statusname}",
			'start' => "{$startdate}T{$starttime}", "url" => $url, 
			"backgroundColor" => $bgcolor);	
	}

	echo json_encode($set);

}


function processtutor($id, $status){
	$this->autoRender = false;
	if($status == 1){
		$tutor = $this->Assigntutor->get($id);
		$tutor->start_date = date("Y-m-d", time());
		$tutor->start_time = date("H:i:s", time());
		$tutor->status = 1;
		$this->Assigntutor->save($tutor);
		$this->Flash->success("Successfully Updated");
		$this->redirect(['action' => 'index']);
	}else if($status == 2)	{
		$tutor = $this->Assigntutor->get($id);
		$tutor->end_date = date("Y-m-d", time());
		$tutor->end_time = date("H:i:s", time());
		$tutor->status = 2;
		$this->Assigntutor->save($tutor);
		$this->Flash->success("Successfully Updated");
		$this->redirect(['action' => 'index']);
	}
}

function add(){		
$tutor = $this->Assigntutor->newEntity();
$teacher = $this->Employees->find('list', ['keyField' => 'id', 'valueField' => function($q){
return $q->get('fname') . " " . $q->get('lname');
}])->contain(['Empposition'])->where(['Empposition.name' => 'Teacher']);

$student = $this->Students->find('list', ['keyField' => 'id', 'valueField' => function($q){
return $q->get('fname') . " " . $q->get('lname');
}]);

$room = $this->Classrooms->find('list', ['keyField' => 'id', 'valueField' => 'name']);

if($this->request->is('post')){
$emp_id = $this->request->data['emp_id'];
$assign_date = $this->request->data['assign_date'];
$assign_time = $this->request->data['assign_time'];
$exist = $this->Assigntutor->findByEmpIdAndAssignDateAndAssignTime($emp_id, $assign_date, $assign_time);

if($exist->count()){
	$this->Flash->error("You Have Conflict Schedule");	
}

$tutor = $this->Assigntutor->patchEntity($tutor, $this->request->data);

if($tutor->errors()){
	$this->Flash->error(__('Please fill up the form'));
}

if($this->Assigntutor->save($tutor)){
$this->Flash->success('Successfully Added');
$this->redirect(['action' => 'index']);
}
}

$this->set(['tutor' => $tutor, 'teacher' => $teacher, 'student' => $student, 'room' => $room]);

}

function view($id){
$tutor = $this->Assigntutor->findById($id)->contain(['Employees', 'Students'])->first();

$rating = $this->Studratings->newEntity();
$checkrating = $this->Studratings->findBySchedId($id)->first();
$ratingval = ['50' => 'Excellent', '40' => 'Very Good', '30' => 'Good', '20' => 'Poor', '10' => 'Bad'];
$check = 0;
if($checkrating){
	$check = intval($checkrating->rating);
}

if($this->request->is(['post', 'put'])){
	$update = $this->Assigntutor->get($id);
	if($tutor->status == 0){
		$update->status = 1;		
		if($this->Assigntutor->save($update)){
			$this->redirect(['action' => 'view', $id]);
		}
	}else if($tutor->status == 1){
		$patch = $this->Studratings->patchEntity($rating, $this->request->data);
		$patch->emp_id = $tutor->emp_id;
		$patch->stud_id = $tutor->stud_id;
		$patch->sched_id = $id;
		$update->status = 2;
		if($this->Studratings->save($patch) && $this->Assigntutor->save($update)){
			$this->redirect(['action' => 'view', $id]);
		}
	}
}

$this->set(compact('tutor', 'id', 'checkrating', 'ratingval', 'check', 'rating'));

}

function edit($id){

$teacher = $this->Employees->find('list', ['keyField' => 'id', 'valueField' => function($q){
	return $q->get('fname') . " "  . $q->get('lname');
}]);

$student = $this->Students->find('list', ['keyField' => 'id', 'valueField' => function($q){
	return $q->get('fname') . " "  . $q->get('lname');
}]);

$tutor = $this->Assigntutor->get($id);

if($this->request->is(['post', 'put'])){
	$this->Assigntutor->patchEntity($tutor, $this->request->data);
	if($this->Assigntutor->save($tutor)){
		$this->redirect(['action' => 'view', $id]);
		return;
	}
}


$this->set(compact('teacher', 'student', 'tutor'));

}

}