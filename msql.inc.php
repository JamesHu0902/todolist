<?Php
// 資料庫設定
$dbServer = "127.0.0.1";
$dbUser = "root";
$dbPqss = '';
// $dbPqss = "CINPHOWN";
$dbName = "todolist";

// 連線資料庫
$conn = @mysqli_connect($dbServer,$dbUser,$dbPqss,$dbName);

if(mysqli_connect_errno($conn)) die("無法連線資料庫伺服器");

// 設定連線字元集為 UTF8 編碼
mysqli_set_charset($conn,"utf8");
?>