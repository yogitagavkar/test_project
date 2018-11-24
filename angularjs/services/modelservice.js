app.factory('modelservice',['$http','$localStorage','$rootScope',function($http,$localStorage,$rootScope)
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
        add_model : function(data,success,error)
        {
            var fd = new FormData();
             angular.forEach(data.image,function(val){
               
                       fd.append('image[]',val);
                    })

           
            // fd.append('image',data.image);
            fd.append('manufacturer_id',data.manufacturer_id);
            fd.append('model_name',data.model_name);
            fd.append('color',data.modelcolor);
            fd.append('manufacturing_year',data.manufacturing_year);
            fd.append('registration_no',data.registration_no);
            fd.append('note',data.note);
            var request = {
                headers: {'Content-Type': undefined},
                method: "POST",
                url: $rootScope.BASE_URL + 'manufacturer/add_model',
                data:fd

                
            };

            $http(request).then(success).catch(error);

        },
        delete_model: function(data,success,error)
        {
            var fd = new FormData();
            fd.append('manufacturer_id',data);
            var request = {
                headers: {'Content-Type': undefined},
                method: "POST",
                url: $rootScope.BASE_URL + 'manufacturer/delete_model',
                data:fd

                
            };

            $http(request).then(success).catch(error);

        },
        view_details: function(data,success,error)
        {
            var fd = new FormData();
            fd.append('model_ids',data);
            var request = {
                headers: {'Content-Type': undefined},
                method: "POST",
                url: $rootScope.BASE_URL + 'manufacturer/view_details',
                data:fd

                
            };

            $http(request).then(success).catch(error);

        },
        
    } 
}])
