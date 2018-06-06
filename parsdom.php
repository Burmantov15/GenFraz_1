<?php
header("Content-type: text/html;charset=utf-8");
//Выражение require_once аналогично require за исключением того, что PHP проверит, включался ли уже данный файл, и если да, не будет включать его еще раз.
require_once 'simple_html_dom.php';

if(isset($_POST['buttondom']))
{
  $url = 'https://openskys.ru/velikie-citaty';
  $html = file_get_html($url); // умеет загружать данные с удаленного URL или из локального файла

  // $html->find  - выполняет поиск в документе по заданным параметрам
  if($html->find('div.entry-content p.box')){
      foreach($html->find('div.entry-content p.box') as $content){
      	echo '<br>'.$content->innertext.'</br>';
      }
  }
  $html->clear(); // подчищаем за собой
  unset($html);
}
?>