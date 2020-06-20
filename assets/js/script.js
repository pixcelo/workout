'use strict';

const timer = document.getElementById('timer');
const start = document.getElementById('start');
const stop = document.getElementById('stop');
const reset = document.getElementById('reset');
const count = document.getElementById('count');
const pushup = document.querySelector('.pushup');

// カウントダウンタイマー（3秒）
let totalTime = 3;
function countDown() {
    let timerLabel = `${totalTime}`;
    console.log(totalTime--);
    let timerId = setTimeout(countDown, 1000);

    if(totalTime == -1){
      timerLabel = 'START';
    }

    if(totalTime == -2) {
      count.classList.add('none');
      clearTimeout(timerId);
      totalTime = 3;
      runTimer();
      return;
    }

    count.classList.remove('none');  // 画面に表示する
    count.innerHTML = timerLabel;
}

// ワークアウトタイマー（30秒）
let workoutTime = 30;
function runTimer() {
    let countLabel = `${workoutTime}`;
    console.log(workoutTime--);
    let timeoutId = setTimeout(runTimer, 1000);

    if(workoutTime == -1){
        countLabel = 'FINISH';
    }

    if(workoutTime == -2) {
        clearTimeout(timeoutId);
        stopTimer();
        return;
    }
    
    timer.classList.remove('none');  // 画面に表示する
    pushup.classList.remove('none');
    timer.innerHTML = countLabel;
}

function stopTimer() {
    timer.classList.add('none');
    pushup.classList.add('none');
    workoutTime = 4;
}

// それぞれの状態を関数で整理
function setButtonStateInitial() {
  start.classList.remove('inactive');
  stop.classList.add('inactive');
  reset.classList.add('inactive');
}

function setButtonStateRunning() {
  start.classList.add('inactive');
  stop.classList.remove('inactive');
  reset.classList.remove('inactive');
}

function setButtonStateStopped() {
  start.classList.remove('inactive');
  stop.classList.add('inactive');
  reset.classList.remove('inactive');
}

setButtonStateInitial();

start.addEventListener('click', () => {
    if (start.classList.contains('inactive')) {
      return;
    }
    setButtonStateRunning();
    countDown();
});

stop.addEventListener('click', () => {
  if (stop.classList.contains('inactive')) {
    return;
  }
  setButtonStateStopped();
  clearTimeout(timeoutId);
});

reset.addEventListener('click', () => {
  if (reset.classList.contains('inactive')) {
    return;
  }
  setButtonStateInitial();
});
