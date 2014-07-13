'use strict';

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

describe('AddressBook controllers', function() {

  beforeEach(function(){
    this.addMatchers({
      toEqualData: function(expected) {
        return angular.equals(this.actual, expected);
      }
    });
  });

  beforeEach(module('addrBookApp'));
  beforeEach(module('addrBookServices'));

  describe('AddrBookCtrl', function(){
    var scope, ctrl, $httpBackend;

    beforeEach(inject(function(_$httpBackend_, $rootScope, $controller) {
      $httpBackend = _$httpBackend_;
      $httpBackend.expectGET('addressBook').
          respond([{firstName: 'John'}, {firstName: 'Jane'}]);

      scope = $rootScope.$new();
      ctrl = $controller('AddrBookCtrl', {$scope: scope});
    }));


    it('should create "address book" model with 2 contacts fetched from xhr', function() {
      expect(scope.contacts).toEqualData([]);
      $httpBackend.flush();

      expect(scope.contacts).toEqualData(
          [{firstName: 'John'}, {firstName: 'Jane'}]);
    });
  });


  describe('ContactDetailCtrl', function(){
    var scope, $httpBackend, ctrl,
        contactData = function() {
          return {
            firstName: 'John'
          }
        };


    beforeEach(inject(function(_$httpBackend_, $rootScope, $routeParams, $controller) {
      $httpBackend = _$httpBackend_;
      $httpBackend.expectGET('addressBook/1').respond(contactData());

      $routeParams.contactId = 1;
      scope = $rootScope.$new();
      ctrl = $controller('ContactDetailCtrl', {$scope: scope});
    }));


    it('should fetch contact detail', function() {
      expect(scope.contact).toEqualData({});
      $httpBackend.flush();

      expect(scope.contact).toEqualData(contactData());
    });
  });
});
