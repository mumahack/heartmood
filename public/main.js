var myApp = angular.module('heartmood',[]);
myApp.controller('HeartMoodController', ['$scope', function($scope) {
  $scope.HeartRate = 85;
  $scope.TargetHeartRate;
  $scope.UserName = "Anna";
  $scope.UserWeight = 55;
  $scope.UserSex = 1; // 0 to male, 1 to female
  $scope.UserAge = 26;
  $scope.Profiles = 3;  // 1 calm, 2 normal, 3 sporty 
  $scope.DisplayMood = "Normal";
  $scope.TotalCalories = 0;
  $scope.Range = 8;
  
  $scope.getProfile = function() {

      $.getJSON('getvalue', function (data) {
          var value = parseInt(data.heartbeat);
          console.log(value);
          $scope.Profiles = value;
          // get profile
          switch($scope.Profiles)
          {
              case 1: // calm
                  $scope.TargetHeartRate = 70;
                  break;
              case 2: // normal
                  $scope.TargetHeartRate = 85;
                  break;
              case 3: // sporty
                  $scope.TargetHeartRate = 100;
                  break;
          }

      });

  }

  $scope.getHeartRate = function() {
    var maxJump = Math.floor(Math.random() * (6 - 2));
    var currentDiference = $scope.TargetHeartRate - $scope.HeartRate;
    if(currentDiference < 0)
    {
        $scope.HeartRate = $scope.HeartRate - maxJump;
    }
    else
    {
        $scope.HeartRate = $scope.HeartRate + maxJump;
    }

    if((($scope.HeartRate + $scope.Range) >= $scope.TargetHeartRate) && (($scope.HeartRate - $scope.Range) <= $scope.TargetHeartRate))
    {
        switch($scope.Profiles)
        {
        case 1: // calm
            $scope.DisplayMood = "Calm";
            document.body.style.backgroundColor = "LightSlateGray";
        break;
        case 2: // normal
            $scope.DisplayMood = "Normal";
            document.body.style.backgroundColor = "SlateGray";
        break;
        case 3: // sporty
            $scope.DisplayMood = "Sporty";
            document.body.style.backgroundColor = "Gray";
        break;
        }

    }

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

  $scope.getProfile();
  $scope.getHeartRate();
  setInterval(function() {
      $scope.getProfile();
      $scope.getHeartRate();
  }, 1000);
}]);

