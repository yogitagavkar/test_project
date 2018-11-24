app.factory('productservice',['$http','$localStorage','$rootScope',function($http,$localStorage,$rootScope)
{
     
	return {

		fetchcategories : function(success,error)
        {
           
            var request = {
                headers: {'Content-Type': undefined},
                method: "GET",
                url: $rootScope.BASE_URL + 'product/fetchcategories',                 
                
            };

            $http(request).then(success).catch(error);

        },
        fetchproducts: function(success,error)
        {
            console.log($rootScope.BASE_URL)
           
            var request = {
                headers: {'Content-Type': undefined},
                method: "GET",
                url: $rootScope.BASE_URL + 'product/fetchproducts',                 
                
            };

            $http(request).then(success).catch(error);

        },
        fetchcartproduct: function(success,error)
        {
           
            var fd = new FormData();
             fd.append('user_id',$localStorage.user_id);
            var request = {
                headers: {'Content-Type': undefined},
                method: "POST",
                url: $rootScope.BASE_URL + 'product/fetchcartproduct', 
                data:fd                
                
            };

            $http(request).then(success).catch(error);

        },
        add_product : function(data,success,error)
        {
            var fd = new FormData();
             angular.forEach(data.image,function(val){
               
                       fd.append('image',val);
                    })

           
            // fd.append('image',data.image);
            fd.append('category_id',data.category_id);
            fd.append('product_name',data.product_name);
            fd.append('description',data.description);
            fd.append('price',data.price);
            var request = {
                headers: {'Content-Type': undefined},
                method: "POST",
                url: $rootScope.BASE_URL + 'product/add_product',
                data:fd

                
            };

            $http(request).then(success).catch(error);

        },
        remove_product : function(data,success,error)
        {
            var fd = new FormData();
       
            fd.append('cart_id',data);
           
            var request = {
                headers: {'Content-Type': undefined},
                method: "POST",
                url: $rootScope.BASE_URL + 'product/remove_product',
                data:fd

                
            };

            $http(request).then(success).catch(error);

        },
        addtocart: function(data,success,error)
        {
            var fd = new FormData();
           
            fd.append('category_id',data.category_id);
            fd.append('product_id',data.product_id);
            fd.append('user_id',data.user_id);
            
            
            var request = {
                headers: {'Content-Type': undefined},
                method: "POST",
                url: $rootScope.BASE_URL + 'product/addtocart',
                data:fd

                
            };

            $http(request).then(success).catch(error);

        },
        order_completed: function(data,success,error)
        {
            var fd = new FormData();
           angular.forEach(data.cartdata,function(val){
           
                   fd.append('cart_data[]',val.cart_id);
                })

           
            // fd.append('cart_data',data.cartdata);
            fd.append('user_id',data.user_id);
            
            var request = {
                headers: {'Content-Type': undefined},
                method: "POST",
                url: $rootScope.BASE_URL + 'product/order_completed',
                data:fd

                
            };

            $http(request).then(success).catch(error);

        },


        
        
    } 
}])
