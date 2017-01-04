<?php

namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

class Assigntutor extends Entity
{

	 protected $_accessible = [
        '*' => true,
        'id' => false
    ];

    protected function _getAssignDate($date){
        $date = strtotime($date);
        
        if(!$date){
            return "0000-00-00";
        }

        return date("Y-m-d", $date);
    }

    protected function _getAssignTime($time){
        return date("H:i:s", strtotime($time));
    }
    
    protected function _getStartDate($date){
        $date = strtotime($date);
        
        if(!$date){
            return "0000-00-00";
        }

        return date("Y-m-d", $date);
    }

    protected function _getStartTime($time){
        return date("H:i:s", strtotime($time));
    }

    protected function _getEndDate($date){
        $date = strtotime($date);
        
        if(!$date){
            return "0000-00-00";
        }

        return date("Y-m-d", $date);
    }

    protected function _getEndTime($time){
        return date("H:i:s", strtotime($time));
    }
}