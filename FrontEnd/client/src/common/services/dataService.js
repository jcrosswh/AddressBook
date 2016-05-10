(function() {
  'use strict';

  function dataService($q) {
    return {
      getContacts: function() {
        return $q(function(resolve, reject) {
          setTimeout(function() {
            resolve([{
              firstName: 'Adam',
              lastName: 'Smith',
              id: 1
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
