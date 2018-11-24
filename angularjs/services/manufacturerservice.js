app.factory('manufacturerservice',['$http','$localStorage','$rootScope',function($http,$localStorage,$rootScope)
{
  
	return {

		fetchmanufacturer : function(success,error)
        {
           
            var request = {
                headers: {'Content-Type': undefined},
                method: "GET",
                url: $rootScope.BASE_URL + 'manufacturer/fetchmanufacturer',                 
                
            };

            $http(request).then(success).catch(error);

        },
        fetchmodel : function(success,error)
        {
           
            var request = {
                headers: {'Content-Type': undefined},
                method: "GET",
                url: $rootScope.BASE_URL + 'manufacturer/fetchmodel',                 
                
            };

            $http(request).then(success).catch(error);

        },
        add_manufacturer : function(data,success,error)
        {
            var fd = new FormData();

            fd.append('manufacturer_name',data.manufacturer_name);
         
            var request = {
                headers: {'Content-Type': undefined},
                method: "POST",
                url: $rootScope.BASE_URL + 'manufacturer/add_manufacturer',                 
                data: fd
            };

            $http(request).then(success).catch(error);

            //$http.post(baseUrl+"users/register",data).success(success).error(error);

        }
        
    } 
}])
