<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Event\Event;
use ArrayObject;
use Cake\Datasource\EntityInterface;

class DeductionpercentTable extends Table
{
    
    public function initialize(array $config){
        
        $this->belongsTo('Deductions', 
                ['className' => 'Deductions',
                 'foreignKey' => 'deduction_id',
                 'bindingKey' => 'id',
                 'propertyName' => 'names']);
        
        $this->belongsTo('Employees',
                [
                    'className' => 'Employees',
                    'foreignKey' => 'emp_id',
                    'bindingKey' => 'id',
                    'propertyName' => 'emps'
                ]
                );
        
    }

    function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options)
    {
         if (isset($data['percentage'])) {
            $data['percentage'] = $data['percentage'] / 100;
         }
    }
    
    function beforeSave(Event $event, EntityInterface $entity){
        $entity->set('date_created', date("Y-m-d", time()));
    }
    
    
}