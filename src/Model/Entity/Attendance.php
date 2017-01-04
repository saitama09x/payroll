<?php

namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

class Attendance extends Entity
{

	 protected $_accessible = [
        '*' => true,
        'id' => false
    ];


    protected function _getDateCreated($date){
    	return date("Y-m-d", strtotime($date));
    }

    protected function _setDateCreated($date){
        return date("Y-m-d", strtotime($date));
    }

    protected function _getStartTime($time){
    	return date("H:i:s", strtotime($time));
    } 

    protected function _getEndTime($time){
    	return date("H:i:s", strtotime($time));	
    }

    protected function _getCreatedStart(){
        return date_create(date("H:i:s", strtotime($this->_properties['start_time'])));
    }

    protected function _getCreatedEnd(){
        return date_create(date("H:i:s", strtotime($this->_properties['end_time'])));
    }

    protected function _getTimeDiff(){
    	$start = date("H:i:s", strtotime($this->_properties['start_time']));
    	$end = date("H:i:s", strtotime($this->_properties['end_time']));

    	$start = date_create($start);
    	$end = date_create($end);

    	return date_diff($end, $start);
    }

}