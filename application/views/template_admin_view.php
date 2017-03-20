<?php
?>
<!DOCTYPE html>
<html>
<head>
    
   <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
   <script src="https://code.jquery.com/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
     <link rel="stylesheet" href="/styles/styles.css">
    <title> Домашняя Бухгалтерия</title>
    </head>
        
    <body>
        <div class="container">
            <h1>Домашняя Бухгалтерия <h6 class="date"> <em> <?=date("F j, Y, g:i a") ?> </em><br> Пользователь:   <?=$_SESSION['user']  ?><br> Группа:   <?=$_SESSION['groupe']  ?></h6> </h1>   
                             
        <h2>Баланс счета: <?=$GLOBALS["balance"] ?>  грн. </h2>
       
<div class="dropdown">
 <button class="btn  btn-info dropdown-toggle"  type="button" data-toggle="dropdown">Управление счетом
</button>
                            
<ul class="dropdown-menu">
 <li><a href="/rashod"> Расходы </a></li>
     <li><a href="/dohod"> Доходы </a></li>
     <li> <a href="/balance"> 
          Баланс карты 
         </a></li>
     <li class="divider"></li>    
     <li><a href="/option"> <span class="glyphicon glyphicon-option-vertical"></span>Настройки </a></li>
 </ul>  
        

    
 <a href="/stat"><button class="btn  btn-success "  type="button" >Статистика </button></a>  
<a href="/admin"><button class="btn  btn-warning "  type="button" >Панель Администратора </button></a> 
          <a href="/" data-toggle="tooltip" data-placement="Домой" title="Вернуться на главную страницу"> <button class="btn  btn-link"  type="button"  >
         <span class="glyphicon glyphicon-home"></span>  
            </button> </a>  
 <a href="/logout/"><button class="btn  btn-link "  type="button" >Выйти </button></a>   

     </div>         
         </div> 
        
        <div class="container">
            
                     
            <?php include 'application/views/'.$content_view; ?>
            
        </div>
    </body>
    
    <div>
            <footer>
            <p class="text-info"> Домашняя Бухгалтерия <br> Copyrights &copy; 2017</p>            
            </footer>
     </div>
</html>
    