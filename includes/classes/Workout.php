<?php
  class Workout {

    private $con;
    private $id;
    private $workoutName;
    private $user;
    private $playDate;
    private $playCount;
    private $name;

    public function __construct($con, $user) {
      $this->con = $con;
      $this->user = $user;

      $query = mysqli_query($this->con, "SELECT * FROM workouts WHERE user='$this->user'");
      $this->workoutData = mysqli_fetch_array($query);

      $this->id = $this->workoutData['id']; 
      // $this->workoutName = $this->workoutData['workoutName']; 
      $this->user = $this->workoutData['user']; 
      $this->playDate = $this->workoutData['playDate']; 
      $this->playCount = $this->workoutData['playCount']; 
    }

    public function getTitle() {
      return $this->workoutName;
    }

    public function getPlayCount($user, $workoutName) {
        $this->workoutName = $workoutName;

        $query = mysqli_query($this->con, "SELECT * FROM workouts WHERE user='$this->user' AND workoutName='$this->workoutName'");
        $this->workoutData = mysqli_fetch_array($query);

        return '<li class="number">' . $this->workoutData['workoutName'] . ' : ' .  $this->workoutData['playCount'] . 'times</li>';
    }

    public function getTotalCount($user) {

      $query = mysqli_query($this->con, "SELECT SUM(playCount) as total FROM workouts WHERE user='$this->user'");
      $this->workoutData = mysqli_fetch_array($query);

      return '<li class="number">Total : ' .  $this->workoutData['total'] . 'times</li>';
  }
    
  }

