<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace AddressBook;

use Zend\EventManager\EventInterface;
use Zend\Http\Request;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\Mvc\MvcEvent;

class Module implements BootstrapListenerInterface {

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function onBootstrap(EventInterface $event) {
        $event->getApplication()
                ->getEventManager()
                ->attach(MvcEvent::EVENT_ROUTE, function(MvcEvent $e) {
                    $request = $e->getRequest();
                    $m = $request->getQuery('_method');

                    switch ($m) {
                        case Request::METHOD_PUT:
                            $request->setMethod(Request::METHOD_PUT);
                            break;
                        case Request::METHOD_DELETE:
                            $request->setMethod(Request::METHOD_DELETE);
                            break;
                        case Request::METHOD_POST:
                            $request->setMethod(Request::METHOD_POST);
                            break;
                        case Request::METHOD_GET:
                            $request->setMethod(Request::METHOD_GET);
                            break;
                        default:
                            break;
                    }
                });
    }

}
