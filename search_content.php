<?php
include"config.php";
?>
<!DOCTYPE html>
<html> 
<head>
<?php
if(isset($_POST['upload'])){
	$serch = $_POST['serch'];
	header("Location: search_content.php?ans=".$serch);
}
?>
<meta charset="utf-8" />
<title>Cinema</title>
 <script src="widget.js"></script>
	  <script>
        var botmanWidget = {
            frameEndpoint: 'chat.html',
            introMessage: '您好，這邊推薦您各類分數最高的作品<br>1.動作類<br>2.冒險類<br>3.喜劇類<br>4.音樂類<br>5.恐怖類<br>6.奇幻類<br>7.愛情類<br>8.動畫類<br>9.戰爭類<br>10.歷史類<br><br>請輸入數字代碼(1~10)以查詢作品名稱',
            chatServer : 'botman.php', 
            title: '客服中心'
        }; 
    </script>
<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #6A5ACD;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 16px;
  text-decoration: none;
}

li a:hover {
  background-color: #87CEEB;
}
.link:hover{
	color: #FFD700;
}
.link:visited{
	color: #FF4500;
}
</style>
</head>
<body style="background-color:#191970;">
<?php
session_start();
if(isset($_SESSION['login'])&&$_SESSION['login']==true){
	echo "<p style='float: right;color:#FFD700'><a class=\"link\" href='add.php'>新增</a> \ <a class=\"link\" href='delete.php'>刪除</a> \ <a class=\"link\" href='edit.php'>編輯</a> \ <a class=\"link\" href='logout.php'>登出</a>";
}
else echo "<p style='float: right;color:white;'><a class=\"link\" href='login.php'>登入會員</a>\<a class=\"link\" href='register.php'>註冊</a>";
?>
<form style="float:left" method="post" action="" enctype='multipart/form-data'>
<input type="text"  name="serch" value="">
<input type='submit' value='搜尋' name='upload'>
</form>
<center><h1 style="color:#F5FFFA;">Cinema</h1><center>
<ul>
  <li><a href="index.php">首頁</a></li>
  <li><a href="content.php?type=<?=$type=1?>">動作類</a></li>
  <li><a href="content.php?type=<?=$type=2?>">冒險類</a></li>
  <li><a href="content.php?type=<?=$type=3?>">喜劇類</a></li>
  <li><a href="content.php?type=<?=$type=4?>">音樂類</a></li>
  <li><a href="content.php?type=<?=$type=5?>">恐怖類</a></li>
  <li><a href="content.php?type=<?=$type=6?>">奇幻類</a></li>
  <li><a href="content.php?type=<?=$type=7?>">愛情類</a></li>
  <li><a href="content.php?type=<?=$type=8?>">動畫類</a></li>
  <li><a href="content.php?type=<?=$type=9?>">戰爭類</a></li>
  <li><a href="content.php?type=<?=$type=10?>">歷史類</a></li>
</ul>
<br>
<?php
$ans = $_GET["ans"];
$images_sql = "SELECT * from movie WHERE name LIKE '%".$ans."%'";
$amount_sql = "SELECT COUNT(*) from movie WHERE name LIKE '%".$ans."%'";
mysqli_query($con, 'SET NAMES utf8'); 
$result = mysqli_query($con,$images_sql);

$r2 = mysqli_query($con,$amount_sql);
$tmp = mysqli_fetch_array($r2, MYSQLI_NUM);
$total = $tmp[0];
$i=0;
	while($row= mysqli_fetch_array($result,MYSQLI_ASSOC)) {
		$movie_name[$i]=$row['name'];
		$movie_pic[$i]="<a href=\"introduce.php?title=".$row['name']."\"><img src=\"".$row['image']."\""."width='250px' height='300px'></a>";
		$i++;
	}
$j=0;
$k=0;
echo "<table border=1>";
while($j<$total){
echo "<tr>";
while($j<=$total){
	if($j==$total)
		break;
	else if($j!=0&&$j%4==0){
		echo "<td>".$movie_pic[$j]."</td>";
		echo "</tr>";
		$j++;
		break;
	}
	echo "<td>".$movie_pic[$j]."</td>";
	$j++;
}
echo "<tr>";
while($k<=$total){
	if($k==$total)
		break;
	if($k!=0&&$k%4==0){
		echo "<td style=\"color:#FFFF00\"><center>".$movie_name[$k]."</center></td>";
		echo "</tr>";
		$k++;
		break;
	}
	echo "<td style=\"color:#FFFF00\"><center>".$movie_name[$k]."</center></td>";
	$k++;
}
}
echo "</table>";

mysqli_free_result($result); // 釋放佔用記憶體 
mysqli_close($con);  // 關閉資料庫連接
?>
</body>
</html>