$(document).ready(function() {
    $(window).scroll(function(){ 
         var scroll = $(window).scrollTop();
         if(!noScroll){
             if (scroll){
                 $('.catalog-sections').not('.no-scroll').addClass('cs-light bg-grey').removeClass('bg');
                 $('.pagehead').addClass('cs-light');
             }else{
                  $('.catalog-sections').not('.no-scroll').removeClass('cs-light bg-grey').addClass('bg');
                  $('.pagehead').removeClass('cs-light');
             }
         }
     });

    //всплывающий pop-up
    $(".log-in").fancybox();
});


var app = angular.module('pureCountry', [
	'ngRoute',
	'ngSanitize',
	'ngAnimate',
	'ui.bootstrap',
	'catalogControllers',
	'filters',
	'widgets'
])

var app = angular.module('catalogMenu', []);

app.directive("scroll", function () {
    return function(scope, element, attrs) {
        angular.element(element).bind("scroll", function() {
            scope[attrs.scroll] = true;
            scope.$apply();
        });
    };
});


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
	.controller('catalogController', ['$rootScope', '$scope', '$http', '$routeParams', '$filter',
		function($rootScope, $scope, $http, $routeParams, $filter) {
			$scope.sections = eval($('#catalogData').text())
			$rootScope.topSection = false
			$rootScope.filterBySection = false
			$scope.items = []
        	var url = '/api/catalog/'

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
			function WordByNum(num, word_one, word_two, word_many) {
               var lastnum = num % 10;
               if(lastnum == 1 && (num < 10 || num > 20)) {
                    word = word_one;
               } else if((lastnum>=2&&lastnum<=4) && (num < 10 || num > 20)) {
                    word = word_two;
               } else {
                    word = word_many;
               }
               return word;
			}

			if($routeParams.sectionCode){
                $rootScope.filterBySection = SelectFromArray($scope.sections, 'CODE', $routeParams.sectionCode)
                if($rootScope.filterBySection.SECTION_ID==0){
                    $rootScope.topSection = $rootScope.filterBySection.ID
                }else{
                    $rootScope.topSection = SelectFromArray($scope.sections, 'ID', $rootScope.filterBySection.SECTION_ID)['ID']
                } 
                url += $routeParams.sectionCode+'/'
	            if($routeParams.itemId){
					url += $routeParams.itemId+'/'
					$http.get(url).success(function(data) {
						$scope.item = data
						$scope.item.QUANTITY = 1
						for(var i in $scope.item.RECIPES){
							var r = $scope.item.RECIPES[i]
							$scope.item.RECIPES[i].CTIME = {VALUE: r.TIME, LABEL: WordByNum(r.TIME, 'минуту', 'минуты', 'минут')}
						}
					})
	            }
			}
			if(!$routeParams.itemId){
				$http.get(url).success(function(data) {
					for(var i in data) {
						var itemSection = SelectFromArray($scope.sections, 'ID', data[i].SECTION_ID)
						data[i].SECTION_NAME = itemSection['NAME']
						data[i].SECTION_CODE = itemSection['CODE']
					}
					$scope.items = data
				})
			}
			$scope.separatorClasses = function(index){
				var classes = [],
					i = index+1
				if(i%2==0) {
					classes.push('visible-xs')
				}
				if(i%3==0) {
					classes.push('visible-sm')
				}
				if(i%4==0) {
					classes.push('visible-md')
					classes.push('visible-lg')
				}
				return classes
			}
/*
			console.log($rootScope)
			console.log($scope)
*/
		}
	])
