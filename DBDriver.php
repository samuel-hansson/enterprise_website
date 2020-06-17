<?php
//该类代表数据库，负责对数据库进行操作
//这个文件是业成写的
class DBDriver{

    public $connetion;          //该属性代表数据库连接属性
    public $statement;          //该属性代表数据库查询（语句）

    public function __construct(){
        $drivers = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        try{
            //连接数据库
            $this->connetion = new PDO('mysql:host=localhost;port=3306;dbname=web_two_db','root','root',$drivers);
        }catch(PDOException $e){
            echo '数据库连接出错，错误原因是：' . $e->getMessage(),'<br/>';
            exit;
        }
        echo '连接成功','<hr/>';
    }

    //该方法查询数据库，让数据库执行查询语句
    public function query($sql){
        try{
            $this->statement = $this->connetion->query($sql);
        }catch(PDOException $p){
            echo '错误代号是：',$this->connetion->errorCode(),'<br/>';
            echo '错误原因是：',$this->connetion->errorInfo()[2],'<br/>';
            exit;
        }
        // if($this->statement == false){
        //     echo '错误代号是：',$this->connetion->errorCode(),'<br/>';
        //     echo '错误原因是：',$this->connetion->errorInfo()[2],'<br/>';
        //     exit;
        // }

    } 

    //第二个办法：创建一个方法，但是根据标记的不同，返回不同的记录数。
    public function get_results_records($sql,$only=true,$fetch_style = PDO::FETCH_ASSOC){
        $this->query($sql);
        if($only == true){
            return $this->statement->fetch($fetch_style);        //返回一条记录
        }else{  
            return $this->statement->fetchAll($fetch_style);         //返回多条记录
        }
    }

    //对数据库做增、删、改操作
    public function exec($sql){
        //以下代码是在PDO错误处理方式是异常处理方式状况下采用的错误处理方法
        try{
            $n = $this->connetion->exec($sql);
        }catch(PDOException $p){
            echo '错误代号是：',$this->connetion->errorCode(),'<br/>';
            echo '错误原因是：',$this->connetion->errorInfo()[2],'<br/>';
            exit;
        }
        echo '操作成功！','<br/>';
        echo '受影响的行数是：' . $n . '行。','<br/>';
        
        //以下代码是在PDO错误处理方式是静默方式状况下采用的错误处理方法
        //全等符，判断等号两边的表达式（数值）数据类型和数值是否全部相同
        // if($n === false){                   
        //     echo '错误代号是：',$this->connetion->errorCode(),'<br/>';
        //     echo '错误原因是：',$this->connetion->errorInfo()[2],'<br/>';
        //     exit;
        // }else{
        //     echo '操作成功！','<br/>';
        //     echo '受影响的行数是：' . $n . '行。','<br/>';
        // }
    }

    //获的最后插入的一条记录的ID
    public function lastInsertId(){
        $id = $this->connetion->lastInsertId();
        return $id;        
    }
        //第一个办法：根据要获取的数目不同，创建两个方法
    //从数据库查询结果获取数据，从PDOStatement中获取一条记录
    // public function get_results(){
    //     $statement->fetch();
    // }

    //从PDOStatement中获取多条记录
    // public function get_results_many(){
    //     $statement->fetchAll();
    // }


}


