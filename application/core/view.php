<?php

class View
{
	//public $template_view; // здесь можно указать общий вид по умолчанию.
	
	function generate($content_view, $template_view, $data = null)
	{
		/*
		if(is_array($data)) {
			// преобразуем элементы массива в переменные
			extract($data);
		}
		*/
		
		include 'application/views/'.$template_view;
	}
    
    	function generate_table($content_view, $template_view, $title_table = null,$data_table = null,$title_table1 = null,$data_table1 = null,$title_table2 = null,$data_table2 = null)
	{
			
		include 'application/views/'.$template_view;
	}
    
      	function generate_form($content_view, $template_view, $link = null,$kat = null,$item = null,$date = null, $sum=null, $coment=null,$id=0)
	{
			
		include 'application/views/'.$template_view;
	}
    
         	function generate_form1($content_view, $template_view, $link = null,$kat = null,$date = null, $sum=null, $coment=null,$id=null)
	{
			
		include 'application/views/'.$template_view;
	}
    
}