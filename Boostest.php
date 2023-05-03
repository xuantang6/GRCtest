<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body>
<!DOCTYPE html>
<html>
<head>
	<title>电影院座位选择</title>
</head>
<?php
// 连接数据库
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "grc";
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 处理座位选择和取消请求
if (isset($_POST["submit"])) {
    $seats = $_POST["seats"];
    if (is_array($seats)) {
        foreach ($seats as $seat_id) {
            $sql = "UPDATE seat SET status = 'UNAVAILABLE' WHERE seat_id = '{$seat_id}'";
            $conn->query($sql);
        }
    }
    header("Location: {$_SERVER['REQUEST_URI']}");
    exit();
} elseif (isset($_POST["cancel"])) {
    $seats = $_POST["seats"];
    if (is_array($seats)) {
        foreach ($seats as $seat_id) {
            $sql = "UPDATE seat SET status = 'AVAILABLE' WHERE seat_id = '{$seat_id}'";
            $conn->query($sql);
        }
    }
    header("Location: {$_SERVER['REQUEST_URI']}");
    exit();
}

// 获取日期和放映厅参数
$date = $_GET["date"];
$hall = $_GET["hall"];

// 获取对应的座位信息
$sql = "SELECT * FROM seat WHERE seat_id LIKE '{$hall}%' AND status = 'AVAILABLE'";
$result = $conn->query($sql);

// 构建座位表格
echo "<form method='post'>";
echo "<table>";
echo "<tr><th></th>";
for ($i = 1; $i <= 18; $i++) {
    echo "<th>{$i}</th>";
}
echo "</tr>";
for ($j = 0; $j < 12; $j++) {
    $row = chr(ord('A') + $j);
    echo "<tr><th>{$row}</th>";
    for ($i = 1; $i <= 18; $i++) {
        $seat_id = "{$hall}{$row}" . sprintf("%02d", $i);
        $status = 'AVAILABLE';
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row["seat_id"] == $seat_id) {
                    $status = $row["status"];
                    break;
                }
            }
            $result->data_seek(0);
        }
        $checkbox = "<input type='checkbox' name='seats[]' value='{$seat_id}'";
        if ($status == 'UNAVAILABLE') {
            $checkbox .= " disabled='disabled'";
        }
        $checkbox .= ">";
        echo "<td>{$checkbox}</td>";
    }
    echo "</tr>";
}
echo "</table>";
echo "<input type='submit' name='submit' value='确定'>";
echo "<input type='submit' name='cancel' value='取消'>";
echo "</form>";

// 关闭数据库连接
$conn->close();
?>


</body>
</html>