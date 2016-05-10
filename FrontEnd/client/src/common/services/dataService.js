(function() {
  'use strict';

  function dataService($q, $http) {
    return {
      getContacts: function() {

        // replace with once ready:
        // $http.get(url);
        return $q(function(resolve, reject) {
          setTimeout(function() {
            resolve([{
              id: 1,
              firstName: 'Bob',
            	lastName: 'Smith',
            	address1: '123 Main St',
            	address2: 'Ste 300',
            	city: 'Springfield',
            	state: 'NV',
            	zip: '12345',
            	email: 'bob.smith@company.com',
            	phoneNumber: '8885551212',
            	middleInitial: 'T',
            	zip4: '6789'
            }, {
              id: 2,
              firstName: 'Linda',
            	lastName: 'Smith',
            	address1: '123 Main St',
            	address2:'Ste 300',
            	city: 'Springfield',
            	state: 'NV',
            	zip: '12345',
            	email: 'linda.smith@company.com',
            	phoneNumber: '8885551212',
            	zip4: '6789'
            }, {
              id: 3,
              firstName: 'John',
            	lastName: 'Smith',
            	address1: '546 Commerce Blvd',
            	city: 'Springfield',
            	state: 'NY',
            	zip: '42315',
          	  email: 'john.smith@llc.com',
            	phoneNumber: '8885562121'
            }, {
              id: 4,
              firstName: 'Judy',
            	lastName: 'Smith',
            	address1: '546 Commerce Blvd',
            	city: 'Springfield',
            	state: 'NY',
            	zip: '42315',
            	email: 'john.smith@llc.com',
            	phoneNumber: '8885562121'
            }]);
            // reject({TODO:  test error response}});
          }, 200);
        });
      }
    }
  }

  angular.module('common.services.data', [])
    .factory('DataService', dataService);
})();
