'use strict';

const timer = document.getElementById('timer');
const start = document.getElementById('start');
const stop = document.getElementById('stop');
const reset = document.getElementById('reset');
const count = document.getElementById('count');

// カウントダウンタイマー（3秒）
let totalTime = 4;
function countDown() {
    console.log(totalTime--);
    let label = `${totalTime}`;
    let timerId = setTimeout(countDown, 1000);

    if(totalTime == 0){
      label = 'START';
    }

    if(totalTime == -1) {
      count.classList.add('none');
      clearTimeout(timerId);
      totalTime = 4;
      return;
    }

    count.classList.remove('none');  // 画面に表示する
    count.innerHTML = label;
}

// ワークアウトタイマー（30秒）
let workoutTime = 31;
function runTimer() {
    console.log(workoutTime--);
    let label2 = `${workoutTime}`;
    let timeoutId = setTimeout(runTimer, 1000);

    if(workoutTime == 0){
      label2 = 'FINISH';
    }

    if(workoutTime == -1) {
      timer.classList.add('none');
      clearTimeout(timeoutId);
      workoutTime = 4;
      return;
    }

    timer.classList.remove('none');  // 画面に表示する
    timer.innerHTML = label2;
}




start.addEventListener('click', () => {
    countDown();
    runTimer();
});
