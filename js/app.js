/**
 * Created by Tumsime on 11/24/2015.
 */
'use strict';

var blogPost = angular.module('blogApp', ['ngRoute'])

.controller('blogController', function( $scope, $location) {
	
	 $scope.logoutUser = function(){
		 window.localStorage.removeItem('TokenSession');
		 window.location.reload();
		 $location.url('/post');
	 }
	 
     
     //During application kikstart, check for our object in the local storage
      var token = window.localStorage.getItem('TokenSession');

      //Check if our token/ object doesnt exists from localstarage
      //Redirect the user to the login form,
      //else login in the user using obtained token
	  //console.log(token);
      if(token){           
		   $scope.postEnabled = true; 
		   $scope.displayForm = false;      
      }
      else{
           $scope.postEnabled = false; 
		   $scope.displayForm = true; 
		   $scope.disablePostPage = true; 
      }

    })

.config(function ($routeProvider) {
        $routeProvider

            .when('/post',{
                templateUrl:'templates/blog-details.html',
                controller:'PostCtrl'
            })
            .when('/new-post', {
                templateUrl: 'templates/new-post.html',
				controller:'CreatePostCtrl'
            })
			.when('/login', {
                templateUrl: 'templates/login.html',
				controller:'LoginCtrl'
            })
			.when('/register', {
                templateUrl: 'templates/register.html',
				controller:'RegisterCtrl'
            })


         $routeProvider.otherwise('/post')
        // $locationProvider.html5Mode(true);
    })
	
	
