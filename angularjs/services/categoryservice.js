app.factory('categoryservice',['$http','$localStorage','$rootScope',function($http,$localStorage,$rootScope)
{
  
	return {

		add_category : function(data,success,error)
        {
            var fd = new FormData();

            fd.append('category_name',data.category_name);
         
            var request = {
                headers: {'Content-Type': undefined},
                method: "POST",
                url: $rootScope.BASE_URL + 'category/add_category',                 
                data: fd
            };

            $http(request).then(success).catch(error);

            //$http.post(baseUrl+"users/register",data).success(success).error(error);

        }
        
    } 
}])
