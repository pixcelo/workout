'use strict';

// カウントダウンタイマー
const totalTime = 4000;
const oldTime = Date.now();

const timerId = setInterval(() => {
    const currentTime = Date.now();
    const diff = currentTime - oldTime;

    // 残り時間（ミリ秒）
    const remainMSec = totalTime - diff;

    // ミリ秒を秒に変換
    const remainSec = Math.ceil(remainMSec / 1000);

    let label = `${remainSec}`;

    // 0秒以下になったらタイマー終了
    if (remainSec <= 0) {
      clearInterval(timerId);
      label = 'START';
      // console.log("start");
    }

    // 画面に表示する
    document.getElementById('count').innerHTML = label;
}, 1000);

// トレーニングタイマー
const timer = document.getElementById('timer');
const start = document.getElementById('start');
const stop = document.getElementById('stop');
const reset = document.getElementById('reset');

let startTime;
let timeoutId;
let elapsedTime = 0;

// カウントアップの定義
function countUp() {
  // 秒の単位表示を修正
  const d = new Date(Date.now() - startTime + elapsedTime);
  const m = String(d.getMinutes()).padStart(2, '0');
  const s = String(d.getSeconds()).padStart(2, '0');
  timer.textContent = `${m}:${s}`;

  // countUp() の処理を一定時間ごとに繰り返す
  timeoutId = setTimeout(() => {
    countUp();
  }, 10);
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
    if (start.classList.contains('inactive') === true) {
      return;
    }
    setButtonStateRunning();
    startTime = Date.now();
    countUp();
});

stop.addEventListener('click', () => {
    if (stop.classList.contains('inactive') === true) {
      return;
    }
    setButtonStateStopped();
    clearTimeout(timeoutId);
    elapsedTime += Date.now() - startTime;
});

reset.addEventListener('click', () => {
  if (reset.classList.contains('inactive') === true) {
    return;
  }
  setButtonStateInitial();
  timer.textContent = '00:00.000';
  elapsedTime = 0;
});