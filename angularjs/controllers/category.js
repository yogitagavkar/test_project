app.controller('category', ['$scope','$rootScope','$location','$localStorage','$filter','manufacturerservice', function($scope,$rootScope,$location,$localStorage,$filter,manufacturerservice)
{
	

$scope.addcategory=function()
{
	 var formData={};
	 formData.category_name=$scope.category_name;

	 if($scope.category_name=="" || $scope.category_name==undefined)
	 {
	 	 $scope.category_err=true;
	 	 $scope.category_err_msg="Category Name Required";
	 }
	 else
	 {
	 	 $scope.category_err=false;
	 	 categoryservice.add_category(formData,function(res)
	 	 {

	 	 	if(res.data.rc==1 || res.data.rc==true)
	 	 	{
	 	 		alert(res.data.msg)
	 	 		$location.path('home');
	 	 	}
	 	 	else
	 	 	{
	 	 		alert(res.data.msg)
	 	 		$location.path('home');
	 	 	}
	 	 })

	 }

}
 
}]);