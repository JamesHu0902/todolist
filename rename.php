<?Php
header('Content-Type: text/html; charset=utf-8');
include 'msql.inc.php';

// 傳來 的 id rename 參數的操作
if(!empty($_POST['id']) && !empty($_POST['rename'])){
    $sql = "update 代辦事項 
            set 代辦事項 = '{$_POST['rename']}'
            where 開始時間 = '{$_POST['id']}'";
    mysqli_query($conn,$sql);

    // 取得刪除筆數
    $rowUpdate = mysqli_affected_rows($conn);
    // 如果刪除的筆數>0，顯示成功
    if($rowUpdate>0) echo "更新成功";
    else echo "更新失敗，或輸入相同名稱";
}
?>

<p><a href="todotest.php">回代辦事項</a></p>