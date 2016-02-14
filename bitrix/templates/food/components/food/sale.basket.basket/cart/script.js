var app = angular.module('pureCountry', [
	'ngSanitize',
	'cartControllers',
	'filters'
])


var cartControllers = angular.module('cartControllers', [])
cartControllers
	.controller('cartController', ['$scope', '$http', '$filter',
		function($scope, $http, $filter) {
			$scope.loading = true
			base_url = '/personal/cart/?JSON=Y'
			
			cartLoad()

			function GetTotalPrice(items){
				var tp = 0
				for(var i in items){
					tp += (parseInt(items[i].PRICE) * parseInt(items[i].QUANTITY))
				}
				return tp
			}
			function setDisplayQuantity(items){
				for(var i in items){
					items[i].DISPLAY_QUANTITY = $filter('prettyquantity')(items[i].QUANTITY)
				}
			}
			function cartLoad(params){
				params = params || ''
				$scope.loading = true
				$http.get(base_url+(base_url.indexOf('?')>-1?'&':'?')+params.replace('?','')).success(function(data) {
					$scope.items = data
					$scope.TOTAL_PRICE = GetTotalPrice($scope.items)
					setDisplayQuantity($scope.items)
					$scope.loading = false
				})
			}
			function cartRefresh(){
				var formData = {
					'BasketRefresh': 'Y',
					'BasketOrder': 'BasketOrder'
				};
				for(i in $scope.items){
					var item = $scope.items[i];
					formData['QUANTITY_INPUT_'+item.ID] = item.QUANTITY;
					formData['QUANTITY_'+item.ID] = item.QUANTITY;
				}
				$http({
					method  : 'POST',
					url     : base_url,
					data    : $.param(formData),
					headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
				})
				$scope.TOTAL_PRICE = GetTotalPrice($scope.items)
			}
			$scope.qd = function(index, value){
				var n = $scope.items[index].QUANTITY + value
				if(!isNaN(n)&&n>=0){
					$scope.items[index].QUANTITY += value
					cartRefresh();
					setDisplayQuantity($scope.items)
				}
			}
			$scope.qFocus = function(index){
				$scope.items[index].DISPLAY_QUANTITY = $scope.items[index].QUANTITY
			}
			$scope.qBlur = function(index){
				$scope.items[index].DISPLAY_QUANTITY = $filter('prettyquantity')($scope.items[index].QUANTITY)
			}
			$scope.qChange = function(index){
				var n = $scope.items[index].DISPLAY_QUANTITY
				if(!isNaN(n)&&n>=0){
					$scope.items[index].QUANTITY = $scope.items[index].DISPLAY_QUANTITY
					cartRefresh()
				}else if(n==0){
					$scope.remove(index)
				}
			}
			$scope.remove = function(index){
				cartLoad('action=delete&id='+$scope.items[index].ID)
			}
		}
	])
