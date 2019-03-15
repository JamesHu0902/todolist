<?Php
header('Content-Type: text/html; charset=utf-8');
include 'msql.inc.php';

// 傳來 DEL 參數的操作
if($_GET['del'] !=''){
    $sql = "delete from 代辦事項 where 開始時間 = '{$_GET['del']}'";
    mysqli_query($conn,$sql);

    // 取得刪除筆數
    $rowDelete = mysqli_affected_rows($conn);
    // 如果刪除的筆數>0，顯示成功
    if($rowDelete>0) echo "刪除成功";
    else echo "刪除失敗";
}
?>

<p><a href="todotest.php">回代辦事項</a></p>