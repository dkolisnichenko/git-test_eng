<?php

class Controller_Main extends Controller    
{
        
   
	function __construct()
	{
		$this->model = new Model_Main();
		$this->view = new View();
       
	}
		    
    
	function action_index()
	{	
        
        
        
        
        $data = $this->model->get_data();
            $title_table= $data[0];
            $data_table =$data[1];
            $title_table1= $data[2];
            $data_table1 =$data[3];  
            $title_table2= $data[4];
            $data_table2 =$data[5];
        
        if($_SESSION['groupe'] != 'admins') {
		$this->view->generate_table('main_view.php', 'template_view.php',$title_table,$data_table,$title_table1,$data_table1,$title_table2,$data_table2); 
        }else {       
        
        $this->view->generate_table('main_view.php', 'template_admin_view.php',$title_table,$data_table,$title_table1,$data_table1,$title_table2,$data_table2);
        }
        
	}
}