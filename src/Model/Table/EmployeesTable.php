<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class EmployeesTable extends Table
{
    
    public function initialize(array $config){

     	$this->belongsTo('Gender', 
     		['className' => 'Gender', 
     		'foreignKey' => 'gender_id', 
     		'bindingKey' => 'id', 
     		'propertyName' => 'gender']);

     	$this->belongsTo('Empposition', 
     		['className' => 'Empposition', 
     		'foreignKey' => 'position_id', 
     		'bindingKey' => 'id', 
     		'propertyName' => 'position']);      

        $this->hasMany('Allowances',
            [
                'className' => 'Allowances', 
                'foreignKey' => 'emp_id', 
                'bindingKey' => 'emp_id', 
                'propertyName' => 'allowance'  
            ]);

        $this->hasMany('Usermodule',
            [
                'className' => 'Usermodule', 
                'foreignKey' => 'emp_id', 
                'bindingKey' => 'id', 
                'propertyName' => 'usermod'  
            ]);
        
        $this->belongsTo('Empstatus',
            [
            'className' => 'Empstatus', 
            'foreignKey' => 'status_id', 
            'bindingKey' => 'id', 
            'propertyName' => 'status'                      
            ]);

        $this->hasOne('Users',[
            'className' => 'Users', 
            'foreignKey' => 'emp_id', 
            'bindingKey' => 'id', 
            'propertyName' => 'user'   
        ]);
        
    }
    
    public function validationDefault(Validator $validator){        
        $validator = new Validator();        
        $validator->requirePresence(['fname', 'lname', 'dob', 'gender_id', 'address', 'position_id'], 'create');        
        return $validator;        
    }
    
    public function beforeSave($event, $entity, $options) {
        
    	$entity->date_created = date('Y-m-d', time());        
        
    }	
    
}

?>