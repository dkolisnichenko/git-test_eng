<?php 
class Model_Main extends Model
{
    
         
	public function get_data()
	{	        
            
   $conect = new DB();   
               
      $data_table = $conect -> get_db_data('full','date','date,kat,item,sum,coment');
        $title_table = $conect -> get_db_data('full_title','id','date,kat,item,sum,coment');
        
        $data_table1 = $conect -> get_db_data('card_zp','date','date,operation,zp_nach,zp_sn,correction,coment');
        $title_table1 = $conect -> get_db_data('card_zp_title','id','date,operation,zp_nach,zp_sn,correction,coment');
        
        $data_table2 = $conect -> get_db_data('full_d','date','date,kat,item,sum,coment');
        $title_table2 = $conect -> get_db_data('full_d_title','id','date,kat,item,sum,coment');
  
        $arr[0]=$title_table;
        $arr[1]=$data_table; 
        $arr[2]=$title_table1;
        $arr[3]=$data_table1;  
        $arr[4]=$title_table2;
        $arr[5]=$data_table2;
        
        

		
        return $arr;
	}
}