$(function(){
    $(window).scroll(function(){ 
         var scroll = $(window).scrollTop();
         if (scroll){
             $('.catalog-sections').addClass('cs-light');
             $('.pagehead').addClass('cs-light');
         }else{
              $('.catalog-sections').removeClass('cs-light');
              $('.pagehead').removeClass('cs-light');
          }
     });
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
            function hasDescr(id, ob){
                for(i in ob){
                    if(ob[i].ID==id)break;
                }
                if(ob[i].DESCRIPTION) return true;
                return false;
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
                    $rootScope.topSection = $rootScope.filterBySection.ID;
                    $rootScope.ActiveClass = $rootScope.filterBySection.CODE;
                }else{
                    $rootScope.topSection = SelectFromArray($scope.sections, 'ID', $rootScope.filterBySection.SECTION_ID)['ID']
                    $rootScope.ActiveClass = SelectFromArray($scope.sections, 'ID', $rootScope.filterBySection.SECTION_ID)['CODE']
                }
                $rootScope.topSectionDesc = hasDescr($rootScope.topSection, $scope.sections)
                url += $routeParams.sectionCode+'/'
	            if($routeParams.itemId){
					url += $routeParams.itemId+'/'
					$http.get(url).success(function(data) {
                        data.DESCRIPTION = data.PREVIEW_TEXT[Math.floor(Math.random() * (data.PREVIEW_TEXT.length))];
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
					for(var j in data) {
                        for(var i in data[j]){
						    var itemSection = SelectFromArray($scope.sections, 'ID', data[j][i].SECTION_ID)
						    data[j][i].SECTION_NAME = itemSection['NAME']
						    data[j][i].SECTION_CODE = itemSection['CODE']
                        }
					}
					$scope.items = data;
                    if(data.DESCRIPTION){
                        $scope.htmlDescr = data.DESCRIPTION;
                    }
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
            $scope.bigItemColumn = function(index,parentIndex){
                var rtrn = [];
                    rtrn[0] = 3;
                    rtrn[1] = '';
                switch(parentIndex%4){
                    case 0:
                    if(index==0) {
                        rtrn[0] = 6;
                        rtrn[1] = 'height:500px;';
                    }
                    break;
                    case 1:
                    break;
                    case 2:
                        if(index==4) {
                            rtrn[0] = 6;
                            rtrn[1] = 'height:500px;margin:auto;float:none';
                        }else if(index==0 || index==2){
                            rtrn[1] = 'float:left;';
                            if(index==2){
                                rtrn[1]=rtrn[1]+'clear: left;';
                            }    
                        }else if(index==1 || index==3){
                            rtrn[1] = 'float:right;';    
                        }                    
                    break;
                }
                    
                return rtrn;
			}
/*
			console.log($rootScope)
			console.log($scope)
*/
		}
	])
