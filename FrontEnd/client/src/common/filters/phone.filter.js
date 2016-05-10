(function() {
  'use strict';

  function phone() {
    return function(number) {

      if (!number) { return ''; }

      return number.replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');
    };
  }

  angular.module('common.filters', [])
    .filter('phone', phone);
})();
