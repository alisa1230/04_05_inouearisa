<?php
// ファイル読み込み操作の流れ
$str = ''; // 出力用の空の文字列
$file = fopen('data/weightMemo.csv', 'r'); // ファイルを開く(読み取り専用) 
flock($file, LOCK_EX); // ファイルをロック
// if ($file) {
//   while ($line = fgetcsv($file)) {  // fgets()で1行ずつ取得→$lineに格納
//     $str .= "<tr><td>{$line}</td></tr>"; // 取得したデータを$strに入れる
//   }
// }

// 各行を配列に直す.
while (($data = fgetcsv($file, 0, ",")) !== FALSE) {
  $csv[] =  $data;
}
// var_dump($csv);
// exit();
flock($file, LOCK_UN); // ロック解除 fclose($file); // ファイル閉じる // ($strに全部の情報が入る!

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
  <title>体重一覧画面</title>
</head>

<body>
  <fieldset>
    <legend>体重一覧画面</legend>
    <a href="todo_txt_input.php">入力画面</a>
    <h1>グラフ</h1>
    <canvas id="myChart"></canvas>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
    <script>
      var ctx = document.getElementById("myChart");
      var myMixedChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ['6月1日', '6月2日', '6月3日', '6月4日', '6月5日', '6月6日', '6月7日'],
          datasets: [{
            //棒グラフ
            label: "体重",
            data: [90, 85, 84, 85, 80, 80, 75],
            backgroundColor: "rgba(0,0,128,0.5)",
            yAxisID: 'left-y-axis'
          }, {
            //折れ線グラフ
            label: "体脂肪",
            type: 'line',
            data: [30, 32, 30, 30, 28, 30, 29],
            borderColor: "rgba(255,255,0,1)",
            backgroundColor: "rgba(0,0,0,0)",
            yAxisID: 'right-y-axis'
          }]
        },
        options: {
          title: {
            display: true,
            text: '日付・体重 体脂肪'
          },
          scales: {
            yAxes: [{
              id: 'left-y-axis',
              position: 'left',
              ticks: {
                suggestedMax: 100,
                suggestedMin: 40,
                stepSize: 5,
                callback: function(value, index, values) {
                  return value + 'kg'
                }
              }
            }, {
              id: 'right-y-axis',
              position: 'right',
              ticks: {
                suggestedMax: 40,
                suggestedMin: 10,
                stepSize: 1,
                callback: function(value, index, values) {
                  return value + '％'
                }
              },
              // グリッドラインを消す
              gridLines: {
                drawOnChartArea: false,
              },
            }]
          }
        }
      });
    </script>
  </fieldset>
</body>

</html>