<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace AuthProcess\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use AuthProcess\Model\UserTable;

class UserController extends AbstractActionController
{
    public $userTable;

    public function indexAction()
    {
//        echo "<pre>";
//        var_dump($this->getUserTable()->fetchAll());die;
        return new ViewModel(array(
            'users'=>$this->getUserTable()
        ));
    }

    public function addAction()
    {
        return new ViewModel();
    }

    public function editAction()
    {
        return new ViewModel();
    }

    public function deleteAction()
    {
        return new ViewModel();
    }

    public function getUserTable()
    {
        if (!$this->userTable) {
            $sm = $this->getServiceLocator();
            $this->userTable = $sm->get('AuthProcess\Model\UserTable'); //key from Module.php factories
        }
        return $this->userTable;
    }

}
