<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<style>

.input-box{

    padding : 20px;
    width : 50%;
    height: 15px;
    margin : 15px;
    font-size : 15px;
}

button{

    width: 20%;
    height: 30px;
    margin: 10px;
    color: black;
    font-size: 15px;
    border-radius: 10px;
    background-color:white;

}

button:disabled {
    color : gray;
}

</style>
<div style = 'background-color: gray;height:100%;padding:50px;margin:0' class = 'container' align = 'center'>
    <div style = 'width:50%;background-image: linear-gradient(blue, white);border-radius:10px;box-shadow: 5px 10px #777777;' align = 'center'>                    
        <div class="white-panel">
            <div class="login-show" style = 'padding:10px;' ng-app="app" ng-controller="Login-Ctr">
                <form action="/dashboard" method = 'POST' name = 'login'>
                    <h2>LOGIN</h2>
                    <input type="text" placeholder="Email" class = 'input-box' name = 'email' ng-model="email" required />
                    <div ng-show = 'invalidEmail' style = "color:red"> Invalid Email!!</div>
                    <input type="password" placeholder="Password" class = 'input-box' name = "password" ng-model="password" required /><br>
                    <div ng-show = 'invalidPassword' style = "color:red"> Invalid Password!!</div>
                    <button type="submit" ng-click = "validation($event)" ng-disabled="login.$invalid">Submit</button>
                </form>
            </div>
        </div>
    </div>
<div>


<script>

// Login Controller

var app = angular.module('app', []);
app.controller('Login-Ctr', function($scope,$http) {
    $scope.invalidPassword = false;
    $scope.invalidEmail = false;
    $scope.validation = function(event){
        event.preventDefault();
        if($scope.email && $scope.password){
            rgex = RegExp(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
            if(rgex.test($scope.email)){
                $http({
                        method : "POST",
                        url : "loginVerify",
                        data : {'email' : $scope.email,'password' : $scope.password}
                    }).then(function mySuccess(response) {
                        
                        if(response.data.access_token){
                            //$http.defaults.headers.common.Authorization = 'Bearer ' +response.data.access_token
                            window.location.href = '/dashboard';                            
                        }
                        
                    }, function myError(response) {

                        alert(response.data.error);
                    });
            }
            else{
                $scope.invalidEmail = true;
            } 
        }
        else{
            $scope.invalidPassword = true;
            $scope.invalidEmail = true;
        }    

    }

});



</script>

