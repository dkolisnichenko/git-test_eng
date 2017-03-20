<?php

class Access {
    
    
    
    public function check_ip($ip) {
        
        //Запрос в БД. Если есть запись - true, если нет то false
        $conect = new DB();         
        $data = $conect ->check_ip_access($ip);
        if(!isset($data['ip'])) $ip =false;
        else { 
            $cur_time = time();
            $time = $cur_time - $data['time'];
            if($time < 60) $ip = true; else{
               $del = $conect ->del_ip_access($ip);
                if($del =='true') $ip = false; 
            }  
                
        }
                
        return $ip;
    }
    
    
     public function set_ip($ip,$curent_time,$atempt) {
     
        $conect = new DB();         
        $data = $conect ->set_ip_access($ip,$curent_time,$atempt);
         
         
     }
    
    
   public function get_atempt($ip) {
       
        $conect = new DB();         
        $data = $conect ->check_ip_access($ip);       
        $num=$data['atempt'];
       
        return $num;
    }
    
    
public function add_atempt($ip,$num) {
    
     $conect = new DB();        
     $atempt = $num + 1;
     $data = $conect ->update_ip_access($ip,$atempt);
    }
    
    
    public function del_atempt($ip) {
    
     $conect = new DB();        
     $conect -> del_ip_access($ip);
    }
    
        public function clear_atempt() {
    
     $conect = new DB();        
     $conect -> clear_ip_access();
    }
    
    
public function get_user_pass($user) {
    
     $conect = new DB();  
     $data = $conect -> check_access($user);
     
    return $data;
    }
    
}