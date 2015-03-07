'use strict';
/*
 * Copyright (c) 2014, Joel Crosswhite <joel.crosswhite@ix.netcom.com>
 * All rights reserved.
 */

var addrBookServices = angular.module('addrBookServices', ['ngResource']);

addrBookServices.factory('AddrBook', ['$resource',
    function ($resource) {
      return $resource('addressBook', {}, {
        query : {
          method : 'GET',
          isArray : false
        },
        add : {
          method : 'POST'
        },
        remove : {
          method : 'POST',
          params : {
            '_method' : 'DELETE'
          }
        },
      });
    }
  ]);

addrBookServices.factory('Contact', ['$resource',
    function ($resource) {
      return $resource('addressBook/:contactId', {}, {
        query : {
          method : 'GET',
          params : {
            contactId : 'contacts'
          },
          isArray : true
        },
        edit : {
          method : 'POST',
          params : {
            '_method' : 'PUT'
          }
        }
      });
    }
  ]);
