'use strict';

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
    }

    // 画面に表示する
    document.getElementById('timer').innerHTML = label;
}, 1000);