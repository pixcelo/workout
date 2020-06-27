'use strict';

const timer = document.getElementById('timer');
const start = document.getElementById('start');
const count = document.getElementById('count');
const pushup = document.querySelector('.pushup');
const squat = document.querySelector('.squat');
let checkedType;

function checkType() {
    // elements にはボタンの要素も含まれてしまうため -1 (下記参照)
    // HTMLFormControlsCollection(4) [input, input, input, input, type: RadioNodeList(4)]
    for (let i = 0; i < document.typeForm.elements.length - 1; i++) {
      if (document.typeForm.elements[i].checked) {
        // console.log(document.typeForm.elements[i].value);
        checkedType = document.typeForm.elements[i].value;
      }
    }
};


// カウントダウンタイマー（3秒）
let totalTime = 3;

function countDown() {
    let timerLabel = `${totalTime}`;
    // console.log('totalTime', totalTime--);
    totalTime--;
    let timerId = setTimeout(countDown, 1000);

    if(totalTime == -1){
      timerLabel = 'START';
    }

    if(totalTime == -2) {
      count.classList.add('none');
      clearTimeout(timerId);
      totalTime = 3; // 初期化
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
    // console.log('workoutTim', workoutTime--);
    workoutTime--;
    let timeoutId = setTimeout(runTimer, 1000);

    if(workoutTime == -1){
        countLabel = 'FINISH';
    }

    if(workoutTime == -2) {
        clearTimeout(timeoutId);
        timer.classList.add('none');

        if(checkedType == 'pushup') {
            pushup.classList.add('none');
        } else {
            squat.classList.add('none');
        }

        workoutTime = 30; // 初期化
        start.classList.remove('inactive');
        return;
    }

    timer.classList.remove('none');  // 画面に表示する

    if(checkedType == 'pushup') {
        pushup.classList.remove('none');
    } else {
        squat.classList.remove('none');
    }

    timer.innerHTML = countLabel;

}

start.addEventListener('click', () => {
    if(start.classList.contains('inactive')) {
      return;
    }
    start.classList.add('inactive');
    countDown();
    checkType();
});

// ログアウト処理
document.querySelector('.logout').addEventListener('click', () => {
    fetch('includes/handlers/ajax/logout.php', function() {
        location.reload(); // reload logout.php (SESSION_destroy)
    });
});