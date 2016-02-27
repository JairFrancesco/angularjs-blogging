// JavaScript Document
'use strict';

blogPost.controller('CreatePostCtrl', function($scope, $rootScope, $location, $http){

    $scope.postPage = function(){		
        $location.url('/post');
    }

    $scope.createPost = function(){
		
		//During application kikstart, check for our object in the local storage
      var tokenId = window.localStorage.getItem('TokenId');

      //Check if our token/ object doesnt exists from localstarage
      //Redirect the user to the login form,
      //else login in the user using obtained token
	  //console.log(token);
      if(tokenId){           
		   $scope.userId = tokenId; 
      }

				
			$http.post("sys/create-post.php", {'title': $scope.data.title, 'description': $scope.data.description, 'username':$scope.data.username, 'user':$scope.userId}).success(function(data, status, headers, config){			     
				  $scope.show = true
			}).error(function(data, status) {
                        $scope.error = true;						
                    });
        }
		
})