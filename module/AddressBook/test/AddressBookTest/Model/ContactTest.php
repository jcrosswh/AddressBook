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

namespace AddressBookTest\Model;

use AddressBook\Model\Contact;
use PHPUnit_Framework_TestCase;

class ContactTest extends PHPUnit_Framework_TestCase {

    public function testContactInitialState() {
        $contact = new Contact();

        $this->assertNotNull($contact, 'Contact not instantiated');
    }

    public function testExchangeArraySetsPropertiesCorrectly() {
        $contact = new Contact();

        $data = array(
            'firstName' => 'John',
            'lastName' => 'Smith',
            'address1' => '123 Main St',
            'address2' => 'Ste 400',
            'city' => 'Pleasantville',
            'state' => 'OK',
            'zip' => '12345',
            'zip4' => '6789',
            'email' => 'john.smith@company.com',
            'phoneNumber' => '8885551212',
            'id' => 1,);

        $contact->exchangeArray($data);

        $this->assertSame($data['firstName'], $contact->getFirstName(), '"firstName" was not set correctly');
        $this->assertSame($data['lastName'], $contact->getLastName(), '"lastName" was not set correctly');
        $this->assertSame($data['address1'], $contact->getAddress1(), '"address1" was not set correctly');
        $this->assertSame($data['address2'], $contact->getAddress2(), '"address2" was not set correctly');
        $this->assertSame($data['city'], $contact->getCity(), '"city" was not set correctly');
        $this->assertSame($data['state'], $contact->getState(), '"state" was not set correctly');
        $this->assertSame($data['zip'], $contact->getZip(), '"zip" was not set correctly');
        $this->assertSame($data['zip4'], $contact->getZip4(), '"zip4" was not set correctly');
        $this->assertSame($data['email'], $contact->getEmail(), '"email" was not set correctly');
        $this->assertSame($data['phoneNumber'], $contact->getPhoneNumber(), '"phoneNumber" was not set correctly');
        $this->assertSame($data['id'], $contact->getId(), '"id" was not set correctly');
    }

}
