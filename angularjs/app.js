var app = angular.module('FormApp', ['ngRoute','ngStorage','ngToast']);

app.config(function($routeProvider,$locationProvider){
	$routeProvider

		.when('/home',{
			controller: 'home',
			templateUrl: 'partials/home.html'
		})
		.when('/manufacturer',{
			controller: 'manufacturer',
			templateUrl: 'partials/manufacturer.html'
		})
		.when('/model',{
			controller: 'model',
			templateUrl: 'partials/model.html'
		})
		
		

		
		

		
		/*.when('/social/:token',{
			controller: 'social',
			templateUrl: 'partials/social.html'
		})*/
		.otherwise({
			redirectTo: '/'
		});

		$locationProvider.html5Mode(true);

	}).run(['$rootScope','$localStorage','$window','$location','$route',function($rootScope,$localStorage,$window,$location,$scope,$route){
		$rootScope.$on("$routeChangeSuccess",function(event,next,current)
		{


			$rootScope.BASE_URL = "http://localhost/car_inventory/admin_panel/index.php/";
			$rootScope.BASEURL = "http://localhost/car_inventory/admin_panel/";

    	
 
    	$window.scrollTo(0,0);
    	$('.footer').fadeIn(500);

      
       
        
    })


	}]);



	

	app.directive('ngFile', ['$parse', function ($parse) {
		return {
			restrict: 'A',
			link: function(scope, element, attrs) {
				element.bind('change', function(){

					$parse(attrs.ngFile).assign(scope,element[0].files)
					scope.$apply();
				});
			}
		};
	}]);






function filesModelDirective()
{
	return {
		controller: function($parse, $element, $attrs, $scope)
		{
			var exp = $parse($attrs.filesModel);
			$element.on('change', function()
			{
				exp.assign($scope, this.files[0]);
				$scope.$apply();
			});
		}
	};
}

app.directive('filesModel', filesModelDirective)

