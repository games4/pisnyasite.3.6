<?php
// 2016-02-01
$result77 = mysql_query("SELECT str FROM options", $db);
verification_query($result77);
$myrow77 = mysql_fetch_array($result77);
$limit = $myrow77["str"];
// echo "<p class='p1'>кількість записів на сторінку - $limit</p>";
// отримую з URL номер поточної сторінки 
@$page = $_GET['page'];
// перевіряю, чи існує параметр $_GET['page'] якщо так то ..., якщо ні то це 1-ша сторінка 
// $page = isset($_GET['page']) ? $_GET['page']: 1;
if (isset($_GET['page'])) $page = $_GET['page'];
else $page = 1;
// echo "<p class='p1'>поточна сторінка - $page</p>";
$offset = $limit * ($page -1);
// echo "<p class='p1'>крок зміни сторінок - $offset</p>";
// визначаю загальну кількість записів в базі даних
$result00 = mysql_query("SELECT COUNT(*) FROM view");
verification_query($result00);
$temp = mysql_fetch_array($result00);
$posts = $temp[0];
// echo "<p class='p1'>всього записів в базі даних view - $posts</p>";
// визначаю загальну кількість сторінок 
$total = (($posts - 1) / $limit) + 1;
$total =  intval($total);
// echo "<p class='p1'>загальна кількість сторінок - $total</p>";
// Определяем начало сообщений для текущей страницы
$page = intval($page);
// echo "<p class='p1'>початок повідомлень для поточної сторінки  - $page</p>";
// Если значение $page меньше единицы или отрицательно
// переходим на первую страницу
// А если слишком большое, то переходим на последнюю
if(empty($page) or $page < 0) $page = 1;
  if($page > $total) $page = $total;
// Вычисляем начиная с какого номера следует выводить сообщения
$start = $page * $limit - $limit;
// Выбираем $limit сообщений начиная с номера $start
// 2016-02-01
//$result_k = mysql_query ("SELECT view.date, kompozycija.id, kompozycija.title, vykonavec.title AS vykonavec FROM view, kompozycija, vykonavec WHERE kompozycija.id = view.kompozycija AND kompozycija.vykonavec1 = vykonavec.id ORDER BY view.date DESC, view.num DESC",$db); 

// 2022-02-18
$result_k = mysql_query ("SELECT view.date, kompozycija.id, kompozycija.title, vykonavec.title AS vykonavec FROM view, kompozycija, vykonavec WHERE kompozycija.id = view.kompozycija AND kompozycija.vykonavec1 = vykonavec.id ORDER BY view.date DESC, view.num DESC LIMIT $start, $limit", $db); 
verification_query($result_k);

echo '  <ul class="compositions__list">';
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
echo '  </ul>';

//2022-02-20 код для виводу пагінації 
// Виводимо поточну сторінку 
if (isset($page) && $page != 1 && $page != $total) $page_current = '<li class="pagination__item"><a class="pagination__link pagination__link--active" title="Поточна сторінка" href="chronology.php?page='.$page.'#pagination">'.$page.'</a></li>';
// Виводимо посилання на першу сторінку
if ($page == 1 && $total >= 2) $page_first = '<li class="pagination__item"><a class="pagination__link pagination__link--active" title="Перша"> 1 </a></li>';
elseif ($page == 2 && $total > 2) $page_first = '';
else $page_first = '<li class="pagination__item"><a class="pagination__link" title="Перша" href="chronology.php?page=1#pagination">1</a></li>';
// Виводимо попередню сторінку 
if ($page != 1) $page_previous = '<li class="pagination__item"><a class="pagination__link" title="Попередня" href="chronology.php?page='.($page - 1).'#pagination">&lt;</a></li>';
// Виводимо наступну сторінку
if ($page != $total) $page_next = '<li class="pagination__item"><a class="pagination__link" title="Наступна" href="chronology.php?page='.($page + 1).'#pagination">&gt;</a></li>';
// Додаю початковий розрив
if ($total > 3 && ($page - 1) > 1 && ($page - 2) > 1 ) $page_others_start = '<li class="pagination__item"><a class="pagination__link--nonactive">...</a></li>';
// Додаю кінцевий розрив
if ($total > 3 && ($page + 1) < $total && ($page + 2) < $total ) $page_others_end = '<li class="pagination__item"><a class="pagination__link--nonactive">...</a></li>';
// Вивожу посилання на останню сторінку, якщо воно потрібно
if ($page == $total) $page_total = '<li class="pagination__item"><a class="pagination__link pagination__link--active" title="Остання">'.$total.'</a></li>';
else $page_total = '<li class="pagination__item"><a class="pagination__link" title="Остання" href="chronology.php?page='.$total.'#pagination">'.$total.'</a></li>';
// Виводимо три найближчі сторінки з обох боків, якщо вони є
if($page + 1 < $total) $page_right_1 = '<li class="pagination__item"><a class="pagination__link" title="На одну зправа" href="chronology.php?page='.($page + 1).'#pagination">'.($page + 1).'</a></li>';
if($page + 2 < $total && $page < 2) $page_right_2 = '<li class="pagination__item"><a class="pagination__link" title="На дві зправа" href="chronology.php?page='.($page + 2).'#pagination">'.($page + 2).'</a></li>';
if($page + 3 <= $total) $page_right_3 = '<li class="pagination__item"><a class="pagination__link" title="На три зправа" href="chronology.php?page='.($page + 3).'#pagination">'.($page + 3).'</a></li>';
if($page - 1 > 0) $page_left_1 = '<li class="pagination__item"><a class="pagination__link" title="На одну зліва" href="chronology.php?page='.($page - 1).'#pagination">'.($page - 1).'</a></li>';
if($page - 2 > 0 && $page > $total - 2 ) $page_left_2 = '<li class="pagination__item"><a class="pagination__link" title="На дві зліва" href="chronology.php?page='.($page - 2).'#pagination">'.($page - 2).'</a></li>';
if($page - 3 > 0) $page_left_3 = '<li class="pagination__item"><a class="pagination__link" title="На три зліва" href="chronology.php?page='.($page - 3).'#pagination">'.($page - 3).'</a></li>';

// Вивожу меню сторінок якщо сторінок більше однієї
if ($total > 1)
{
  Error_Reporting(E_ALL & ~E_NOTICE);
  echo '  <ul class="pagination pagination__list" id="pagination">';
  // echo $page_previous;
  echo $page_first;
  echo $page_others_start;
  echo $page_left_2;
  echo $page_left_1;
  echo $page_current;
  echo $page_right_1;
  echo $page_right_2;
  echo $page_others_end ;
  echo $page_total;
  // echo $page_next;
  echo '  </ul>';
}

// Вывод меню если страниц больше одной
// if ($total > 1)
// {
  // Error_Reporting(E_ALL & ~E_NOTICE);
  // echo '  <div class="pagination pstrnav">';
  // echo $page_first.$page_previous.$page_left_3.$page_left_2.$page_left_1.'<b>'.$page.'</b>'.$page_right_1.$page_right_2.$page_right_3.$page_next.$page_total;
  // echo '  </div>';
// }


//2016-02-01
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