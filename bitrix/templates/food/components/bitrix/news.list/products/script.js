var productsApp = angular.module('pureCountry', [
	'ngRoute',
	'ngSanitize',
	'ngAnimate',
	'productsControllers'
])




productsApp.config(['$routeProvider', 
	function($routeProvider) {
		$routeProvider
			.when('/articles', {
				templateUrl: 'list.html',
				controller: 'productsController'
			})
			.when('/articles/:sectionCode', {
				templateUrl: 'list.html',
				controller: 'productsController',
			})
			.when('/articles/:sectionCode/:articleId', {
				templateUrl: 'detail.html',
				controller: 'productsController',
			})
			.otherwise({
				redirectTo: '/articles'
			})
	}]
)




var productsControllers = angular.module('productsControllers', [])
productsControllers.controller('productsController', ['$scope', '$routeParams',
	function($scope, $routeParams) {
		$scope.productsData = eval($('#articlesData').text())
		$scope.filterBySection = false
		if($routeParams.sectionCode){
			for(var s in $scope.productsData.SECTIONS){
				if($scope.productsData.SECTIONS[s].CODE==$routeParams.sectionCode){
					$scope.filterBySection = s
					break
				}
			}
		}
		$scope.separatorClasses = function(index){
			var classes = [],
				i = index+1
			if(i%2==0) {
				classes.push('visible-sm')
			}
			if(i%3==0) {
				classes.push('visible-md')
				classes.push('visible-lg')
			}
			return classes
		}
		$scope.article = false
		if($routeParams.articleId){
			for(var s in $scope.productsData.ARTICLES){
				if($scope.productsData.ARTICLES[s].ID==$routeParams.articleId){
					$scope.article = $scope.productsData.ARTICLES[s];
					break
				}
			}
		}
	}
])
