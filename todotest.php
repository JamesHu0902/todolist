<?php 
include "msql.inc.php";
date_default_timezone_set("Asia/Shanghai");
$updatatime = date('Y')."/".date('m')."/".date('d')."-".date("h:i:s");
// 如果送出表單中有資料
if(!empty($_POST['todo'])){
    // 將代辦事項新增至 todolist 資料表
    $sql = "insert 代辦事項(代辦事項,進度,開始時間)
            values('{$_POST['todo']}','0','$updatatime')
            ";
    if(!mysqli_query($conn,$sql)) echo"送出失敗";
    
}
;?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>代辦事項</title>
    </head>
    <body>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
            代辦事項 : <input name="todo">
            <input type="submit" value="送出">
        </form>
        <!-- 顯示資料 -->
        <?php 
            // 使用代辦事項名稱排序，查詢"代辦事項"資料表中所有資料
            $sql = "select * from 代辦事項 order by 開始時間 DESC ";
            $result = mysqli_query($conn,$sql);

            // 如果查詢紀錄大於 0 筆，使用迴圈顯示所有資料
            if(mysqli_num_rows($result) > 0){
                echo "<hr/>
                        <table border='1'>
                        <tr>
                        <th>代辦事項</th><th>開始時間</th>
                        </tr>";
                while($row = mysqli_fetch_array($result)){
                    echo "<tr><td>{$row['代辦事項']}</td>
                            <td>{$row['開始時間']}</td>
                            <td><a href='delete.php?del={$row['開始時間']}'>刪除</a></td>
                            <td><a href='edit.php?edit={$row['開始時間']}'>更名</a></td>
                            </tr>";
                }
                echo "</table>";
            };
        ?>
    </body>
</html>
