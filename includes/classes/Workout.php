<?php
  class Workout {

    private $con;
    private $id;
    private $workoutName;
    private $user;
    private $playDate;
    private $playCount;

    public function __construct($con, $user) {
      $this->con = $con;
      $this->user = $user;

      $query = mysqli_query($this->con, "SELECT * FROM workouts WHERE user='$this->user'");
      $this->workoutData = mysqli_fetch_array($query);

      $this->workoutName = $this->workoutData['workoutName']; 
      $this->user = $this->workoutData['user']; 
      $this->playDate = $this->workoutData['playDate']; 
      $this->playCount = $this->workoutData['playCount']; 
    }

    public function getTitle() {
      return $this->workoutName;
    }

    public function getPlayCount($workoutName) {
        $query = mysqli_query($this->con, "SELECT playCount FROM workouts WHERE workoutName='$this->workoutName'");
        $this->workoutData = mysqli_fetch_array($query);
        return $this->workoutData['playCount'];
    }
    
  }


