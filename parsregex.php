<?php
header("Content-type: text/html;charset=utf-8");
//Выражение require_once аналогично require за исключением того, что PHP проверит, включался ли уже данный файл, и если да, не будет включать его еще раз.
require_once 'simple_html_dom.php';

if(isset($_POST['buttonregex'])) //нажата кнопка
{
  $url = 'http://art-news.com.ua/page/0/'; //сайт от кудаа берется
  $html = file_get_contents($url); // получить сождержимое сайта
  //i - регистр независимости   , s - включение однострочного режима   , u - для работы с кирилицей
 $regex_body_news = '#<div class="ts-row posts-grid listing-grid grid-2 "[^>]*?>(.+?)</div> <div class="main-pagination ">#isu'; // регулярка достает блок новостей
  $regex_article = '#<p[^>]*?>(.+?)</p>#isu'; // дастает отдельные записи

  // preg_match_all — Выполняет глобальный поиск шаблона в строке
  preg_match_all($regex_body_news, $html, $res_body_news); // шаблон регулярка, от куда берем(где шаблон находит), регулярка пременяется на содержимое сайта
  preg_match_all($regex_article, $res_body_news[0][0], $res_article); 

  for ($i = 0; $i <= count($res_article[0])-1; $i++) {
      $_article = "";
      $_article = $res_article[1][$i];
      echo '<br>'.$_article.'</br>';
   }
}
?>