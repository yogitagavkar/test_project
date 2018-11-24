app.factory('orderservice',['$http','$localStorage','$rootScope',function($http,$localStorage,$rootScope)
{

	return {

		fetchorders : function(success,error)
        {
           
            var request = {
                headers: {'Content-Type': undefined},
                method: "GET",
                url: $rootScope.BASE_URL + 'order/fetchorders',                 
                
            };

            $http(request).then(success).catch(error);

        },
        
        
    } 
}])
