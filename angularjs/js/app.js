(function () {
    'use strict';

    /* App Module */

    var itemsApp = angular.module('itemsApp', [
      'ngRoute',
      'pollsControllers'
    ]);

    itemsApp.config(['$routeProvider',
        function($routeProvider) {
            $routeProvider.
            when('/polls', {
              templateUrl: 'angularjs/partials/poll-list.html',
              controller: 'PollListCtrl'
            }).
            when('/polls/:pollId', {
              templateUrl: 'angularjs/partials/poll.html',
              controller: 'PollCtrl'
            }).
            when('/admin', {
                templateUrl: 'angularjs/partials/admin-list.html',
                controller: 'AdminPollListCtrl'
            }).
            when('/admin/:pollId', {
                templateUrl: 'angularjs/partials/admin-poll.html',
                controller: 'AdminPollCtrl'
            }).
            otherwise({
              redirectTo: '/polls'
            });
        }
    ]);
}());
