<?php
class Teg {
    
    public function setTeg_a($href,$datatoggle,$dataplacement,$title,$value) {
        
        return $teg = "<a href = \""."$href"."\"  data-toggle = \""."$datatoggle"."\" data-placement = \""."$dataplacement"."\" title = \""."$title"."\" >"."$value"."</a>"; 
                
    }
    
    
}
class Cell {
    
    private $value;
    protected $style;
    protected $html_code;     
       
    protected function setStyle($style) {
        $this -> style = $style; 
     
    }
      
     protected function setHtmlCodeCell($value,$style) {
               
       $this -> html_code =  "<th  class = \""."$style"."\">"."$value"."</th>";      
        return $this -> html_code; 
        
    }
    }     

 class Row extends Cell{
     
     private $value_row;
     
    protected function setHtmlCodeRow($value,$style ) {        
    $style  = $this -> style ; 
        
    $cell = new Cell();        
        foreach ($value as $a) {                 
              $data .= $cell -> setHtmlCodeCell($a,$style);      
        }       
        
         $this -> html_code  = "<tr  class = \""."$style"."\">"."$data"."</tr>";
             return $this -> html_code; 
        
    }           
      }

class Table extends Row  {  
    
    protected $name;
    protected $title;
    protected $data;
    protected $style_data;
    protected $style_title;
    protected  $style_table;      
    
    public function getTable($name,$title,$data) {
          
    $this -> name = $name;  
    $this -> title  = $title;
    $this -> data = $data;
    $style_table = $this -> style_table;
    $style_title = $this -> style_title;
    $style_data  = $this -> style_data;
           
        $row = new Row();
        $row -> setStyle($style_title);
        $dat .= $row -> setHtmlCodeRow($title,$style_table);      
     
        $arr= array_chunk($data, count($title));
        $row = new Row();
        $row -> setStyle($style_data);
        
     for($i = 0; $i < count($arr); $i++) {   
         
         $dat .= $row -> setHtmlCodeRow($arr[$i],$style_data);    }
                
        $this -> html_code  = "<h4>".$name."</h4>"."<table  class = \"".$style_table."\">".$dat."</table>";
             return $this -> html_code; 
   
    }
      
    function setStyleTable ($style_table,$style_title,$style_data) {
        
        $this ->  style_table = $style_table;
        $this ->  style_title = $style_title;
        $this ->  style_data = $style_data;
         
    }    
  
           function setNameTable ($name) {        
        $this -> name = $name;
         
    }
    
}
    
    class AdminTable extends Table {
        
             protected $name_alias;
        
     public function getAdminTable($name,$name_alias,$title,$data) {
         
        $edit ="Редактировать";
        $del = "Удалить";
      
    $this -> name = $name;  
    $this -> name_alias = $name_alias;  
    $this -> title  = $title;
    $this -> data = $data;
    $style_table = $this -> style_table;
    $style_title = $this -> style_title;
    $style_data  = $this -> style_data;
           
     
        $row = new Row();
        $teg = new Teg(); 
        $href="/add/".$name_alias;
        $dat = $teg -> setTeg_a($href,                       "tooltip","auto","Добавить запись","  + Добавить запись");
        
         
        $title[] =$edit;
        $title[] =$del;             
           
        $row -> setStyle($style_title);
        $dat .= $row -> setHtmlCodeRow($title,$style_table);             
        $arr= array_chunk($data, count($title)-2);
        $row = new Row();
        $row -> setStyle($style_data);
        
     for($i = 0; $i < count($arr); $i++) {  

         $arr1=$arr[$i];
         
        $teg = new Teg(); 
         
        $href="edit/".$name_alias."/".$arr1[0];
        $edit="<span class="."\"glyphicon glyphicon-edit\""."></span>";
        $str= $teg -> setTeg_a($href,                       "tooltip","auto","Редактировать запись",$edit);
         
         $href="del/".$name_alias."/".$arr1[0];        
         $del="<span class="."\"glyphicon glyphicon-remove\""."></span>";      
         $str1= $teg -> setTeg_a($href,                       "tooltip","auto","Удалить запись",$del);
         
         $arr1[] =$str;
         $arr1[] =$str1;
                
         $dat .= $row -> setHtmlCodeRow($arr1,$style_data);    }
                
        $this -> html_code  = "<h4>".$name."</h4>"."<table  class = \"".$style_table."\">".$dat."</table>";
             return $this -> html_code; 
   
    }
        
    }
    













