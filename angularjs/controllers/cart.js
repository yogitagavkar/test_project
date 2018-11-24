app.controller('cart', ['$scope','$rootScope','$location','$localStorage','$filter','productservice','$route', function($scope,$rootScope,$location,$localStorage,$filter,productservice,$route)
{
	
	$scope.image_url=$rootScope.BASEURL+'product_image/';
	$scope.cartdata={};
	$scope.user_id=$localStorage.user_id;
	$scope.is_admin=$localStorage.is_admin;

     productservice.fetchcartproduct(function(res)
 	 { 
 	 	
 	 	if(res.data.rc==true)
 	 	{
 	 		 $scope.products=res.data.data;
 	 		 $localStorage.cartdata=$scope.products;

 	 	}
 	 	else
 	 	{
 	 		 $scope.products={};
 	 	}
       
 	 })

 	 $scope.add_product=function(productid,catid)
	{
		// console.log(productid)
		// console.log(catid)
		 var formData={};
		 formData.product_id=productid;
		 formData.category_id=catid;
		 formData.user_id=$localStorage.user_id;


	 	 productservice.addtocart(formData,function(res)
	 	 {

	 	 	if(res.data.rc==1 || res.data.rc==true)
	 	 	{
	 	 		alert(res.data.msg)
	 	 		$route.reload();
	 	 	}
	 	 	else
	 	 	{
	 	 		alert(res.data.msg)
	 	 		$location.path('cart');
	 	 		$route.reload();
	 	 	}
	 	 })
		
	}


	 $scope.remove_product=function(cart_id)
	{
		
	 	 productservice.remove_product(cart_id,function(res)
	 	 {

	 	 	if(res.data.rc==1 || res.data.rc==true)
	 	 	{
	 	 		alert(res.data.msg)
	 	 		$location.path('cart');
	 	 		$route.reload();
	 	 	}
	 	 	else
	 	 	{
	 	 		alert(res.data.msg)
	 	 		$location.path('cart');
	 	 		$route.reload();
	 	 	}
	 	 })
		
	}

	$scope.order_completed=function(cartdata)
	{
        console.log($localStorage.cartdata)
		 var formData={};
		 formData.cartdata=$localStorage.cartdata;
		 formData.user_id=$localStorage.user_id;


	 	 productservice.order_completed(formData,function(res)
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




 
}]);