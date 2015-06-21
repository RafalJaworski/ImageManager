<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace AuthProcess;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use AuthProcess\Model\UserTable;
use AuthProcess\Model\User;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    //PROVIDING A FACTORY THAT CREATES AN USERTABLE
    public function getServiceConfig()
    {
        return array(
            //ModuleManager merge all factories before passing them to the ServiceManager
            //UserTable uses Service Manager to create below "UserTableGateway" and inject to itself

            //UserTableGateway is created by getting "Zend\Db\Adapter\Adapter" also from ServiceManager
            //and using it to create a "TableGateway"

            //"TableGateway" is informed mto use User to create new result row
            //"TableGateway" don't create  result sets and entities each time.The system clones
            // a previously instantiated object following "Constructor Best Practices and the Prototype Pattern"

            'factories' => array(
                'AuthProcess\Model\UserTable' =>  function($sm) {   //This key is used in Controller
                    $tableGateway = $sm->get('UserTableGateway');
                    $table = new UserTable($tableGateway);
                    return $table;
                },
                'UserTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new User());
                    return new TableGateway('user', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }

}
