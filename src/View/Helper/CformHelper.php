<?php

namespace App\View\Helper;

use Cake\View\Helper;

class CformHelper extends Helper
{
	public $helpers = ['Form', 'Html', 'Url'];


	function schedule_btn($status, $id){
		
		if($status == 1){
			return $this->Html->link('Done', "#", ['class' => 'btn btn-sm btn-success', 'href' => '#', 'data-toggle' => 'modal', 'data-target' => '#rating_modal']);

		}else if($status == 2){
			return false;
		}

		return $this->Form->postLink('Start', ['action' => 'view', $id], ['class' => 'btn btn-sm btn-warning']);
	}

	function schedule_status($status){
		if($status == 0){
			return "<span style=\"color:#182bbb;\">(Not Yet Started)</span>";
		}else if($status == 1){
			return "<span style=\"color:#f39c12;\">(Started)</span>";
		}else if($status == 2){
			return "<span style=\"color:green;\">(Done)</span>";
		}
	}

	function radio_stars_full($rating, $value){
		$check = "";
		$value = (object) $value;
		if($rating == intval($value->value)){
			$check = 'checked';
		}
		$value = ($value);
		return "<input type=\"radio\" id=\"$value->id\" name=\"$value->name\" value=\"$value->value\" 
		{$check}/><label class = \"full\" for=\"$value->id\" title=\"$value->title\"></label>";
	}

	function radio_starts_half($rating, $value){
		$check = "";
		$value = (object) $value;
		if($rating == intval($value->value)){
			$check = 'checked';
		}
		return "<input type=\"radio\" id=\"$value->id\" name=\"$value->name\" value=\"$value->value\" 
		{$check}/><label class = \"half\" for=\"$value->id\" title=\"$value->title\"></label>";
	}

	function display_sidebar($modcode){		

		if($modcode == "DSHB"){
			return "<li class=\"treeview\">
				<a href=\"{$this->Url->build(['controller' => 'dashboard', 'action' => 'index'])}\"> <i
						class=\"fa fa-dashboard\"></i> <span>Dashboard</span>
				</a>
				</li>";
		}else if($modcode == "STDN"){
			return "<li class=\"treeview\"><a href=\"{$this->Url->build(['controller' => 'students', 'action' => 'index'])}\"> <i
						class=\"fa fa-dashboard\"></i> <span>Students</span>
				</a>
					<ul class=\"treeview-menu\">
						<li><a href=\"{$this->Url->build(['controller' => 'students', 'action' => 'add'])}\"><i
								class=\"fa fa-circle-o\"></i>add</a></li>
						<li class=\"active\"><a href=\"{$this->Url->build(['controller' => 'students', 'action' => 'index'])}\"><i
								class=\"fa fa-circle-o\"></i>View</a></li>
					</ul></li>";
		}else if($modcode == "EMPY"){
			return "<li class=\"treeview\"><a href=\"{$this->Url->build(['controller' => 'employees', 'action' => 'index'])}\"> <i
						class=\"fa fa-dashboard\"></i> <span>Employee</span>
				</a>
					<ul class=\"treeview-menu\">
						<li><a href=\"{$this->Url->build(['controller' => 'employees', 'action' => 'add'])}\"><i class=\"fa fa-circle-o\"></i>add</a></li>
						<li class=\"active\"><a href=\"{$this->Url->build(['controller' => 'employees', 'action' => 'index'])}\"><i
								class=\"fa fa-circle-o\"></i>View</a></li>					
					</ul></li>";
		}else if($modcode == "ACCT"){
			return "<li class=\"treeview\"><a href=\"#\"> <i
						class=\"fa fa-dashboard\"></i> <span>Accounting</span>
				</a>
					
				<ul class=\"treeview-menu\">
					<li><a href=\"{$this->Url->build(['controller' => 'salaries', 'action' => 'index'])}\"><i class=\"fa fa-circle-o\"></i>Salary</a></li>						
					<li><a href=\"{$this->Url->build(['controller' => 'salaries', 'action' => 'payslip'])}\"><i class=\"fa fa-circle-o\"></i>PaySlip</a></li>
				</ul></li>";
		}else if($modcode == "ATDC"){
			return "<li class=\"treeview\"><a href=\"{$this->Url->build(['controller' => 'attendance', 'action' => 'index'])}\"> <i
						class=\"fa fa-dashboard\"></i> <span>Attendance</span>
				</a>
					<ul class=\"treeview-menu\">
						<li><a href=\"{$this->Url->build(['controller' => 'attendance', 'action' => 'add'])}\"><i class=\"fa fa-circle-o\"></i>add</a></li>
						<li class=\"active\"><a href=\"{$this->Url->build(['controller' => 'attendance', 'action' => 'index'])}\"><i
								class=\"fa fa-circle-o\"></i>View</a></li>
					</ul></li>";
		}else if($modcode == "MTCN"){
			return "<li class=\"treeview\"><a href=\"{$this->Url->build(['controller' => 'maintenance', 'action' => 'index'])}\"> <i
						class=\"fa fa-dashboard\"></i> <span>Maintenance</span>
				</a>
					<ul class=\"treeview-menu\">
						<li><a href=\"{$this->Url->build(['controller' => 'maintenance', 'action' => 'usermodule'])}\"><i class=\"fa fa-circle-o\"></i>User Modules</a></li>
					</ul></li>";
		}

	}

}