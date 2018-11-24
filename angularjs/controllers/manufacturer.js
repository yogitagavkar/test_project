app.controller('manufacturer', ['$scope','$rootScope','$location','$localStorage','$filter','manufacturerservice','$route', function($scope,$rootScope,$location,$localStorage,$filter,manufacturerservice,$route)
{
	$scope.manufacturerdisplay=true;
	$scope.add=true;
	manufacturerservice.fetchmanufacturer(function(res)
 	 { 
 	 	console.log(res)
 	 	if(res.data.rc==true)
 	 	{
 	 		 $scope.manufacturedata=res.data.data;
 	 	}
 	 	else
 	 	{
 	 		 $scope.manufacturedata={};
 	 	}
       
 	 })

	$scope.addmanufacture=function()
	{
		$scope.manufactureradd=true;
		$scope.manufacturerdisplay=false;
	}

	$scope.addcategory=function()
{
	 var formData={};
	 console.log($scope)
	 formData.category_name=$scope.category_name;

	console.log($scope.category_name)

}

	$scope.add_data=function()
	{
		
	 var formData={};
	 formData.manufacturer_name=$scope.manufacturer_name;

	 if($scope.manufacturer_name=="" || $scope.manufacturer_name==undefined)
	 {
	 	 $scope.manufacturer_err=true;
	 	 $scope.manufacturer_err_msg="Manufacturer Name Required";
	 }
	 else
	 {
	 	 $scope.manufacturer_err=false;
	 	 manufacturerservice.add_manufacturer(formData,function(res)
	 	 {

	 	 	console.log(res)

	 	 	if(res.data.rc==1 || res.data.rc==true)
	 	 	{
	 	 		alert(res.data.msg)
	 	 		$route.reload();
	 	 	}
	 	 	else
	 	 	{
	 	 		alert(res.data.msg)
	 	 		$route.reload();
	 	 	}
	 	 })

	 }

	}
	
 
}]);