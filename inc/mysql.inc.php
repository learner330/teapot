<?php
//数据库连接
function connect($host=DB_HOST,$user=DB_USER,$password=DB_PASSWORD,$database=DB_DATABASE,$port=DB_PORT){
    $link=@mysqli_connect($host,$user,$password,$database,$port);
    mysqli_connect_errno();
    mysqli_set_charset($link,'utf8');
    return $link;
}
//执行一条SQL语句，返回结果集对象或者返回布尔值
function execute($link,$query){
    $result= mysqli_query($link,$query);
    if(mysqli_errno($link)){
        exit(mysqli_error($link));
    }
    return $result;

}


//执行一条SQL语句，只返回布尔值
function execute_bool($link,$query){
   $bool= mysqli_real_query($link,$query);
   if(mysqli_errno($link)){
       exit(mysqli_error($link));
   }
   return $bool;
}


//一次性执行多条SQL语句
/*
 * $link：链接
 * $arr_sqls：数组形式的多条sql语句
 * $error：传入一个变量，里面会储存语句执行的错误信息
 */
function execute_multi(&$link,$arr_sqls,&$error){
    $sqls=implode(';',$arr_sqls).';';
    if(mysqli_multi_query($link,$sqls)){
        $data=array();
        $i=0;//计数
        do{
            if($result=mysqli_store_result($link)){
                $data[$i]=mysqli_fetch_all($result);
                mysqli_free_result($result);
            }
            else{
                $data[$i]=null;
            }
            $i++;
            if(!mysqli_more_results($link)) break;

        }while(mysqli_next_result($link));
        if($i==count($arr_sqls)){
            return $data;
        }else{
            $error='sql语句执行失败：<br />&nbsp;数组下标为{$i}的语句：{$arr_sqls[$i]}执行错误<br /> &nbsp;错误原因：'.mysqli_error($link);
            return false;
        }

    }else {
        $error = '执行失败! 请检查首条语句是否正确！<br />可能的错误原因：' . mysqli_error($link);
        return false;
    }
}


//获取记录数
function num($link,$sql_count){
    $result=execute($link,$sql_count);
    $count=mysqli_fetch_row($result);
    echo $count[0];

}


//数据入库之前进行转义，确保数据顺利入库
function escape($link,$data){
    if(is_string($data)){
        return mysqli_real_escape_string($link,$data);
    }
    if(is_array($data)){
        foreach($data as $key=>$val){
            $data[$key]=escape($link,$val);
        }
    }

        return $data;

}


//与数据库断开连接
function close($link){
    mysqli_close($link);
}



?>
