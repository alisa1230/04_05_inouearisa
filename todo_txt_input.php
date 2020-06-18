<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>体重管理画面</title>
</head>

<body>

  <form action="todo_txt_create.php" method="POST">
    <fieldset>
      <legend>textファイル書き込み型todoリスト（入力画面）</legend>
      <a href="todo_txt_read.php">一覧画面</a>
      <div>
        体重: <input type="text" name="weight">
        体脂肪: <input type="text" name="fat">
        deadline: <input type="date" name="deadline">
      </div>

      <!-- カメラの表示 -->
      <video id="camera" width="300" height="400"></video>
      <canvas id="picture" width="300" height="400"></canvas>
      <audio id="se" preload="auto">
        <source src="Camera-Phone03-5.mp3" type="audio/mp3">
      </audio>
      <!-- 音声入力 ボタン-->
      <div>
        <h2>カメラ体型を記録しよう！<br>写真ボタンを押すと５秒後に撮れるよ</h2>
        <button id="start_btn">すたーと</button>
      </div>
      <button>submit</button>
      </div>
    </fieldset>
  </form>
  <script>
    /** カメラ設定 */
    const video = document.getElementById('camera');
    const canvas = document.getElementById('picture')
    const se = document.getElementById('se');
    window.onload = () => {
      const constraints = {
        audio: false,
        video: {
          width: 300,
          height: 400,
        }
      };
      /**
       * カメラを<video>と同期
       */
      navigator.mediaDevices.getUserMedia(constraints)
        .then((stream) => {
          video.srcObject = stream;
          video.onloadedmetadata = (e) => {
            video.play();
          };
        });


      start_btn.addEventListener('click', function() {
        const ctx = canvas.getContext("2d");

        se.play();
        ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

      });


    };
  </script>
</body>

</html>