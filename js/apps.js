/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var app = angular.module('apps', []);

app.controller('usrFormCtrl', function($scope, $http) {
	$scope.userForm = {};
        $scope.onSubmit = function(valid) {
            if(valid) {
                console.log('valid!');
            } else {
                console.log('invalid!');
            }
        }
});