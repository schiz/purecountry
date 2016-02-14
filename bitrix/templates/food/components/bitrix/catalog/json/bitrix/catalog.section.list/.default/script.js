var app = angular.module('pureCountry', [
	'ngRoute',
	'ngSanitize',
	'ui.bootstrap',
	'ngAnimate',
	'catalogControllers'
])




app.config(['$routeProvider', 
	function($routeProvider) {
		$routeProvider
			.when('/', {
				templateUrl: 'list.html',
				controller: 'catalogController'
			})
			.when('/:sectionCode', {
				templateUrl: 'list.html',
				controller: 'catalogController'
			})
			.when('/:sectionCode/:itemId', {
				templateUrl: 'detail.html',
				controller: 'catalogController'
			})
			.otherwise({
				redirectTo: '/'
			})
	}]
)



var catalogControllers = angular.module('catalogControllers', [])
catalogControllers
	.controller('catalogController', ['$rootScope', '$scope', '$routeParams',
		function($rootScope, $scope, $routeParams) {
			$scope.sections = eval($('#catalogData').text())
			$rootScope.topSection = false
			$rootScope.filterBySection = false

            function SelectFromArray(arr, field, value){
                var result = false
                for(var s in arr){
                    if(arr[s][field]==value){
                        result = arr[s]
                        break
                    }
                }
                return result
            }

			if($routeParams.sectionCode){
                $rootScope.filterBySection = SelectFromArray($scope.sections, 'CODE', $routeParams.sectionCode)
                if($rootScope.filterBySection.SECTION_ID==0){
                    $rootScope.topSection = $rootScope.filterBySection.ID
                }else{
                    $rootScope.topSection = SelectFromArray($scope.sections, 'ID', $rootScope.filterBySection.SECTION_ID)['ID']
                }
			} 
            if($routeParams.itemId){

            }else{

            }

		}
	])