<?php
//01.02.16
$result77 = mysql_query("SELECT str FROM options", $db);
verification_query($result77);
$myrow77 = mysql_fetch_array($result77);
$num = $myrow77["str"];
//echo "<p class='p1'>кількість записів на сторінку - $num</p>";
// Извлекаем из URL текущую страницу
@$page = $_GET['page'];
// Определяем общее число сообщений в базе данных
$result00 = mysql_query("SELECT COUNT(*) FROM view");
verification_query($result00);
$temp = mysql_fetch_array($result00);
$posts = $temp[0];
//echo "<p class='p1'>всього записів в базі даних - $posts</p>";
// Находим общее число страниц
$total = (($posts - 1) / $num) + 1;
$total =  intval($total);
// Определяем начало сообщений для текущей страницы
$page = intval($page);
// Если значение $page меньше единицы или отрицательно
// переходим на первую страницу
// А если слишком большое, то переходим на последнюю
if(empty($page) or $page < 0) $page = 1;
  if($page > $total) $page = $total;
// Вычисляем начиная с какого номера
// следует выводить сообщения
$start = $page * $num - $num;
// Выбираем $num сообщений начиная с номера $start		
//01.02.16

//01.02.16
//$result_k = mysql_query ("SELECT view.date, kompozycija.id, kompozycija.title, vykonavec.title AS vykonavec FROM view, kompozycija, vykonavec WHERE kompozycija.id = view.kompozycija AND kompozycija.vykonavec1 = vykonavec.id ORDER BY view.date DESC, view.num DESC",$db); 

//01.02.16
$result_k = mysql_query ("SELECT view.date, kompozycija.id, kompozycija.title, vykonavec.title AS vykonavec FROM view, kompozycija, vykonavec WHERE kompozycija.id = view.kompozycija AND kompozycija.vykonavec1 = vykonavec.id ORDER BY view.date DESC, view.num DESC LIMIT $start, $num",$db); 
verification_query($result_k);

while ($myrow_k = mysql_fetch_array($result_k))
{
  echo '
    <li class="compositions__item">
      <a class="composition__link" href="kompozycija.php?id='.$myrow_k["id"].'">
        <time class="composition__date" datetime="2017-06-26">'.$myrow_k["date"].'</time>
        <b class="compositions__title">'.$myrow_k["title"].' - '.$myrow_k["vykonavec"].'</b>
      </a>
    </li>';
}
 
//01.02.16
// Проверяем нужны ли стрелки назад
if ($page != 1) $pervpage = '<a title="Перша" href=chronology.php?page=1> <<< </a> | <a  title="Попередня" href=chronology.php?page='. ($page - 1) .'> < </a> | ';
// Проверяем нужны ли стрелки вперед
if ($page != $total) $nextpage = ' | <a title="Наступна" href=chronology.php?page='. ($page + 1) .'> > </a> | <a title="Остання" href=chronology.php?page=' .$total. '> >>> </a>';

// Находим две ближайшие станицы с обоих краев, если они есть
if($page - 5 > 0) $page5left = '<a href=chronology.php?page='. ($page - 5) .'>'. ($page - 5) .'</a> | ';
if($page - 4 > 0) $page4left = '<a href=chronology.php?page='. ($page - 4) .'>'. ($page - 4) .'</a> | ';
if($page - 3 > 0) $page3left = '<a href=chronology.php?page='. ($page - 3) .'>'. ($page - 3) .'</a> | ';
if($page - 2 > 0) $page2left = '<a href=chronology.php?page='. ($page - 2) .'>'. ($page - 2) .'</a> | ';
if($page - 1 > 0) $page1left = '<a href=chronology.php?page='. ($page - 1) .'>'. ($page - 1) .'</a> | ';

if($page + 5 <= $total) $page5right = ' | <a href=chronology.php?page='. ($page + 5) .'>'. ($page + 5) .'</a>';
if($page + 4 <= $total) $page4right = ' | <a href=chronology.php?page='. ($page + 4) .'>'. ($page + 4) .'</a>';
if($page + 3 <= $total) $page3right = ' | <a href=chronology.php?page='. ($page + 3) .'>'. ($page + 3) .'</a>';
if($page + 2 <= $total) $page2right = ' | <a href=chronology.php?page='. ($page + 2) .'>'. ($page + 2) .'</a>';
if($page + 1 <= $total) $page1right = ' | <a href=chronology.php?page='. ($page + 1) .'>'. ($page + 1) .'</a>';

// Вывод меню если страниц больше одной

if ($total > 1)
{
  Error_Reporting(E_ALL & ~E_NOTICE);
  echo "<div class=\"pstrnav\">";
  //echo $pervpage.$page5left.$page4left.$page3left.$page2left.$page1left.'<b>'.$page.'</b>'.$page1right.$page2right.$page3right.$page4right.$page5right.$nextpage;
  echo $pervpage.$page3left.$page2left.$page1left.'<b>'.$page.'</b>'.$page1right.$page2right.$page3right.$nextpage;
  echo "</div>";
}

//01.02.16
/*
//попередній варіант коду /27.02.2012/
echo $myrow_set['text']; 
if (!isset($id))
{        
    $result_vykonaveciew = mysql_query ("SELECT * FROM view ORDER BY date DESC, num DESC",$db);
    verification_query($result_vykonaveciew);
    
    while ($myrow_vykonaveciew = mysql_fetch_array ($result_vykonaveciew))
    {
        $view = $myrow_vykonaveciew["kompozycija"];
        $date = $myrow_vykonaveciew["date"];
        $result_k = mysql_query ("SELECT id, title, vykonavec1 FROM kompozycija WHERE id = $view",$db); 
    	verification_query($result_k);
             
    	while ($myrow_k = mysql_fetch_array($result_k))
        {
            $id = $myrow_k["vykonavec1"];
            $result_vykonavec1 = mysql_query ("SELECT title FROM vykonavec WHERE id=$id");
            verification_query($result_vykonavec1); 
            $myrow_vykonavec1 = mysql_fetch_array($result_vykonavec1);
            printf ('<p class="link_sp"><a href="kompozycija.php?id=%s">/%s/ - %s - %s</a></p>',$myrow_k["id"],$myrow_vykonaveciew["date"],$myrow_k["title"],$myrow_vykonavec1["title"]);
        }
     }            
}
*/

/*
if (!isset($id))
{        
	$result_k = mysql_query ("SELECT id, title, vykonavec1 FROM kompozycija WHERE view = 1 ORDER BY title",$db); 
	verification_query($result_k);       
	$myrow_k = mysql_fetch_array($result_k);
	
	
	do
	{
		$id = $myrow_k["vykonavec1"];
		$result_vykonavec1 = mysql_query ("SELECT title FROM vykonavec WHERE id=$id");
		verification_query($result_vykonavec1); 
		$myrow_vykonavec1 = mysql_fetch_array($result_vykonavec1);
		printf ('<p class="link_sp"><a href="kompozycija.php?id=%s">%s - %s</a></p>',$myrow_k["id"],$myrow_k["title"],$myrow_vykonavec1["title"]);
	}
	while ($myrow_k = mysql_fetch_array($result_k));
}
*/

?>


