app.controller('login', ['$scope','$rootScope','$location','$localStorage','$filter','userservice', function($scope,$rootScope,$location,$localStorage,$filter,userservice)
{

 //$rootScope.loginstatus=true;
	
$scope.login=function()
{


	 var formData={};
	 
	 formData.password=$scope.password;
	 formData.email=$scope.email;
	
	  if($scope.email=="" || $scope.email==undefined)
	 {
	 	 $scope.email_err=true;
	 	 $scope.email_err_msg="Email Required";
	 }
	 else if($scope.password=="" || $scope.password==undefined)
	 {
	 	 $scope.password_err=true;
	 	 $scope.password_err_msg="Password Required";
	 }
	 else
	 {
	 
	 
	 	$scope.email_err=false;
	 	$scope.password_err=false;
	 	 userservice.login(formData,function(res)
	 	 {
	 	 	//console.log(res)

	 	 	if(res.data.rc==1 || res.data.rc==true)
	 	 	{
	 	 		
	 	 		$localStorage.user_id=res.data.user_id;
	 	 		$localStorage.is_admin=res.data.is_admin;
	 	 		$rootScope.loginstatus=true;
	 	 		
	 	 		$location.path('home');
	 	 	}
	 	 	else
	 	 	{
	 	 		alert(res.data.msg)
	 	 		$location.path('login');
	 	 	}
	 	 })

	 }

}

 
}]);