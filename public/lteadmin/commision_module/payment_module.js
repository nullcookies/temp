// JavaScript Document

var app = angular.module('app',[]).config(function($interpolateProvider){
    $interpolateProvider.startSymbol('[[').endSymbol(']]');
});

app.controller('paymnetParentController',['$http','$scope',function($http,$scope){
	
	      











		$scope.get_data_from_reff_show_table =  function(){
		$http({
			
			method:'get',
			url:'get_data_from_reff_show_table',
			
			}).then(function(responce){
			    $scope.reffVal = responce.data;
		        
				    $http({
                       
                              method:'get',
                              url:'/public/admin/payments/charts',



				    }).then(function(response){
                      
                         var dataline =  response.data;        

				    $scope.formatDate =  function(myDate){
						var m_names = new Array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");

						var d = new Date(myDate);
						
						var curr_month = d.getMonth();
						//var curr_year = d.getFullYear();
						//return (m_names[curr_month] + "-" + curr_year);
						return (m_names[curr_month]);
					}
				  console.log("yaha");
				     if(dataline.length <= 1){
                       console.log("zero se chota hai");
				     	var dataline = [{month: "2017-07", sales: 0},{month: "2017-07", sales: 0}]
				     }
				   


				new Morris.Line({
					element: 'line',
					data: dataline,
					// The name of the data record attribute that contains x-values.
					xkey: 'month',
					// A list of names of data record attributes that contain y-values.
					ykeys: ['sales'],
					// Labels for the ykeys -- will be displayed when you hover over the
					// chart.
					labels: ['Sales'],
					xLabelFormat: function(str){
						return $scope.formatDate(str);
					},
					preUnits: 'Rs'
	                });

                   
				    },function(response){

				    });
			
				
				console.log(responce.data);
				},function(responce){
					
					
					});
		
		
		}
		
		//$scope.view_all_from_reff_cntrl=  function(){
//		$http({
//			
//			method:'get',
//			url:'view_all_from_reff_cntrl',
//			
//			}).then(function(responce){
//			  //  $scope.reffVal = responce.data;
//				//console.log(responce.data);
//				},function(responce){
//					
//					
//					});
//		
//		
//		}
	$scope.add_to_rimmidence_history = function(){
		$http({
			
			method:'get',
			url:'add_data_to_referecnce_table',
			
			}).then(function(responce){
			 
				},function(responce){
					
					
					});
		
		
		}
	$scope.get_me_gmv = function(){
		$http({
			
			method:'get',
			url:'get_commision',
			
			}).then(function(responce){
			    $scope.gmv =responce.data;
				$scope.get_unbilled_ammount_from_table();
				$scope.get_billed_ammount_from_table();
				$scope.get_data_from_reff_show_table();
				},function(responce){
					
					
					});
		
		} 
	
	
	$scope.get_unbiled_amount = function (){
		//alert('working');
		$http({
			
			method:'get',
			url:'get_unbiled_amount',
			
			}).then(function(responce){
			    //$scope.gmv =responce.data;
				
				},function(responce){
					
					
					});
		
		
		
		
		
		
		}
	
	
	
	
	$scope.put_biled_amount = function (){
		//alert('working');
		$http({
			
			method:'get',
			url:'put_biled_amount',
			
			}).then(function(responce){
			    //$scope.gmv =responce.data;
				
				},function(responce){
					
					
					});
		
		
		
		
		
		
		}
	
	
	
	$scope.get_unbilled_ammount_from_table = function(){
		
			$http({
			
			method:'get',
			url:'get_unbilled_ammount_from_table',
			
			}).then(function(responce){
			    $scope.unbiled_amount_data =responce.data[0].unbilled_amount;
				
				},function(responce){
					
					
					});
		
		
		
		
		}
		$scope.get_billed_ammount_from_table = function(){
		
			$http({
			
			method:'get',
			url:'get_billed_ammount_from_table',
			
			}).then(function(responce){
			    $scope.biled_amount_data =responce.data[0].amount;
				
				},function(responce){
					
					
					});
		
		
		
		
		}
	
	}]);
	
	