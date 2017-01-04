<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class AllowancesTable extends Table{

    public function initialize(array $config){        
        $this->belongsTo('Employees', [
            'className' => 'Employees', 
            'foreignKey' => 'emp_id', 
            'bindingKey' => 'id',                  
            'propertyName' => 'emps'   
        ]);                
    }
        
}

