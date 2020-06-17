<?php
//这个文件是老师写的
include 'spl_autoload.php';

echo '';
//创建DBDriver对象，连接数据库
$db = new DBDriver();
$sql = 'select * from users';
// $db->query($sql);


//返回一条记录，不是多条
$r = $db->get_results_records($sql);         

var_dump($r);
echo '<hr/>';






// echo '名字是：',$r['name'],'<br/>';
// echo '密码是：',$r['password'];
// $name = "李小龙";
// $sql = 'delete from users where name = "'. $name .'"';
// $db->exec($sql);

// $name = $_POST['name'];     //$name是"业成"
$sql = 'insert into users (name,password,intro) 
values("业成","lixiaolong","lixiaolong")';
$db->exec($sql);
$id = $db->lastInsertId();
echo 'id是：' . $id ,'<br/>';
$sql = 'select * from users where id = ' . $id;
$r = $db->get_results_records($sql);
// var_dump($r);
echo '欢迎您：' . $r['name'];


