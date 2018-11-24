app.controller('product', ['$scope','$rootScope','$location','$localStorage','$filter','productservice', function($scope,$rootScope,$location,$localStorage,$filter,productservice)
{

  productservice.fetchcategories(function(res)
 	 { 
 	 	console.log(res)
 	 	if(res.data.rc==true)
 	 	{
 	 		 $scope.categories=res.data.data;
 	 	}
 	 	else
 	 	{
 	 		 $scope.categories={};
 	 	}
       
 	 })
	
$scope.addproduct=function()
{

	console.log($scope.image)
	 var formData={};
	 formData.category_id=$scope.category_id;
	 formData.description=$scope.description;
	 formData.product_name=$scope.product_name;
	 formData.price=$scope.price;
	 formData.image=$scope.image;

	 if($scope.product_name=="" || $scope.product_name==undefined)
	 {
	 	 $scope.product_name_err=true;
	 	 $scope.product_name_err_msg="Product Name Required";
	 }
	 else if($scope.category_id=="" || $scope.category_id==undefined || $scope.category_id==0)
	 {
	 	 $scope.category_err=true;
	 	 $scope.category_err_msg="Category Name Required";
	 }
	 else if($scope.description=="" || $scope.description==undefined)
	 {
	 	 $scope.description_err=true;
	 	 $scope.description_err_msg="Description of product Required";
	 }
	 else if($scope.image=="" || $scope.image==undefined)
	 {
	 	 $scope.image_err=true;
	 	 $scope.image_err_msg="Image of product Required";
	 }
	 else if($scope.price=="" || $scope.price==undefined)
	 {
	 	 $scope.price_err=true;
	 	 $scope.price_err_msg="Product Price Required";
	 }
	 else
	 {
	 	$scope.product_name_err=false;
	 	$scope.category_err_msg=false;
	 	$scope.description_err_msg=false;
	 	$scope.price_err_msg=false;
	 	 productservice.add_product(formData,function(res)
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