// JavaScript Document

blogPost.controller('LoginCtrl', function($scope, $rootScope, $location, $localstorage, $http){

   $scope.postPage = function(){
        $location.url('/post');
    }
	
	$scope.userLogin = function(){
		console.log($scope.user);
		
		$http.post("sys/login.php", {'email': $scope.user.email, 'password':$scope.user.password}).then(
		              function(response){
								if(response.data.error){
									$scope.data = response.data;
									$scope.user = '';
									console.log($scope.data );
								}
								if(response.data.result){
									$scope.token = $scope.user.email.split('@');
									$scope.token = response.data.name;						
									
									window.localStorage.setItem("TokenSession", $scope.token);
									window.localStorage.setItem("TokenId", response.data.id);
									
									$rootScope.LogedIn = true;
									$scope.user = '';
									
									window.location.reload();
									$location.url('/post');
								}                     
						},function(response) {
								$scope.data =  "Check your login credentials";
								$scope.user = '';
					  });    
	}
})