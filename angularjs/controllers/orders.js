app.controller('orders', ['$scope','$rootScope','$location','$localStorage','$filter','orderservice', function($scope,$rootScope,$location,$localStorage,$filter,orderservice)
{
	
orderservice.fetchorders(function(res)
 	 { 
 	 	
 	 	if(res.data.rc==true)
 	 	{
 	 		 $scope.orders=res.data.data;
 	 		// console.log(orders)
 	 	}
 	 	else
 	 	{
 	 		 $scope.orders={};
 	 	}
       
 	 })

 
}]);