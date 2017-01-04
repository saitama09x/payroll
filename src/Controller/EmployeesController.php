<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\Event\Event;

class EmployeesController extends AppController{

    
    function beforeRender(Event $event){
        parent::usermodule();
    }

	function initialize() {
	    parent::loadAllModels();
		$this->loadComponent('Flash');
		$this->viewBuilder()->layout('template_one');
	}

	function index(){
		$emps = $this->Employees->find('all')->contain(['Gender', 'Empstatus', 'Empposition']);
		$this->set(compact('emps'));
	}

	function add(){
		$emp = $this->Employees->newEntity();
		$gender = $this->Gender->find('list', ['keyField' => 'id', 'valueField' => 'type']);
		$pos = $this->Empposition->find('list', ['keyField' => 'id', 'valueField' => 'name']);

		if($this->request->is('post')){
			$emp = $this->Employees->patchEntity($emp, $this->request->data);
			if($this->Employees->save($emp)){
				$this->Flash->success(__('Successfully Added'));
				$this->redirect(['action' => 'index']);
			}
		}
		$this->set(['emp' => $emp, 'gender' => $gender, 'pos' => $pos]);
	}

	function view($id){
		$emp = $this->Employees->findById($id)->contain(['Gender','Empstatus', 'Empposition'])->first();

		$deductionlist = $this->Deductions->find('list', ['keyField' => 'id', 'valueField' => 'name']);	
        /*    
		$deductionname__ = $deductionname->find('all')->contain(['Deductiondetails' => function($q) 
			use ($id){
			return $q->where(['Deductiondetails.emp_id' => $id]);
		}, 'Deductions' => function($q) use ($id){
                        return $q->where(['Deductions.emp_id' => $id]);
                }]);		
        */
        /*      
		$details_ = $this->Deductiondetails;		
		$details = $details_->find('all')->where(['emp_id' => $id])->first();
        */
        //$percent = $this->Deductionpercent->findAllByEmpId($id)->contain(['Deductions']);
        
        $deductionform = $this->Deductions->newEntity();
        $percent = $this->Deductions->find('all')->contain(['Deductionpercent' => function($q) use ($id){
            return $q->where(["Deductionpercent.emp_id" => $id]);
        }]);

        $allowance = $this->Allowances->find('all')->where(['emp_id' => $id]);
        $salary = $this->Salaries->findAllByEmpId($id)->contain(['Salarytype']);
        $salarytype = $this->Salarytype->find('list', ['keyField' => 'id', 'valueField' => 'name']);
        $status = $this->Empstatus->find('list', ['keyField' => 'id', 'valueField' => 'status']);
                		

		$this->set(compact('emp', 
                        'deductionlist',
                        'deductionform',
                        'allowance', 
                        'salary', 
                        'salarytype', 
                        'percent',
                        'status', 
                        'id'));
	}

    function submitdeduction($id){
        $this->request->allowMethod('post');

        $deductid = $this->request->data['deduction_id'];
        $percent = $this->Deductionpercent;
        $deduct = $percent->findByEmpIdAndDeductionId($id, $deductid);

        if($deduct->count()){
            $update = $deduct->first();
            $update->details = $this->request->data['details'];
            $update->percentage = $this->request->data['percentage'] / 100;
            $percent->save($update);          
        }else{
            $new = $this->Deductionpercent->newEntity();
            $patch = $this->Deductionpercent->patchEntity($new, $this->request->data);
            $patch->emp_id = $id;            
            $this->Deductionpercent->save($patch);
        } 

        $this->redirect(['action' => 'view', $id]);
    }

	function edit($id){

		$emp = $this->Employees->get($id);
		$gender = $this->Gender->find('list', ['keyField' => 'id', 'valueField' => 'type']);
		$pos = $this->Empposition->find('list', ['keyField' => 'id', 'valueField' => 'name']);

		if($this->request->is('post', 'put')){
			$this->Employees->pathEntity($emp, $this->request->data);
			if($this->Employees->save($emp)){
				$this->Flash->success(__('Successfully Updated'));
				$this->redirect(['action' => 'index']);
			}
		}
		$this->set(['emp' => $emp, 'gender' => $gender, 'pos' => $pos]);
	}
        
        function addallowance($id){
            $this->autoRender = false;
            if($this->request->is('post')){
                $emp_id = $id;
                $details = $this->request->data['details'];
                $amount = $this->request->data['amount'];            
                $allowance = $this->Allowances->newEntity();            
                $allowance->emp_id = $id;
                $allowance->details = $details;
                $allowance->amount = $amount;
                $allowance->date_created = date('Y-m-d', time());
                if($this->Allowances->save($allowance)){
                    $this->Flash->success(__('Successfully Added'));
                    $this->redirect(['action' => 'view', $id]);
                }  
            }            
        }
        
        function addsalary($id){    
            $this->request->allowMethod(['post', 'delete']);
            $this->autoRender = false;
            $emp_id = $id;
            $type = $this->request->data['type'];
            $amount = $this->request->data['amount'];
            
            $add = $this->Salaries->newEntity();
            $add->emp_id = $emp_id;
            $add->type = $type;
            $add->status = 1;
            $add->amount = $amount;
            $add->date_created = date('Y-m-d', time());
            if($this->Salaries->save($add)){
                $this->Flash->success(__('Successfully Added'));
                $this->redirect(['action' => 'view', $id]);
            }
        }
        
        function deletesalary($id, $emp_id){
            $this->request->allowMethod(['post', 'delete']);
            $sal = $this->Salaries->get($id);
            if($this->Salaries->delete($sal)){
                $this->Flash->success(__('Successfully Deleted'));
                 $this->redirect(['action' => 'view', $emp_id]);
            }
        }    

	function deletededuction($id, $emp_id){
             $this->request->allowMethod(['post', 'delete']);
             $deduct = $this->Deductionpercent->get($id);
             if($this->Deductionpercent->delete($deduct)){
                 $this->Flash->success(__('Successfully Deleted'));
                 $this->redirect(['action' => 'view', $emp_id]);
             }
	}

    function deleteallowance($id, $emp_id){
        $this->request->allowMethod(['post', 'delete']);
         $deduct = $this->Allowances->get($id);
         if($this->Allowances->delete($deduct)){
             $this->Flash->success(__('Successfully Deleted'));
             $this->redirect(['action' => 'view', $emp_id]);
         }
    }

	function delete($id){
		$this->request->allowMethod(['post', 'delete']);
		$emp = $this->Employees->get($id);
		if($this->Employees->delete($emp)){
			$this->Flash->success(__('Successfully Deleted'));
			$this->redirect(['action' => 'index']);
		}
	}

    function uploadfiles(){
        $this->autoRender = false;
        @set_time_limit(5 * 60);
        $targetDir =  getcwd() . "/img/";
        //$targetDir = 'uploads';
        $cleanupTargetDir = true; // Remove old files
        $maxFileAge = 5 * 3600; // Temp file age in seconds
        // Create target dir
        if (!file_exists($targetDir)) {
                @mkdir($targetDir);
        }
        // Get a file name
        if (isset($_REQUEST["name"])) {
                $fileName = $_REQUEST["name"];
        } elseif (!empty($_FILES)) {
                $fileName = $_FILES["file"]["name"];
        } else {
                $fileName = uniqid("file_");
        }
        $orig_name = $fileName;	 // get file name from form
        $fileNameParts = explode(".", $fileName); // explode file name to two part
        $fileExtension = end($fileNameParts); // give extension
        $fileExtension = strtolower($fileExtension); // convert to lower case		
        $filePath = $targetDir . "/" . $orig_name;
        // Chunking might be enabled
        $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
        $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;
        // Remove old temp files	
        if ($cleanupTargetDir) {
            if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
                    die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
            }

        while (($file = readdir($dir)) !== false) {
                $tmpfilePath = $targetDir . "/" . $file;
                // If temp file is current file proceed to the next
                if ($tmpfilePath == "{$filePath}.part") {
                        continue;
                }
                // Remove temp file if it is older than the max age and is not the current file
                if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
                        @unlink($tmpfilePath);
                }
        }
          closedir($dir);
        }	
        // Open temp file
        if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
        }
        if (!empty($_FILES)) {
                /*
                if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
                        die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
                }
                */
                // Read binary input stream and append it to temp file
        if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
        }
        } else {	
                if (!$in = @fopen("php://input", "rb")) {
                        die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
                }
        }
        while ($buff = fread($in, 4096)) {
                fwrite($out, $buff);
        }
        @fclose($out);
        @fclose($in);        
        if (!$chunks || $chunk == $chunks - 1) {                
                rename("{$filePath}.part", $filePath);
        }
        echo json_encode(array("filename" => $fileName, "original_name" => $orig_name, "file_path" => Router::url('/', true) . "/img/" . $fileName));
        }
        
        function updatepropic(){            
            $pic = $this->request->data['orig_name_pic_btn'];            
            $emp_= $this->Employees;            
            $emp = $emp_->find('all')->where(['id' => $this->Auth->user('id')])->first();            
            $emp->pro_pic = $pic;            
            $emp_->save($emp);            
            $this->redirect(['action' => 'view', $this->Auth->user('id')]);
        }
        
}

?>