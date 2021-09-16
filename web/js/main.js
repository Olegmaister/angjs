app = angular.module('app',['ngRoute']);

app.factory('pagination',function(){

});

app.config(function($routeProvider){
    $routeProvider
        .when('/',{
            template: '<h1>This my home page</h1>'
        })
        .when('/product',{
            templateUrl: 'product.html'
        })
        .when('/basket',{
            templateUrl: 'basket.html'
        })
})

app.controller('firstController',function($scope){

})

app.controller('productController',function($scope,$http,infoBasketFactory,pagination){

    $scope.infoBasketFactory = infoBasketFactory;
    $scope.quantity = 1;


    $http.get('product/test')
        .success(function(data){
            $scope.products = data.products;
            $scope.path = data.path;
            pagination.setProducts(data.products);
            $scope.products = pagination.getPageProducts();
            $scope.paginationList = pagination.getPaginationList();
        })
        .error(function (data){

        })

    $scope.addCart = function(id, quantity){

        $http({
            url: 'basket/add',
            method: "GET",
            params: {id: id,quantity:quantity}

        }).success(function(result){

            infoBasketFactory.countBasket = result.countBasket;
            infoBasketFactory.totalBasket = result.totalBasket;

        }).error(function(result){

        });

    }

});

app.controller('cartInfoController',function($scope,infoBasketFactory){
    $scope.infoBasketFactory = infoBasketFactory;
})

app.controller('basketController',function($scope,$http,infoBasketFactory){

    $http.get('basket/get-basket')
        .success(function(data){
            $scope.products = data.products;

        })
        .error(function (data){

        })

    $scope.removeBasket = function(key){

        $http({
            url: 'basket/remove',
            method: "GET",
            params: {key: key}

        }).success(function(result){

        }).error(function(result){

        });
    }

})

app.factory('infoBasketFactory',function(){
    return{
        'countBasket' : 0,
        'totalBasket' : 0
    };
})

app.factory('pagination',function(){
    var currentPage = 0;
    var itemsPerPage = 4;
    var products = [];
    return{
        setProducts:function (newProducts) {
            products = newProducts
        },
        getPageProducts: function (num) {
            var num = angular.isUndefined(num) ? 0 : num;
            var first = itemsPerPage * num;
            var last = first + itemsPerPage;
            currentPage = num;
            last = last > products.length ? (products.length-1): last;
            return products.slice(first,last)
        },

        getTotalPagesNum: function () {
            return Math.ceil(products.length/itemsPerPage);
        },

        getPaginationList: function () {
            var pagesNum = this.getTotalPagesNum();
            var paginationList = [];
            paginationList.push({
                name:'&laquo',
                link: 'prev'
            });

            for(var i= 0;i>pagesNum;i++){
                var name = i+1;
                paginationList.push({
                    name:name,
                    link: i
                });
            }

            paginationList.push({
                name:'&raquo',
                link: 'next'
            });
            if(pagesNum > 1){
                return paginationList;
            }else{
                return false;
            }
        }
    }
})
