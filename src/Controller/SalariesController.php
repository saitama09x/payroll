<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\Collection\Collection;
use Cake\Event\Event;

class SalariesController extends AppController{


function beforeRender(Event $event){
    parent::usermodule();
}


function initialize() {
parent::loadAllModels();
$this->loadComponent('Flash');
$this->viewBuilder()->layout('template_one');
}


function index(){


}   

function date(){
$from = strtotime($this->request->query("from"));
$to = strtotime($this->request->query("to"));

$emps = $this->Employees->find('list', ['keyField' => 'id', 'valueField' => function($q){
return $q->get('fname') . " " . $q->get('lname');
}]);        

$from = date("Y-m-d", $from);
$to = date("Y-m-d", $to);
$slip = $this->Payslip->find('all')->where(['cutoff_from' => $from, 'cutoff_to' => $to]);

$attend = array();
$log_arr = array();
$total_hr = 0;
$total_min = 0;
$total_work = 0;
$gross = 0;
$deduction = 0;
$net = 0;
$allowance = 0;
$emp_name = "";
if($this->request->is('post')){

$emp_id = $this->request->data['emps'];
$emp_name = $this->Employees->findById($emp_id)->first();
$emp_name = $emp_name->fname . " " . $emp_name->lname;

$attend = $this->Attendance->find('all', ['conditions' => ["(Attendance.date_created between '{$from}' and '{$to}') and Attendance.emp_id = '{$emp_id}'"]])->contain(['Empshifting']);
$salaries = $this->Salaries->findByEmpId($emp_id)->first();
$deductpercent = $this->Deductionpercent->findAllByEmpId($emp_id)->contain(['Deductions']);
$allowances = $this->Allowances->findAllByEmpId($emp_id);
if($salaries){
    $gross = number_format(($salaries->amount / 30) * $attend->count(), "2", ".", "");
    if($deductpercent->count()){
        foreach($deductpercent as $row){
            $deduction += $gross * $row->percentage;
        }
    }
    if($allowances->count()){
        $collection = new Collection($allowances);
        $allowance =  $collection->sumOf('amount');
    }
    $net = ($gross - $deduction) + $allowance;
}

foreach($attend as $row){
$late = '00:00:00';
$overtime = '00:00:00';
$undertime = '00:00:00';
$total_hr += intval($row->time_diff->format('%h'));
$total_min += intval($row->time_diff->format('%i'));

if($total_min > 59){
    $total_hr++;
    $total_min = $total_min - 60;
}

if(date_diff($row->created_start, $row->shifting->created_start)->format('%r') == "-"){
$late = date_diff($row->created_start, $row->shifting->created_start)->format('%r%h:%s:%i');
}

if(date_diff($row->shifting->created_end, $row->created_end)->format('%r%') == ""){
$overtime = date_diff($row->shifting->created_end, $row->created_end)->format('%r%h:%s:%i');
}

if(date_diff($row->shifting->created_end, $row->created_end)->format('%r') == "-"){
$undertime = date_diff($row->shifting->created_end, $row->created_end)->format('%r%h:%s:%i');
}

$log_arr[] = (object) array('date' => $row->date_created, 'check_in' => $row->start_time, 
'check_out' => $row->end_time, 'start_pic' => $row->attendance_start_pic,
'end_pic' => $row->attendance_end_pic, 'late' => $late, 'overtime' => $overtime, 
'undertime' => $undertime, 'work_hr' => $row->time_diff->format('%h:%i:%s'));

}
$total_work = $total_hr . ":" . $total_min . ":" . "00";

if(isset($this->request->data['print'])) {
    $payslip = $this->Payslip->newEntity();
    $payslip->emp_id = $emp_id;
    $payslip->gross_pay = $gross;
    $payslip->allowances = $allowance;
    $payslip->deductions = $deduction;
    $payslip->net_pay = $net;
    $payslip->cutoff_from = $from;
    $payslip->cutoff_to = $to;
    $payslip->date_created = date("Y-m-d", time());
    if($this->Payslip->save($payslip)){
        $this->redirect(['action' => 'view', $payslip->id]);
    }
}
}

$this->set(compact('slip', 'emps', 'from', 'to', 
    'log_arr', 'total_work', 'gross', 'deduction', 'deductpercent', 
    'allowance', 'net', 'emp_name', 'salaries', 'emp_id'));

}

function payslip(){

    $emps = $this->Employees->find("list", ['KeyField' => 'id', 'valueField' => function($q){
            return $q->get('fname') . " " . $q->get('lname');
    }]);

    $empid = $this->request->query('empid');
    $payslip = array();
    if(isset($empid)){
        $payslip = $this->Payslip->findAllByEmpId($empid);
    }

    $this->set(compact('emps', 'payslip'));
}

function view($id){

    $payslip = $this->Payslip->findById($id)->contain(['Employees', 'Deductionpercent' => ['Deductions'],
        'Allowances'])->first();    

    $this->set(compact('payslip'));
}

function printem($id){

    $this->viewBuilder()->layout(false);

    $payslip = $this->Payslip->findById($id)->contain(['Employees', 'Deductionpercent' => ['Deductions'],
        'Allowances'])->first();    

    $this->set(compact('payslip'));
}

}

