<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Routing\Router;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */

    public $components = ['Flash', 'Auth'];
    
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');        
        $this->loadComponent('Auth', [
            'authorize' => ['Controller'],
            'loginRedirect' => [
                'controller' => 'Dashboard',
                'action' => 'index'
            ],

            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'login'
            ],

        ]);

        /*
         * Enable the following components for recommended CakePHP security settings.
         * see http://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }

    }

    public function isAuthorized($user)
    {
        // Admin can access every action
        if (isset($user['role']) && $user['role'] === 'admin') {
            return true;
        }

        // Default deny
        return false;
    }

    function usermodule(){
        $usermod = TableRegistry::get('Usermodule');
        $query = $usermod->findAllByEmpId($this->Auth->user('emp_id'));
        $mods = array();
        if($query){
            foreach($query as $row){
                $mods[] = $row->modcode;
            }
        }        

        $userpic = TableRegistry::get('Employees');
        $querypic = $userpic->findById($this->Auth->user('emp_id'));
        $pic = "avatar.png";
        $fullname = "";
        if($querypic->count()){
            $empdata = $querypic->first();
            $pic = (!empty($empdata->pro_pic)) ? $empdata->pro_pic : $pic;
            $fullname = $empdata->fname . " "  .$empdata->lname;
        }

        $this->set(compact('mods', 'pic', 'fullname'));
    }


    function loadAllModels(){

        $this->loadModel('Allowances');
        $this->loadModel('Assigntutor');
        $this->loadModel('Attendance'); 
        $this->loadModel('Students');
        $this->loadModel('Classrooms');
        $this->loadModel('Deductionpercent');
        $this->loadModel('Deductions');
        $this->loadModel('Employees');
        $this->loadModel('Empposition');
        $this->loadModel('Empshifting');
        $this->loadModel('Empstatus');
        $this->loadModel('Studratings');        
        $this->loadModel('Salarytype'); 
        $this->loadModel('Salaries');    
        $this->loadModel('Payslip');
        $this->loadModel('Gender');
        $this->loadModel('Usermodule');
        $this->loadModel('Modules');
        $this->loadModel('Empstatus');
        $this->loadModel('Users');

    }

}
