<?php

class DB {    
            
private $MYSQL_SERVER ='localhost';
private $MYSQL_USER= 'root';
private $MYSQL_PASSWORD='';
private $MYSQL_DB='eng';
    
    
    
    
    
    public function get_db_data_id($table = null, $id=1) {
      
    $mysqli = new mysqli($this -> MYSQL_SERVER, $this -> MYSQL_USER, $this -> MYSQL_PASSWORD, $this -> MYSQL_DB );

/* проверка соединения */
if ($mysqli->connect_errno) {
    printf("Не удалось подключиться: %s\n", $mysqli->connect_error);
    exit();
}
       $column ='id';
    if($table =='kat') $column='id_kat';
    if($table =='item') $column='id_item';
    if($table =='card_operation') $column='id_operation';
              
  
    $query = "SELECT date,sum,coment,kat,item FROM $table WHERE $column =$id";     
        
if ($result = $mysqli->query($query)) {     
    while ($row = $result->fetch_row()) {
        $data['date']=$row[0];  
        $data['sum']=$row[1];
        $data['coment']=$row[2];
        $data['kat']=$row[3];
        $data['item']=$row[4];
      
    }  
     
       $result->close();
}
$mysqli->close();            
    
 
        
        return $data;        
    }
    
    
     public function get_db_data_id_card_zp($table = null, $id=1) {
      
    $mysqli = new mysqli($this -> MYSQL_SERVER, $this -> MYSQL_USER, $this -> MYSQL_PASSWORD, $this -> MYSQL_DB );

/* проверка соединения */
if ($mysqli->connect_errno) {
    printf("Не удалось подключиться: %s\n", $mysqli->connect_error);
    exit();
}
       $column ='id';
    if($table =='kat') $column='id_kat';
    if($table =='item') $column='id_item';
    if($table =='card_operation') $column='id_operation';
   
    $query = "SELECT date,operation,coment,zp_nach,zp_sn,correction FROM $table WHERE $column =$id";     
        
if ($result = $mysqli->query($query)) {     
    while ($row = $result->fetch_row()) {
        $data['date']=$row[0];  
        $data['operation']=$row[1];
        $data['coment']=$row[2];
        $data['zp_nach']=$row[3];
        $data['zp_sn']=$row[4];
        $data['correction']=$row[5];
      
    }  
    $data['sum'] = $data['correction'] + $data['zp_sn'] + $data['zp_nach'];
       $result->close();
}
$mysqli->close();      
            
        return $data;        
    }
    
     public function get_db_data_id_kat($table = null, $id=1) {
      
    $mysqli = new mysqli($this -> MYSQL_SERVER, $this -> MYSQL_USER, $this -> MYSQL_PASSWORD, $this -> MYSQL_DB );

/* проверка соединения */
if ($mysqli->connect_errno) {
    printf("Не удалось подключиться: %s\n", $mysqli->connect_error);
    exit();
}
       $column ='id';
    if($table =='kat') $column='id_kat';
    if($table =='item') $column='id_item';
    if($table =='card_operation') $column='id_operation';
    if($table =='balance') $column='id_balance';
   
    $query = "SELECT $table FROM $table WHERE $column =$id";     
        
if ($result = $mysqli->query($query)) {     
    while ($row = $result->fetch_row()) {
        $data[$table]=$row[0]; 
         if($table =='balance') $data = $row[0];
    }  
       $result->close();
}
$mysqli->close();      
            
        return $data;        
    }
    
    public function get_db_data_id_code($table = null, $id=1) {
      
    $mysqli = new mysqli($this -> MYSQL_SERVER, $this -> MYSQL_USER, $this -> MYSQL_PASSWORD, $this -> MYSQL_DB );

/* проверка соединения */
if ($mysqli->connect_errno) {
    printf("Не удалось подключиться: %s\n", $mysqli->connect_error);
    exit();
}
       $column ='id';
    if($table =='kat') $column='id_kat';
    if($table =='item') $column='id_item';
    if($table =='card_operation') $column='id_operation';
   
    $query = "SELECT operation,code_operation FROM $table WHERE $column =$id";     
        
if ($result = $mysqli->query($query)) {     
    while ($row = $result->fetch_row()) {
        $data['operation']=$row[0];        
        $data['code_operation']=$row[1];        
    }  
       $result->close();
}
$mysqli->close();      
            
        return $data;        
    }
    
    
    public function get_db_data($table = null, $sort = 'id',$columns ='*') {
      
    $mysqli = new mysqli($this -> MYSQL_SERVER, $this -> MYSQL_USER, $this -> MYSQL_PASSWORD, $this -> MYSQL_DB );

/* проверка соединения */
if ($mysqli->connect_errno) {
    printf("Не удалось подключиться: %s\n", $mysqli->connect_error);
    exit();
}
        $date_column ='No';
        $count_title= substr_count($table,'title');
        $arr_col=explode(',',$columns);
        $length_arr_col = count($arr_col);
        
        for($i = 0; $i < $length_arr_col; $i++){            
            if($arr_col[$i] == 'date') {
                $position= $i;
                 $date_column ='Yes';
                break;
            }
        }
        
$query = "SELECT $columns FROM $table ORDER BY $sort DESC lIMIT 20";
if ($result = $mysqli->query($query)) {     
       while ($row = $result->fetch_row()) {
           for ($i = 0; $i < count($row); $i++) {               
               $arr[]=$row[$i];               
           }     
    }    
    /* очищаем результирующий набор */
    $result->close();
}

$mysqli->close();              
   if ($date_column == 'Yes' & $count_title <= 0) { 
       
        while($position < count($arr) ){            
            $date = date_create($arr[$position]);
            $arr[$position] =date_format($date, 'd.m.Y'); 
            $position +=$length_arr_col;
                
        }
   }
        return $arr;        
    }
    
        
public function set_db_data($table,$date,$kat,$item,$sum,$coment) {
        
$mysqli = new mysqli($this -> MYSQL_SERVER, $this -> MYSQL_USER, $this -> MYSQL_PASSWORD, $this -> MYSQL_DB );

/* проверка соединения */
if ($mysqli->connect_errno) {
    printf("Не удалось подключиться: %s\n", $mysqli->connect_error);
    exit();
}
        
        $date= $mysqli->real_escape_string($date);
        $kat = $mysqli->real_escape_string($kat);
        $item= $mysqli->real_escape_string($item);
        $sum= $mysqli->real_escape_string($sum);
        $coment= $mysqli->real_escape_string($coment);

if ($mysqli->query("INSERT into $table (date,kat,item,sum,coment) VALUES ('$date','$kat','$item','$sum','$coment')")) {
    $data = "Cтрока успешно добавлена в таблицу $table";
} else {
    $data = "Cтрока не добавлена в таблицу $table. Данные введены с ошибкой!!!";
}

$mysqli->close();
    
        return $data;
        
    }
    

    
    public function update_db_data($table,$id,$date,$kat,$item,$sum,$coment) {
        
$mysqli = new mysqli($this -> MYSQL_SERVER, $this -> MYSQL_USER, $this -> MYSQL_PASSWORD, $this -> MYSQL_DB );

/* проверка соединения */
if ($mysqli->connect_errno) {
    printf("Не удалось подключиться: %s\n", $mysqli->connect_error);
    exit();
}
        
        $date= $mysqli->real_escape_string($date);
        $kat = $mysqli->real_escape_string($kat);
        $item= $mysqli->real_escape_string($item);
        $sum= $mysqli->real_escape_string($sum);
        $coment= $mysqli->real_escape_string($coment);

if ($mysqli->query("UPDATE $table  SET  date ='$date' , kat= '$kat',item='$item',sum ='$sum',coment= '$coment' WHERE id = $id")) {
    $data = "Cтрока успешноо обновлена  в таблице $table";
} else {
    $data = "Cтрока не обновлена в таблице $table. Данные введены с ошибкой!!!";
}

$mysqli->close();
    
        return $data;
        
    }
    
public function set_db_data_balance ($date, $operation, $sum, $coment ) {
        
$mysqli = new mysqli($this -> MYSQL_SERVER, $this -> MYSQL_USER, $this -> MYSQL_PASSWORD, $this -> MYSQL_DB );

if ($mysqli->connect_errno) {
    printf("Не удалось подключиться: %s\n", $mysqli->connect_error);
    exit();
}
        $date = $mysqli->real_escape_string($date);
        $operation = $mysqli->real_escape_string($operation);     
        $sum= $mysqli->real_escape_string($sum);
        $coment= $mysqli->real_escape_string($coment);

           $bal = new Balance();
           $balance = $bal -> get_balance();
    
    //Определяем колонку в таблице для записи sum.
if(substr_count($operation,'Корректировка') > 0)
{$column = 'correction'; $balance += $sum;}
if(substr_count($operation,'Снятие') > 0 or substr_count($operation,'Оплата') > 0)
{$column = 'zp_sn';  $balance -= $sum;}
if(substr_count($operation,'Зачисление') > 0 or substr_count($operation,'Начисление') > 0)
{$column = 'zp_nach';$balance += $sum;}
            
if ($mysqli->query("INSERT into card_zp (date,operation,$column,coment) VALUES ('$date','$operation','$sum','$coment')")) {
    $data = "Cтрока успешно добавлена в таблицу!";
    
     $d = $bal -> set_balance($balance);
} else {
    $data = "Cтрока не добавлена в таблицу. Данные введены с ошибкой!!!";
}

$mysqli->close();
    
        return $data;
        
    }
    
    
    public function update_db_data_balance ($id,$date, $operation, $sum, $coment ) {
        
$mysqli = new mysqli($this -> MYSQL_SERVER, $this -> MYSQL_USER, $this -> MYSQL_PASSWORD, $this -> MYSQL_DB );

if ($mysqli->connect_errno) {
    printf("Не удалось подключиться: %s\n", $mysqli->connect_error);
    exit();
}
        $date = $mysqli->real_escape_string($date);
        $operation = $mysqli->real_escape_string($operation);     
        $sum= $mysqli->real_escape_string($sum);
        $coment= $mysqli->real_escape_string($coment);

           $bal = new Balance();        
           $balance = $bal -> get_balance();
           $d = $bal -> del_balance($balance,$id);
           $balance = $bal -> get_balance();
    
    //Определяем колонку в таблице для записи sum.
if(substr_count($operation,'Корректировка') > 0)
{$column = 'correction'; $balance += $sum;}
if(substr_count($operation,'Снятие') > 0 or substr_count($operation,'Оплата') > 0)
{$column = 'zp_sn';  $balance -= $sum;}
if(substr_count($operation,'Зачисление') > 0 or substr_count($operation,'Начисление') > 0)
{$column = 'zp_nach';$balance += $sum;}
        
if ($mysqli->query("UPDATE card_zp  SET date ='$date' , operation= '$operation',zp_nach = null,zp_sn = null,correction = null,coment= '$coment' WHERE id = $id ")) 
{
  }
            
if ($mysqli->query("UPDATE card_zp  SET date ='$date' , operation= '$operation',$column ='$sum',coment= '$coment' WHERE id = $id ")) {
    $data = "Cтрока успешно обновлена в таблице card_zp!";
    $d = $bal -> set_balance($balance);
}  else {
    $data = "Cтрока не обновленна в таблице $table. Данные введены с ошибкой!!!";
}

$mysqli->close();
    
        return $data;
        
    }
    
    
    public function set_db_data_option($table,$column) {
        
$mysqli = new mysqli($this -> MYSQL_SERVER, $this -> MYSQL_USER, $this -> MYSQL_PASSWORD, $this -> MYSQL_DB );

/* проверка соединения */
if ($mysqli->connect_errno) {
    printf("Не удалось подключиться: %s\n", $mysqli->connect_error);
    exit();
}
        $column = $mysqli->real_escape_string($column);

if ($mysqli->query("INSERT into $table ($table) VALUES ('$column')")) {
    $data = "Cтрока успешно добавлена в таблицу $table";
} else {
    $data = "Cтрока не добавлена в таблицу $table. Данные введены с ошибкой!!!";
}

$mysqli->close();
    
        return $data;
        
    }
    
     public function update_db_data_option($table,$id,$column) {
        
$mysqli = new mysqli($this -> MYSQL_SERVER, $this -> MYSQL_USER, $this -> MYSQL_PASSWORD, $this -> MYSQL_DB );

/* проверка соединения */
if ($mysqli->connect_errno) {
    printf("Не удалось подключиться: %s\n", $mysqli->connect_error);
    exit();
}
        $column = $mysqli->real_escape_string($column);
         
            $col ='id';
    if($table =='kat') $col='id_kat';
    if($table =='item') $col='id_item';
    if($table =='balance') $col='id_balance';

if ($mysqli->query("UPDATE $table  SET $table='$column'  WHERE $col = $id")) {
    $data = "Cтрока успешно обновлена в таблице $table";
} else {
    $data = "Cтрока не обновлена в таблице $table. Данные введены с ошибкой!!!";
}

$mysqli->close();
    
        return $data;
        
    }
    
     public function set_db_data_option_card($table,$operation,$code_operation) {
        
$mysqli = new mysqli($this -> MYSQL_SERVER, $this -> MYSQL_USER, $this -> MYSQL_PASSWORD, $this -> MYSQL_DB );

/* проверка соединения */
if ($mysqli->connect_errno) {
    printf("Не удалось подключиться: %s\n", $mysqli->connect_error);
    exit();
}
        $operation = $mysqli->real_escape_string($operation);
        $code_operation = $mysqli -> real_escape_string($code_operation);

if ($mysqli->query("INSERT into card_operation (operation,code_operation) VALUES ('$operation','$code_operation')")) {
    $data = "Cтрока успешно добавлена в таблицу $table";
} else {
    $data = "Cтрока не добавлена в таблицу $table. Данные введены с ошибкой!!!";
}

$mysqli->close();
    
        return $data;
        
    }
    
    
         public function update_db_data_option_card($table,$id,$operation,$code_operation) {
        
$mysqli = new mysqli($this -> MYSQL_SERVER, $this -> MYSQL_USER, $this -> MYSQL_PASSWORD, $this -> MYSQL_DB );

/* проверка соединения */
if ($mysqli->connect_errno) {
    printf("Не удалось подключиться: %s\n", $mysqli->connect_error);
    exit();
}
        $operation = $mysqli->real_escape_string($operation);
        $code_operation = $mysqli -> real_escape_string($code_operation);

if ($mysqli->query("UPDATE card_operation SET operation='$operation',code_operation = '$code_operation' WHERE id_operation = $id")) {
    $data = "Cтрока успешно обновленна в таблице $table";
} else {
    $data = "Cтрока не обновлена в таблице $table. Данные введены с ошибкой!!!";
}

$mysqli->close();
    
        return $data;
        
    }
    
        
public function del_db_data($table,$id) {
        
$mysqli = new mysqli($this -> MYSQL_SERVER, $this -> MYSQL_USER, $this -> MYSQL_PASSWORD, $this -> MYSQL_DB );

    $bal = new Balance();
    $balance = $bal -> get_balance();
    $d = $bal -> del_balance($balance,$id);
    
/* проверка соединения */
if ($mysqli->connect_errno) {
    printf("Не удалось подключиться: %s\n", $mysqli->connect_error);
    exit();
}
 $column ='id';
    if($table =='kat') $column='id_kat';
    if($table =='item') $column='id_item';
    if($table =='card_operation') $column='id_operation';
    
if ($mysqli->query("DELETE FROM $table WHERE $column = $id")) {
    $data = "Cтрока успешно удалена из таблицы $table";
    
}

$mysqli->close();
    
        return $data;
        
    }

    
    // Дальше все функции нужны для авторизации.
    
public function check_access($user) {
      
    $mysqli = new mysqli($this -> MYSQL_SERVER, $this -> MYSQL_USER, $this -> MYSQL_PASSWORD, $this -> MYSQL_DB );

/* проверка соединения */
if ($mysqli->connect_errno) {
    printf("Не удалось подключиться: %s\n", $mysqli->connect_error);
    exit();
}
   
    $query = "SELECT name,pass,groupe FROM users WHERE name ='$user'";     
        
if ($result = $mysqli->query($query)) {     
    while ($row = $result->fetch_row()) {
        $data['name']=$row[0];  
        $data['pass']=$row[1];
        $data['groupe']=$row[2];
  
    }  
      $result->close();
}
$mysqli->close();            
            
        return $data;        
    }

public function check_ip_access($ip) {
        
    $mysqli = new mysqli($this -> MYSQL_SERVER, $this -> MYSQL_USER, $this -> MYSQL_PASSWORD, $this -> MYSQL_DB );

/* проверка соединения */
if ($mysqli->connect_errno) {
    printf("Не удалось подключиться: %s\n", $mysqli->connect_error);
    exit();
}
   
    $query = "SELECT ip,atempt,time FROM access WHERE ip ='$ip'";     
        
if ($result = $mysqli->query($query)) {     
    while ($row = $result->fetch_row()) {
        $data['ip']=$row[0];  
        $data['atempt']=$row[1];  
        $data['time']=$row[2];  
          
    }  
      $result->close();
}
$mysqli->close();            
            
        return $data;  
        
    }
    
public function  clear_ip_access() {
        
$mysqli = new mysqli($this -> MYSQL_SERVER, $this -> MYSQL_USER, $this -> MYSQL_PASSWORD, $this -> MYSQL_DB );
    
/* проверка соединения */
if ($mysqli->connect_errno) {
    printf("Не удалось подключиться: %s\n", $mysqli->connect_error);
    exit();
}

    $time = time() -1800;
if ($mysqli->query("DELETE FROM access WHERE time < '$time'")) {
    $data = true;
    
}

$mysqli->close();
    
        return $data;
        
        
    }
    
public function  del_ip_access($ip) {
        
$mysqli = new mysqli($this -> MYSQL_SERVER, $this -> MYSQL_USER, $this -> MYSQL_PASSWORD, $this -> MYSQL_DB );
    
/* проверка соединения */
if ($mysqli->connect_errno) {
    printf("Не удалось подключиться: %s\n", $mysqli->connect_error);
    exit();
}

    
if ($mysqli->query("DELETE FROM access WHERE ip = '$ip'")) {
    $data = true;
    
}

$mysqli->close();
    
        return $data;
        
        
    }
    
public function set_ip_access($ip,$curent_time,$atempt) {
$mysqli = new mysqli($this -> MYSQL_SERVER, $this -> MYSQL_USER, $this -> MYSQL_PASSWORD, $this -> MYSQL_DB );

/* проверка соединения */
if ($mysqli->connect_errno) {
    printf("Не удалось подключиться: %s\n", $mysqli->connect_error);
    exit();
}
        
        $ip= $mysqli->real_escape_string($ip);
        $atempt = $mysqli->real_escape_string($atempt);
        $curent_time= $mysqli->real_escape_string($curent_time);


if ($mysqli->query("INSERT into access (ip,atempt,time) VALUES ('$ip','$atempt','$curent_time')")) {
    $data = true;
} else {
    $data = false;
}

$mysqli->close();
    
        return $data;
    
    
 }
    
public function  update_ip_access($ip,$atempt) {
       
       $mysqli = new mysqli($this -> MYSQL_SERVER, $this -> MYSQL_USER, $this -> MYSQL_PASSWORD, $this -> MYSQL_DB );

/* проверка соединения */
if ($mysqli->connect_errno) {
    printf("Не удалось подключиться: %s\n", $mysqli->connect_error);
    exit();
}
        $atempt = $mysqli->real_escape_string($atempt);         


if ($mysqli->query("UPDATE access SET atempt='$atempt'  WHERE ip ='$ip'")) {
    $data = true;
} else {
    $data = false;
}

$mysqli->close();
    
        return $data;
       
   }
    
}