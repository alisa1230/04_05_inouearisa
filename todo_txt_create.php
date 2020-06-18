<?php
// var_dump($_POST);
// exit();

// データの受取
$weight = $_POST["weight"];
$fat = $_POST["fat"];
$deadline = $_POST["deadline"];
$write_data = "{$deadline} {$fat} {$weight}\n";
$file = fopen('data/weightMemo.csv', 'a');
flock($file, LOCK_EX);
fwrite($file, $write_data);
flock($file, LOCK_UN);
fclose($file);
header("Location:todo_txt_input.php");


// 書き込みデータの作成（スペース区切りで最後に改行コードを追加）


// ファイルを開く処理

// ファイルロックの処理

// ファイル書き込み処理

// ファイルアンロックの処理

// ファイルを閉じる処理

// 入力画面へ移動


// txtファイルへの書き込みのみ行うので表示する画面は存在しない
