(function() {
  'use strict';

  /**
   * @name  config
   * @description config block
   */
  function config($stateProvider) {
    $stateProvider
      .state('root.home', {
        url: '/',
        views: {
          '@': {
            template: '<ab-home></ab-home>'
          }
        }
      });
  }

  angular.module('home', [])
    .config(config);
})();
