'use strict';
/*
 * Copyright (c) 2014, Joel Crosswhite <joel.crosswhite@ix.netcom.com>
 * All rights reserved.
 */

var addrBookControllers = angular.module('addrBookControllers', []);

addrBookControllers.controller('AddrBookCtrl', ['$scope', '$location', 'AddrBook', function ($scope, $location, AddrBook) {
      $scope.contacts = AddrBook.query();

      $scope.add = function () {
        AddrBook.add({}, $scope.newContact, function (data) {
          $location.path('/');
        });
      };

      $scope.delete = function (id) {
        if (!confirm('Are you sure you want to delete this contact?')) {
          return;
        }

        AddrBook.remove({
          id : id
        }, {}, function (data) {
          $location.path('/');
          location.reload();
        });
      };
    }
  ]);

addrBookControllers.controller('ContactDetailCtrl', ['$scope', '$location', '$routeParams', 'Contact', function ($scope, $location, $routeParams, Contact) {
      $scope.contact = Contact.get({
          contactId : $routeParams.contactId
        });

      $scope.save = function () {
        Contact.edit({
          id : $scope.contact.data.id
        }, $scope.contact, function (data) {
          $location.path('/');
        });
      };
    }
  ]);
