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
      timer.classList.add('none');
      clearTimeout(timeoutId);
      workoutTime = 4;
      return;
    }

    timer.classList.remove('none');  // 画面に表示する
    pushup.classList.remove('none');
    timer.innerHTML = countLabel;
}


start.addEventListener('click', () => {
    countDown();
});