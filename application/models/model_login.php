<?php 
class Model_Login extends Model
{
    
         
	public function get_data()
	{	
                
        
        $user = new User();   
        $data = $user -> check_auth($_POST['user'],$_POST['pass'],$_SERVER['REMOTE_ADDR']);
        	
        return $data;
	}
}