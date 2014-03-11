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

namespace AddressBook\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Contact {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /** @ORM\Column(type="string") */
    private $firstName;

    /** @ORM\Column(type="string") */
    private $lastName;

    /** @ORM\Column(type="string") */
    private $address1;

    /** @ORM\Column(type="string") */
    private $address2;

    /** @ORM\Column(type="string") */
    private $city;

    /** @ORM\Column(type="string") */
    private $state;

    /** @ORM\Column(type="string") */
    private $zip;

    /** @ORM\Column(type="string") */
    private $email;

    /** @ORM\Column(type="string") */
    private $phoneNumber;

    /** @ORM\Column(type="string") */
    private $middleInitial;

    /** @ORM\Column(type="string") */
    private $zip4;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function getAddress1() {
        return $this->address1;
    }

    public function setAddress1($address1) {
        $this->address1 = $address1;
    }

    public function getAddress2() {
        return $this->address2;
    }

    public function setAddress2($address2) {
        $this->address2 = $address2;
    }

    public function getCity() {
        return $this->city;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function getState() {
        return $this->state;
    }

    public function setState($state) {
        $this->state = $state;
    }

    public function getZip() {
        return $this->zip;
    }

    public function setZip($zip) {
        $this->zip = $zip;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPhoneNumber() {
        return $this->phoneNumber;
    }

    public function setPhoneNumber($phoneNumber) {
        $this->phoneNumber = $phoneNumber;
    }

    public function getMiddleInitial() {
        return $this->middleInitial;
    }

    public function setMiddleInitial($middleInitial) {
        $this->middleInitial = $middleInitial;
    }

    public function getZip4() {
        return $this->zip4;
    }

    public function setZip4($zip4) {
        $this->zip4 = $zip4;
    }

    public function toArray() {
        return get_object_vars($this);
    }

}
