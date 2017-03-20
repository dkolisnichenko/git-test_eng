<?php

class Controller_Login extends Controller    
{
        
   
	function __construct()
	{
		$this->model = new Model_Login();
		$this->view = new View();
       
	}
	  
    
	function action_index()
	{	
        
            
        $data = $this->model->get_data();
        
        if ($data == true ) {
             $_SESSION['auth'] ='Yes';
             $_SESSION['user'] = $_POST['user'];
            
            $access = new Access(); 
            $data = $access -> get_user_pass($_SESSION['user']);
            $_SESSION['groupe'] = $data['groupe'];
            
            Route::start();
                  } 
        else {             
        
		$this->view->generate('login_view.php', 'template_login_view.php',$data); 
        }
	}
    

}