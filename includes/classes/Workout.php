<?php
  class Workout {

    private $con;
    private $id;
    private $workoutName;
    private $user;
    private $playDate;
    private $playCount;

    public function __construct($con, $user, $workoutName) {
      $this->con = $con;
      $this->user = $user;
      $this->workoutName = $workoutName;

      $query = mysqli_query($this->con, "SELECT * FROM workouts WHERE user='$this->user' AND workoutName=''$this->workoutName'");
      $this->mysqliData = mysqli_fetch_array($query);
      $this->workoutName = $this->mysqliData['workoutName']; 
      $this->user = $this->mysqliData['user']; 
      $this->playDate = $this->mysqliData['playDate']; 
      $this->playCount = $this->mysqliData['playCount']; 
    }

    public function getPlayCount() {
        return $this->playCount;
    }
    
  }


