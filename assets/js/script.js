'use strict';

const timer = document.getElementById('timer');
const start = document.getElementById('start');
const count = document.getElementById('count');
const pushup = document.querySelector('.pushup');

// カウントダウンタイマー（3秒）
let totalTime = 3;
function countDown() {
    let timerLabel = `${totalTime}`;
    console.log('totalTime', totalTime--);
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
    console.log('workoutTim', workoutTime--);
    let timeoutId = setTimeout(runTimer, 1000);

    if(workoutTime == -1){
        countLabel = 'FINISH';
    }

    if(workoutTime == -2) {
        clearTimeout(timeoutId);
        timer.classList.add('none');
        pushup.classList.add('none');
        workoutTime = 30;
        setButtonStateInitial();
        return;
    }

    timer.classList.remove('none');  // 画面に表示する
    pushup.classList.remove('none');
    timer.innerHTML = countLabel;

}

// 状態を関数で整理
function setButtonStateInitial() {
    start.classList.remove('inactive');
}

function setButtonStateRunning() {
    start.classList.add('inactive');
}

start.addEventListener('click', () => {
    if (start.classList.contains('inactive')) {
      return;
    }
    setButtonStateRunning();
    countDown();
});

// ログアウト処理
function logout() {
    $.post("includes/handlers/ajax/logout.php", function() {
        location.reload();
    });
}

document.querySelector('.logout').addEventListener('click', () => {
    logout();
});