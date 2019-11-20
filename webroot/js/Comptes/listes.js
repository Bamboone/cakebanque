var app = angular.module('linkedlists', []);

app.controller('villesController', function ($scope, $http) {
    // l'url vient de add.ctp
    $http.get(urlToLinkedListFilter).then(function (response) {
        $scope.villes = response.data;
        $scope.ville = villes[1];
    });
});

