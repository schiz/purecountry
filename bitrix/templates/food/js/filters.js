
angular.module('filters', [])
	.filter('prettynumber', function() {
		return function(number) {
			return accounting.formatNumber(number, 0, ' ');
		}
	})
	.filter('prettyprice', ['$filter', function($filter) {
		return function(number) {
			return $filter('prettynumber')(number)+' Р';
		}
	}])
	.filter('prettyquantity', ['$filter', function($filter) {
		return function(number) {
			return $filter('prettynumber')(number)+' шт.';
		}
	}])