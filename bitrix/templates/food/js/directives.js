angular.module('widgets', ['filters'])
	.controller('quantityController', ['$scope', '$element', '$filter',
		function($scope, $element, $filter){
			$scope.VALUE = $scope.value
			$scope.DISPLAY_VALUE = $filter('prettyquantity')($scope.VALUE)
			$scope.qFocus = function(){
				$scope.DISPLAY_VALUE = $scope.VALUE
			}
			$scope.qBlur = function(){
				$scope.DISPLAY_VALUE = $filter('prettyquantity')($scope.VALUE)
			}
			$scope.qChange = function(){
				var n = $scope.DISPLAY_VALUE
				if($scope.qValid(n)){
					$scope.VALUE = $scope.DISPLAY_VALUE
				}
			}
			$scope.qd = function(d){
				var n = parseInt($scope.VALUE + d)
				if($scope.qValid(n)){
					$scope.VALUE = n
					$scope.DISPLAY_VALUE = $filter('prettyquantity')($scope.VALUE)
				}
			}
			$scope.qValid = function(n){
				return (!isNaN(n)&&n>=1)?true:false
			}
		}
	])
	.directive('quantity',[function(){
		return {
			restrict: 'EA',
			replace: true,
			controller: 'quantityController',
			scope: {
				value: '='
			},
			template:
				"<div class=\"quantity-widget\">" +
					"<button type=\"button\" class=\"btn btn-link minus\" ng-click=\"qd(-1)\">-</button>" +
					"<input type=\"hidden\" name=\"quantity\" ng-model=\"VALUE\" value=\"{{VALUE}}\">" +
					"<input type=\"text\" ng-model=\"DISPLAY_VALUE\" ng-focus=\"qFocus()\" ng-blur=\"qBlur()\" ng-change=\"qChange()\">" +
					"<button type=\"button\" class=\"btn btn-link plus\" ng-click=\"qd(1)\">+</button>" +
				"</div>"
		}
	}])
