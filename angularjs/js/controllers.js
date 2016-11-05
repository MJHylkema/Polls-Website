(function () {
    'use strict';

    /* Controllers */ 

    var pollsControllers = angular.module('pollsControllers', []);
    
    pollsControllers.controller('NavigationCtrl', ['$scope', '$location', 
        function ($scope, $location) {
            $scope.isCurrentPath = function (path) {
                return !$location.path().indexOf(path);
            };
        }
    ]);

    pollsControllers.controller('PollListCtrl', ['$scope', '$http',
        function ($scope, $http) {
            $scope.title = 'Stupid polls';
            $scope.polls = [];
            $scope.author = 'Mathew Hylkema';
            
            var url = 'index.php/services/polls';
            
            $http.get(url).success(function(data)
            {
                $scope.polls = data;
            });
        } 
    ]);

    pollsControllers.controller('PollCtrl', ['$scope', '$routeParams', '$http', '$location',
        function($scope, $routeParams, $http, $location) {
            $scope.title = 'Stupid polls';
            $scope.author = 'Mathew Hylkema';
            $scope.polls = [];
            $scope.poll;
            $scope.errorMessage = [];
            
            var pollID = $routeParams.pollId;
            var geturl = 'index.php/services/polls/' + pollID;
            var selectedAnswerID;
            
            $http.get(geturl).success(function(data)
            {
                $scope.polls = data;
                $scope.poll = $scope.polls[0];
            });
            
            $scope.select_answer = function(answerID)
            {
                selectedAnswerID = answerID;
                $scope.errorMessage = [];
            };
            
            
            
            $scope.vote = function() 
            {
                if(!selectedAnswerID) 
                {
                    $scope.errorMessage.push("Must select an option to cast a vote.");
                } 
                    else 
                {
                    var posturl = 'index.php/services/votes/' + pollID + '/' + selectedAnswerID;
                    
                    $http.post(posturl).success(function()
                    {
                       alert('Thank you for voting.');
                       $location.path('/');
                    });
                }
            };
        }
    ]);
    
    pollsControllers.controller('AdminPollListCtrl', ['$scope', '$http',
        function ($scope, $http) {
            $scope.title = 'Stupid polls';
            $scope.polls = [];
            $scope.author = 'Mathew Hylkema';
            
            var url = 'index.php/services/polls';
            
            $http.get(url).success(function(data)
            {
                $scope.polls = data;
            });
        } 
    ]);
    
    pollsControllers.controller('AdminPollCtrl', ['$scope', '$routeParams', '$http', '$route',
        function($scope, $routeParams, $http, $route) {
            $scope.title = 'Stupid polls';
            $scope.author = 'Mathew Hylkema';
            $scope.polls = [];
            $scope.votes = [];
            $scope.poll;
            $scope.total = 0;
            
            var pollID = $routeParams.pollId;
            var getPollUrl = 'index.php/services/polls/' + pollID;
            var votesUrl = 'index.php/services/votes/' + pollID;
            
            
            $http.get(getPollUrl).success(function(data)
            {
                $scope.polls = data;
                $scope.poll = $scope.polls[0];
            });
            
            $http.get(votesUrl).success(function(data)
            {
                $scope.votes = data;
                for(var i = 0; i <= data.length; i++) 
                {
                    $scope.total = parseInt($scope.total) +  parseInt(data[i].Count);
                }
            });
            
            $scope.deleteVotes = function() {
                
                $http.delete(votesUrl).success(function()
                {
                   alert('Votes deleted.');
                   $route.reload();
                });
            };
        }
    ]);
}());