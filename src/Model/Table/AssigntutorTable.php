<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class AssigntutorTable extends Table
{
 	
	public function initialize(array $config){

		$this->belongsTo('Employees', 
     		['className' => 'Employees', 
     		'foreignKey' => 'emp_id', 
     		'bindingKey' => 'id', 
     		'propertyName' => 'emps']);

		$this->belongsTo('Students',
			['className' => 'Students', 
     		'foreignKey' => 'stud_id', 
     		'bindingKey' => 'id', 
     		'propertyName' => 'stud']);
	}   


}

?>