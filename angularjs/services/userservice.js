app.factory('userservice',['$http','$localStorage','$rootScope',function($http,$localStorage,$rootScope)
{

	return {

		register : function(data,success,error)
        {
            var fd = new FormData();
         
            fd.append('address',data.address);
            fd.append('email',data.email);
            fd.append('password',data.password);
            fd.append('mobile',data.mobile);
            fd.append('username',data.username);
            var request = {
                headers: {'Content-Type': undefined},
                method: "POST",
                url: $rootScope.BASE_URL + 'user/register', 
                data: fd                 
                
            };

            $http(request).then(success).catch(error);

        },
        login : function(data,success,error)
        {
            var fd = new FormData();
         
           
            fd.append('email',data.email);
            fd.append('password',data.password);
          
            var request = {
                headers: {'Content-Type': undefined},
                method: "POST",
                url: "http://localhost/crud/admin_panel/index.php/" + 'user/login', 
                data: fd                 
                
            };

            $http(request).then(success).catch(error);

        },
        
        
    } 
}])
