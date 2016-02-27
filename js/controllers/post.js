/**
 * Created by Tumsime on 11/25/2015.
 */

'use strict';

blogPost.controller('PostCtrl', function($scope, $http, $rootScope, $localstorage, $timeout){
     
		
	
	$timeout(function(){ 
		  $http.get('sys/get-post.php').then(function(responce){
			  if(responce.data.result){
				 $scope.post = responce.data;
			  }
			  if(responce.data.empty){
				  $scope.empty = responce.data;
			  }
		  },function(responce){
			  $scope.post = "Sorry, No post found..<br /> Please Login or Register to create a post.";      
		  });
	   },500);
	  
	    
		
		
		$scope.removePost = function(title){
		
		  //During application kikstart, check for our object in the local storage
          var tokenId = window.localStorage.getItem('TokenId');

		  //Check if our token/ object doesnt exists from localstarage
		  //Redirect the user to the login form,
		  //else login in the user using obtained token
		  //console.log(token);
		  if(tokenId){           
			   $scope.userId = tokenId; 
		  }
		  
		  console.log(title);

			$http.post("sys/remove-post.php", {'user':$scope.userId, 'title':title}).then(function(responce){			     
				       if(responce.data.success){
						   $scope.success = responce.data.success
					   }
					   if(responce.data.failure){
						   $scope.failure = responce.data
					   }
			},function(responce) {
                        $scope.error = true;						
                    });
        }
	  
})