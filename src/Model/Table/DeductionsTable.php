<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class DeductionsTable extends Table
{
    
	public function initialize(array $config){                            
        $this->hasOne('Deductionpercent', [
            'className' => 'Deductionpercent', 
            'foreignKey' => 'deduction_id', 
            'bindingKey' => 'id',      		
            'propertyName' => 'deduction',                    
        ]);
	}

}

?>