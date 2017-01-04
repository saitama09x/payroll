<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class StudentsTable extends Table
{
	

    public function initialize(array $config){

     	$this->belongsTo('Gender', 
     		['className' => 'Gender', 
     		'foreignKey' => 'gender_id', 
     		'bindingKey' => 'id', 
     		'propertyName' => 'gender']);

    }

    public function beforeSave($event, $entity, $options) {
    	$entity->date_created = date('Y-m-d', time());        
    }
}

?>