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

namespace AddressBook\Controller;

use AddressBook\Model\Contact;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class AddressBookController extends AbstractRestfulController {

    private $_objectManager;

    public function getList() {

        return new JsonModel(array(
            'data' => $this->getObjectManager()->getRepository('\AddressBook\Model\Contact')->findAll())
        );
    }

    public function get($id) {

        return new JsonModel(array(
            'data' => $this->getObjectManager()->find('AddressBook\Model\Contact', $id))
        );
    }

    public function create($data) {

        $em = $this->getObjectManager();

        $contact = new Contact();
        $contact->exchangeArray($data);

        $em->persist($contact);
        $em->flush();

        return new JsonModel(array(
            'data' => $contact->getId(),
        ));
    }

    public function update($id, $data) {
        $em = $this->getObjectManager();

        $contact = $em->find('AddressBook\Model\Contact', $id);
        $contact->setFirstName($data['firstName']);
        $contact->setLastName($data['lastName']);
        $contact->setMiddleInitial($data['middleInitial']);
        $contact->setAddress1($data['address1']);
        $contact->setAddress2($data['address2']);
        $contact->setCity($data['city']);
        $contact->setState($data['state']);
        $contact->setZip($data['zip']);
        $contact->setZip4($data['zip4']);
        $contact->setPhoneNumber($data['phoneNumber']);
        $contact->setEmail($data['email']);

        $contact = $em->merge($contact);
        $em->flush();

        return new JsonModel(array(
            'data' => $contact->getId(),
        ));
    }

    public function delete($id) {
        $em = $this->getObjectManager();

        $contact = $em->find('AddressBook\Model\Contact', $id);
        $em->remove($contact);
        $em->flush();

        return new JsonModel(array(
            'data' => 'deleted',
        ));
    }

    protected function getObjectManager() {
        if (!$this->_objectManager) {
            $this->_objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }

        return $this->_objectManager;
    }

    public function setObjectManager(ObjectManager $objectManager) {
        $this->_objectManager = $objectManager;
    }

}
