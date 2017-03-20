     <div  class="table-responsive"> 
          
    <?php    
$table = new Table();
$table -> setStyleTable("table table-hover","active","info");
$html_code  = $table -> getTable("Расходы",$title_table, $data_table);
print($html_code);
                       
          ?>  
                                
            </div> 

<br>

     <div  class="table-responsive"> 
          
    <?php    
$table = new Table();
$table -> setStyleTable("table table-hover","active","info");
$html_code  = $table -> getTable("Баланс",$title_table1, $data_table1);
print($html_code);
                       
          ?>  
                                
            </div> 

<br>
     <div  class="table-responsive"> 
          
    <?php    
$table = new Table();
$table -> setStyleTable("table table-hover","active","info");
$html_code  = $table -> getTable("Доходы",$title_table2, $data_table2);
print($html_code);
                       
          ?>  
                                
            </div> 
