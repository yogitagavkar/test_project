app.controller('home', ['$scope','$rootScope','$location','$localStorage','$filter', function($scope,$rootScope,$location,$localStorage,$filter)
{
	
	//$scope.image_url=$rootScope.BASEURL+'product_image/';
	$scope.cartdata={};
	$scope.user_id=$localStorage.user_id;
	$scope.is_admin=$localStorage.is_admin;
	//console.log($scope.is_admin)

}]);