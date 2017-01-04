<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class PayslipTable extends Table{

    public function initialize(array $config){        
        
        $this->belongsTo('Employees', [
     			'className' => 'Employees',
     			'foreignKey' => 'emp_id', 
     			'bindingKey' => 'id',
     			'propertyName' => 'employee'
     	]); 

     	$this->hasMany('Deductionpercent', [
     			'className' => 'Deductionpercent',
     			'foreignKey' => 'emp_id', 
     			'bindingKey' => 'emp_id',
     			'propertyName' => 'deduct'
     	]);

     	$this->hasMany('Allowances', [
     			'className' => 'Allowances',
     			'foreignKey' => 'emp_id', 
     			'bindingKey' => 'emp_id',
     			'propertyName' => 'allowance'
     	]);

    }
        
}

