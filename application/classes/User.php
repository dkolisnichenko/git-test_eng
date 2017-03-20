<?php

class User {
    
  private $name;  
  private $groupe;  
    
        
public function check_auth($user,$pass,$ip) {
           
     $access = new Access();   
     $ip_check =   $access -> check_ip($ip);
    
    if($ip_check == true)  {         
         $atempt_num =   $access -> get_atempt($ip);
        $access -> add_atempt($ip, $atempt_num);
                  
        }else  {       
         $curent_time = time();
        $access -> set_ip($ip, $curent_time,0);
         $atempt_num =0;
                 
     }
               
        // Если кол-во попыток > 3 то выходим из программы. 
        if( $atempt_num >= 20 )  {
            print('Access denied!'); 
            $auth= false; exit; 
        }                       
             
          
        $data = $access -> get_user_pass($user);
        $user=$data['name'];
        $pass_hash = $data['pass'];
                   
         if(!isset($user)) $auth =false; 
      else{
             $auth=password_verify($pass, $pass_hash);
          if($auth =='true') {
            $access  ->del_atempt($ip);
            $access  ->clear_atempt($ip);
            
             }
       }
                
        return $auth;
    }
    
}