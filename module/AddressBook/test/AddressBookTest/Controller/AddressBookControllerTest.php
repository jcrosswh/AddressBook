<?php

/*
 * Copyright (c) 2014, Joel Crosswhite <joel.crosswhite@ix.netcom.com>
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * * Redistributions of source code must retain the above copyright notice, this
 *   list of conditions and the following disclaimer.
 * * Redistributions in binary form must reproduce the above copyright notice,
 *   this list of conditions and the following disclaimer in the documentation
 *   and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 */

namespace AddressBookTest\Controller;

use AddressBook\Controller\AddressBookController;
use AddressBook\Model\Contact;
use AddressBookTest\Bootstrap;
use PHPUnit_Framework_TestCase;
use Zend\Http\Headers;
use Zend\Http\Request;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\Http\TreeRouteStack as HttpRouter;
use Zend\Mvc\Router\RouteMatch;

class AddressBookControllerTest extends PHPUnit_Framework_TestCase {

    protected $controller;
    protected $request;
    protected $response;
    protected $routeMatch;
    protected $event;

    protected function setUp() {
        $serviceManager = Bootstrap::getServiceManager();
        $this->controller = new AddressBookController();
        $this->request = new Request();
        $this->routeMatch = new RouteMatch(array('controller' => 'index'));
        $this->event = new MvcEvent();
        $config = $serviceManager->get('Config');
        $routerConfig = isset($config['router']) ? $config['router'] : array();
        $router = HttpRouter::factory($routerConfig);
        $this->event->setRouter($router);
        $this->event->setRouteMatch($this->routeMatch);
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($serviceManager);
    }

    public function testGetListCanBeAccessed() {

        $contactRepository = $this->getMockBuilder('\Doctrine\ORM\EntityRepository')
                ->disableOriginalConstructor()
                ->getMock();
        $contactRepository->expects($this->once())
                ->method('findAll')
                ->will($this->returnValue(array()));

        $entityManager = $this->getMockBuilder('\Doctrine\Common\Persistence\ObjectManager')
                ->disableOriginalConstructor()
                ->getMock();
        $entityManager->expects($this->once())
                ->method('getRepository')
                ->will($this->returnValue($contactRepository));

        $this->controller->setObjectManager($entityManager);
        $result = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('{"data":[]}', $result->serialize());
    }

    public function testGetCanBeAccessed() {

        $contact = new Contact();

        $entityManager = $this->getMockBuilder('\Doctrine\Common\Persistence\ObjectManager')
                ->disableOriginalConstructor()
                ->getMock();
        $entityManager->expects($this->once())
                ->method('find')
                ->will($this->returnValue($contact));

        $this->controller->setObjectManager($entityManager);

        $this->routeMatch->setParam('id', '1');

        $result = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('{"data":{"id":null,"version":null,"firstName":null,"lastName":null,"address1":null,"address2":null,"city":null,"state":null,"zip":null,"email":null,"phoneNumber":null,"middleInitial":null,"zip4":null}}', $result->serialize());
    }

    public function testCreateCanBeAccessed() {

        $entityManager = $this->getMockBuilder('\Doctrine\Common\Persistence\ObjectManager')
                ->disableOriginalConstructor()
                ->getMock();
        $entityManager->expects($this->once())
                ->method('persist')
                ->with($this->anything());
        $entityManager->expects($this->once())
                ->method('flush');

        $this->controller->setObjectManager($entityManager);

        $data = array(
            'firstName' => 'John',
            'lastName' => 'Smith',
            'middleInitial' => null,
            'address1' => '123 Main St',
            'address2' => 'Ste 400',
            'city' => 'Pleasantville',
            'state' => 'OK',
            'zip' => '12345',
            'zip4' => '6789',
            'email' => 'john.smith@company.com',
            'phoneNumber' => '8885551212',);

        $this->request->setMethod('post');
        $this->request->setContent(json_encode($data));
        
        $headers = new Headers();
        $headers->addHeaderLine('Content-type', 'application/json');
        $this->request->setHeaders($headers);

        $result = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testUpdateCanBeAccessed() {

        $data = array(
            'firstName' => 'Jim',
            'lastName' => 'Smith',
            'middleInitial' => null,
            'address1' => '123 Main St',
            'address2' => 'Ste 400',
            'city' => 'Pleasantville',
            'state' => 'OK',
            'zip' => '12345',
            'zip4' => '6789',
            'email' => 'john.smith@company.com',
            'phoneNumber' => '8885551212',
            'id' => 1);

        $contact = new Contact();
        $contact->exchangeArray($data);

        $entityManager = $this->getMockBuilder('\Doctrine\Common\Persistence\ObjectManager')
                ->disableOriginalConstructor()
                ->getMock();
        $entityManager->expects($this->once())
                ->method('merge')
                ->with($this->anything())
                ->will($this->returnValue($contact));
        $entityManager->expects($this->once())
                ->method('flush');
        $entityManager->expects($this->once())
                ->method('find')
                ->with('AddressBook\Model\Contact', 1)
                ->will($this->returnValue($contact));

        $this->controller->setObjectManager($entityManager);

        $this->routeMatch->setParam('id', '1');
        $this->request->setMethod('put');
        $this->request->setContent(json_encode($data));

        $headers = new Headers();
        $headers->addHeaderLine('Content-type', 'application/json');
        $this->request->setHeaders($headers);

        $result = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('{"data":1}', $result->serialize());
    }

    public function testDeleteCanBeAccessed() {
        
        $entityManager = $this->getMockBuilder('\Doctrine\Common\Persistence\ObjectManager')
                ->disableOriginalConstructor()
                ->getMock();
        $entityManager->expects($this->once())
                ->method('remove')
                ->with($this->anything());
        $entityManager->expects($this->once())
                ->method('flush');
        $entityManager->expects($this->once())
                ->method('find')
                ->with('AddressBook\Model\Contact', 1)
                ->will($this->returnValue(new Contact()));

        $this->controller->setObjectManager($entityManager);
        
        $this->routeMatch->setParam('id', '1');
        $this->request->setMethod('delete');

        $result = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('{"data":"deleted"}', $result->serialize());
    }

}
