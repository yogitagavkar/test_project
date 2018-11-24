app.controller('registeruser', ['$scope','$rootScope','$location','$localStorage','$filter','userservice', function($scope,$rootScope,$location,$localStorage,$filter,userservice)
{

 
	
$scope.register=function()
{


	 var formData={};
	 formData.username=$scope.username;
	 formData.password=$scope.password;
	 formData.address=$scope.address;
	 formData.email=$scope.email;
	 formData.mobile=$scope.mobile;

	 if($scope.username=="" || $scope.username==undefined)
	 {
	 	 $scope.name_err=true;
	 	 $scope.name_err_msg="User Name Required";
	 }
	 else if($scope.password=="" || $scope.password==undefined)
	 {
	 	 $scope.password_err=true;
	 	 $scope.password_err_msg="Password Required";
	 }
	 else if($scope.address=="" || $scope.address==undefined)
	 {
	 	 $scope.address_err=true;
	 	 $scope.address_err_msg="Address Required";
	 }
	 else if($scope.email=="" || $scope.email==undefined)
	 {
	 	 $scope.email_err=true;
	 	 $scope.email_err_msg="Email Required";
	 }
	 else if($scope.mobile=="" || $scope.mobile==undefined)
	 {
	 	 $scope.mobile_err=true;
	 	 $scope.mobile_err_msg="Mobile Required";
	 }
	 else
	 {
	 	$scope.name_err=false;
	 	$scope.mobile_err=false;
	 	$scope.address_err=false;
	 	$scope.email_err=false;
	 	$scope.password_err=false;
	 	 userservice.register(formData,function(res)
	 	 {
	 	 	//console.log(res)

	 	 	if(res.data.rc==1 || res.data.rc==true)
	 	 	{
	 	 		
	 	 		$localStorage.user_id=res.data.user_id;
	 	 		$localStorage.is_admin=res.data.is_admin;
	 	 		
	 	 		$location.path('login');
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