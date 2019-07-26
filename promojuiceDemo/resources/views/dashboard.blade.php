<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>

<div align = 'center' ng-app="dashboard" ng-controller="Dashboard-Ctr">
    <h1> Welcome <h1>
    <button  ng-click = "logout()"> logout </button>
</div>

<script>

// Logout Controller

var app = angular.module('dashboard', []);
app.controller('Dashboard-Ctr', function($scope,$http) {
    $scope.logout = () => {
    $http({
            method : "POST",
            url : "logout"
        }).then(function mySuccess(response) {
            
            window.location.reload();

        }, function myError(response) {

            alert(response.data.error);
        });
    }
});

</script>