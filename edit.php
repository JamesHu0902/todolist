<?Php
include 'msql.inc.php';

// edit 傳來不是空參數
if(!empty($_GET['edit'])){
    // 依照時間編號找出該筆資料
    $sql = "select * from 代辦事項 where 開始時間 = '{$_GET['edit']}'";
    $result = mysqli_query($conn,$sql);
    // 將資料放入陣列
    $arr = mysqli_fetch_array($result);
}else{
    // 沒有參數退回主頁
    header("Location: todotest.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <!-- 準備一個表單 將編輯好的資料送去處理 -->
    <form action="rename.php" method="post">
        代辦事項 : <?PHP echo $arr['代辦事項'];?>
        更改為 : <input type="text" name='rename' value="<?Php echo $arr['代辦事項']?>">
        <input type="hidden" name='id' value = "<?Php echo $arr['開始時間']?>">
        <input type="submit" value="修改">
    </form>

    <p><a href="todotest.php">回代辦事項</a></p>
</body>
</html>