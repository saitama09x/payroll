<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Event\Event;
use ArrayObject;
use Cake\Datasource\EntityInterface;

class UsermoduleTable extends Table{

    public function initialize(array $config){  

        $this->belongsTo('Employees', [
            'className' => 'Employees', 
            'foreignKey' => 'emp_id', 
            'bindingKey' => 'id',                  
            'propertyName' => 'emps'   
        ]);  

        $this->belongsTo('Modules', [
            'className' => 'Modules', 
            'foreignKey' => 'modcode', 
            'bindingKey' => 'modcode',                  
            'propertyName' => 'mod'   
        ]);                

    }

     function beforeSave(Event $event, EntityInterface $entity){
        $entity->set('date_created', date("Y-m-d", time()));
    }
        
}
