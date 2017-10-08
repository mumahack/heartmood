var myApp = angular.module('heartmood',[]);
myApp.controller('HeartMoodController', ['$scope', function($scope) {
  $scope.HeartRate = 90;
  $scope.UserName = "Anna";
  $scope.UserWeight = 55;
  $scope.UserSex = 1; // 0 to male, 1 to female
  $scope.UserAge = 26;
  $scope.MyMood = "My mood";
  $scope.TotalCalories = 0;

  $scope.getHeartRate = function() {
    $scope.HeartRate = Math.floor(Math.random() * (4 - 1) + 79);

    var calories = 0;
    if( $scope.UserSex == 0)
    { // Male
        calories = ((-55.0969 + (0.6309 * $scope.HeartRate) + (0.1988 * $scope.UserWeight) + (0.2017 * $scope.UserAge))/4.184) * 60 * 0.00028;
    }
    else
    { // Female
        calories =  ((-20.4022 + (0.4472 * $scope.HeartRate) - (0.1263 * $scope.UserWeight) + (0.074 * $scope.UserAge))/4.184) * 60 * 0.00028;
    }
    $scope.TotalCalories =  $scope.TotalCalories + calories;

    

    $scope.$applyAsync();
  }


  $scope.getHeartRate();
  setInterval(function() {
      $scope.getHeartRate();
  }, 1000);
}]);

