<?php

namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

class Empshifting extends Entity
{

	 protected $_accessible = [
        '*' => true,
        'id' => false
    ];


    protected function _getStartTime($start){
    	return date("H:i:s", strtotime($start));
    }

    protected function _getEndTime($start){
    	return date("H:i:s", strtotime($start));
    }

    protected function _getCreatedStart(){
        return date_create(date("H:i:s", strtotime($this->_properties['start_time'])));
    }

    protected function _getCreatedEnd(){
        return date_create(date("H:i:s", strtotime($this->_properties['end_time'])));
    }

}

?>