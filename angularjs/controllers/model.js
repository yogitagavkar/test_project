app.controller('model', ['$scope','$rootScope','$location','$localStorage','$filter','manufacturerservice','modelservice','$route', function($scope,$rootScope,$location,$localStorage,$filter,manufacturerservice,modelservice,$route)
{
   $scope.modelrecord=true;
	 manufacturerservice.fetchmanufacturer(function(res)
 	 { 
 	 	console.log(res)
 	 	if(res.data.rc==true)
 	 	{
 	 		 $scope.manufacturerdata=res.data.data;
 	 	}
 	 	else
 	 	{
 	 		 $scope.manufacturerdata={};
 	 	}
       
 	 })


 	 manufacturerservice.fetchmodel(function(res)
 	 { 
 	 	//console.log(res)
 	 	if(res.data.rc==true)
 	 	{
 	 		 $scope.modeldata=res.data.data;
 	 	}
 	 	else
 	 	{
 	 		 $scope.modeldata={};
 	 	}
       
 	 })

 	 $scope.sold_model=function(id)
 	 {
 	 	//alert(id)

 	 	if(id=="" || id==undefined)
 	 	{
      
 	 	}
 	 	else
 	 	{
            modelservice.delete_model(id,function(res)
		 	 {
		 	 	console.log(res)

		 	 	if(res.data.rc==1 || res.data.rc==true)
		 	 	{
		 	 		alert(res.data.msg)
		 	 		$route.reload();
		 	 	}
		 	 	else
		 	 	{
		 	 		alert(res.data.msg)
		 	 		$route.reload();
		 	 	}
		 	 })
 	 	}

 	 }


 	 $scope.view_details=function(ids)
 	 {
 	 //	alert(ids)
        $scope.modelldata=[];
        $scope.modelldata.length=0;
 	 	if(ids=="" || ids==undefined)
 	 	{
      
 	 	}
 	 	else
 	 	{
 	 		
 	 		//$scope.modelldata="";

            modelservice.view_details(ids,function(res)
		 	 {
		 	 	//console.log(res)
		 	 	

		 	 	if(res.data.rc==1 || res.data.rc==true)
		 	 	{

		 	 		
		 	 		//$location.path('view_details');
		 	 		
		 	 		$scope.modelrecord=false;
		 	 		$scope.modelrecorddetails=true;

		 	 		$scope.modelldata=res.data.data;
		 	 		console.log($scope.modelldata)
		 	 		//$route.reload();
		 	 	}
		 	 	else
		 	 	{
		 	 		$scope.modelldata=[];
		 	 		//alert(res.data.msg)
		 	 		//$route.reload();
		 	 	}
		 	 })
 	 	}

 	 }


 	 


 $scope.addmodel=function()
{

	//console.log($scope.manufacturer_id)
	 var formData={};
	 formData.manufacturer_id=$scope.manufacturer_id;
	 formData.model_name=$scope.model_name;
	 formData.modelcolor=$scope.modelcolor;
	 formData.manufacturing_year=$scope.manufacturing_year;
	 formData.registration_no=$scope.registration;
	 formData.note=$scope.note;
	 formData.image=$scope.image;
	 
	 if($scope.manufacturer_id=="" || $scope.manufacturer_id==undefined)
	 {
	 	 $scope.manufacturer_err=true;
	 	 $scope.manufacturer_err_msg="Manufacturer Required";
	 }
	 else if($scope.model_name=="" || $scope.model_name==undefined || $scope.model_name==0)
	 {
	 	 $scope.model_err=true;
	 	 $scope.model_err_msg="Model Name Required";
	 }
	 else if($scope.modelcolor=="" || $scope.modelcolor==undefined)
	 {
	 	 $scope.color_err=true;
	 	 $scope.color_err_msg="Color Required";
	 }
	 else if($scope.manufacturing_year=="" || $scope.manufacturing_year==undefined)
	 {
	 	 $scope.manufacturing_year_err=true;
	 	 $scope.manufacturing_year_err_msg="Manufacturer Year Required";
	 }
	  else if($scope.registration=="" || $scope.registration==undefined)
	 {
	 	 $scope.registration_no_err=true;
	 	 $scope.registration_no_err_msg="Registration Number Required";
	 }
	  else if($scope.note=="" || $scope.note==undefined)
	 {
	 	 $scope.note_err=true;
	 	 $scope.note_err_msg="Note Required";
	 }
	  else if($scope.image=="" || $scope.image==undefined)
	 {
	 	 $scope.image_err=true;
	 	 $scope.image_err_msg="Image of model Required";
	 }
	 else
	 {
	 	$scope.manufacturer_err=false;
	 	$scope.model_err=false;
	 	$scope.color_err=false;
	 	$scope.manufacturing_year_err=false;
        $scope.registration_no_err=false;
        $scope.note_err=false;
        $scope.image_err=false;
	 	 modelservice.add_model(formData,function(res)
	 	 {
	 	 	console.log(res)

	 	 	if(res.data.rc==1 || res.data.rc==true)
	 	 	{
	 	 		alert(res.data.msg)
	 	 		$route.reload();
	 	 	}
	 	 	else
	 	 	{
	 	 		alert(res.data.msg)
	 	 		$route.reload();
	 	 	}
	 	 })

	 }

}

	
 
}]);