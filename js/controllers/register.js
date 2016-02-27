// JavaScript Document

blogPost.controller('RegisterCtrl', function($scope, $location, $http){

   $scope.postPage = function(){
        $location.url('/post');
    }
	
	$scope.createUser = function(){
         	console.log($scope.user);
			
			$scope.registered = [];
			$scope.error = [];
			
			$http.post("sys/create-user.php", {'name': $scope.user.name, 'email': $scope.user.email, 'password':$scope.user.password}).then(function(response) {
				if(response.data.registered){
					$scope.saved = response.data;
					$scope.user = '';
				}
				if(response.data.exist){
					$scope.data = response.data;
				}if(response.data.failed){
					$scope.failure = response.data;
				}                      
        }, function(response) {
            $scope.data = response.data || "Request failed";
      });    
    }
	
	
})