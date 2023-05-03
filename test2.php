<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
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

// 获取日期和放映厅参数
$date = $_GET["date"];
$hall = $_GET["hall"];

// 获取对应的座位信息
$sql = "SELECT * FROM seat WHERE seat_id LIKE '{$hall}%' AND status = 0";
$result = $conn->query($sql);

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

// 构建座位表格
echo "<form method='POST'>";
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
echo "<button type='submit' name='submit'>确定</button>";
echo "<button type='submit' name='cancel'>取消</button>";
echo "</form>";

$conn->close();
?>


    </body>
</html>
