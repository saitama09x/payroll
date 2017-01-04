<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class SalariesTable extends Table
{
	
    public function initialize(array $config){

     	$this->belongsTo('Employees', 
     		['className' => 'Employees', 
     		'foreignKey' => 'emp_id', 
     		'bindingKey' => 'id', 
     		'propertyName' => 'emps']);
        
        $this->belongsTo('Salarytype', 
                [
                'className' => 'Salarytype', 
     		'foreignKey' => 'type', 
     		'bindingKey' => 'id', 
     		'propertyName' => 'saltype'  
                ]
                );

    }
    
}
