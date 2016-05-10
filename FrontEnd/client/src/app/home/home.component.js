(function() {
  'use strict';

  /**
   * @name  HomeCtrl
   * @description Controller
   */
  function HomeController(DataService) {
    var vm = this;
    vm.init = init;

    init();

    function init() {

      vm.contacts = {};
      DataService.getContacts().then(function(data) {
        vm.contacts.data = data;
      });
    }
  }

  angular.module('home')
  .component('abHome', {
    templateUrl: 'src/app/home/home.tpl.html',
    controller: HomeController,
    controllerAs: 'vm'
  });
})();
