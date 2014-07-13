/*
 * Copyright (c) 2014, Joel Crosswhite <joel.crosswhite@ix.netcom.com>
 * All rights reserved.
 */

var addrBookApp = angular.module('addrBookApp', ['ngRoute', 'addrBookControllers', 'addrBookServices']);

addrBookApp.config(['$routeProvider',
    function ($routeProvider) {
      $routeProvider.
      when('/add', {
        templateUrl: 'partials/contact-add.html',
        controller: 'AddrBookCtrl'
      }).     
      when('/edit/:contactId', {
        templateUrl : 'partials/contact-edit.html',
        controller : 'ContactDetailCtrl'
      }).
      when('/', {
        templateUrl : 'partials/contact-list.html',
        controller : 'AddrBookCtrl'
      }).
      otherwise({
        redirectTo : '/'
      });
    }
  ]);
