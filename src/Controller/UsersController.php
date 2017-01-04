<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use App\Controller\AppController;
use Cake\Event\Event;

class UsersController extends AppController{	

    function beforeRender(Event $event){
        parent::usermodule();
    }

	function initialize() {
            parent::initialize();
            $this->loadModel('Gender');
            $this->loadModel('Employees');
            $this->loadModel('Empposition');
            $this->viewBuilder()->layout('login');
	}

	public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['logout', 'register', 'registersuccess', 'showuser']);
    }

	function index(){

	}

	function add(){

	}

	public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
    
    public function register(){
        $this->autoRender = false;
        $gender = $this->Gender->find('list', ['keyField' => 'id', 'valueField' => 'type']);
        $emp = $this->Employees->newEntity();
        $pos = $this->Empposition->find('list', ['keyField' => 'id', 'valueField' => 'name']);
        if($this->request->is('post')){
            $emp->status_id = 1;
            $emp = $this->Employees->patchEntity($emp, $this->request->data, ['associated' => ['Users']]);            
            if($this->Employees->save($emp)){
                $user = $this->Users->newEntity();
                $user->emp_id = $emp->id;
                $user->username = $this->request->data['username'];
                $user->password = $this->request->data['password'];
                $user->date_created = date('Y-m-d', time());
                $this->Users->save($user);
                $this->Flash->set('Successfully Created');
                $this->redirect(['action' => 'registersuccess', $emp->id]);
            }else{
                
            }
        }        
        $this->set(compact('gender', 'emp', 'pos'));
        $this->render('register');
    }
    
    
    function registersuccess($id){
        $emp = $this->Employees->findById($id)->contain(['Gender', 'Empposition', 'Users'])->first();
        $this->set(compact('emp'));
    }

    function showuser(){

        $this->autoRender = false;

        $query = $this->Employees->find('all')->contain(['Users']);

        foreach($query as $row){
            echo $row->user->username;

        }

    }

    
}

?>