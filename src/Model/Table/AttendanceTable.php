<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class AttendanceTable extends Table
{
     function initialize(array $config){

     	$this->belongsTo('Empshifting', 
     		['className' => 'Empshifting', 
     		'foreignKey' => 'shifting_id', 
     		'bindingKey' => 'id', 
     		'propertyName' => 'shifting']);

     	$this->belongsTo('Employees', [
     			'className' => 'Employees',
     			'foreignKey' => 'emp_id', 
     			'bindingKey' => 'id',
     			'propertyName' => 'employee'
     		]);              
       
        $this->hasMany('Allowances',
                [
                    'className' => 'Allowances', 
                    'foreignKey' => 'emp_id', 
                    'bindingKey' => 'emp_id', 
                    'propertyName' => 'allowance',  
                ]);
        
        $this->hasOne('Salaries', [
            'className' => 'Salaries', 
            'foreignKey' => 'emp_id', 
            'bindingKey' => 'emp_id', 
            'propertyName' => 'salaries',              
        ]);
        
        $this->hasMany('Deductions', 
                [
                'className' => 'Deductions', 
                'foreignKey' => 'emp_id', 
                'bindingKey' => 'emp_id', 
                'propertyName' => 'deduction'                      
                ]);
    }

     function beforeSave(Event $event, EntityInterface $entity){
        $entity->set('date_created', date("Y-m-d", time()));
    }
}

?>