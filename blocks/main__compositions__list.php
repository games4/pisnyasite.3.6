<?php
//2022-02-14 запозичино з main__chronology__list.php
$result77 = mysql_query("SELECT str FROM options", $db);
verification_query($result77);
$myrow77 = mysql_fetch_array($result77);
$limit = $myrow77["str"];
// $limit = 20;
// echo "<p class='p1'>кількість записів на сторінку = $limit</p>";
// Извлекаем из URL текущую страницу
@$page = $_GET['page'];
// перевіряю, чи існує параметр $_GET['page'] якщо так то ..., якщо ні то це 1-ша сторінка 
// $page = isset($_GET['page']) ? $_GET['page']: 1;
if (isset($_GET['page'])) $page = $_GET['page'];
else $page = 1;
// echo "<p class='p1'>поточна сторінка - $page</p>";
$offset = $limit * ($page -1);
// echo "<p class='p1'>крок зміни сторінок - $offset</p>";
// Определяем общее число сообщений в базе данных
$result00 = mysql_query("SELECT COUNT(*) FROM view");
verification_query($result00);
$temp = mysql_fetch_array($result00);
$posts = $temp[0];
// echo "<p class='p1'>всього записів в базі даних view = $posts</p>";
// Находим общее число страниц
$total = (($posts - 1) / $limit) + 1;
$total =  intval($total);
// echo "<p class='p1'>загальна кількість сторінок = $total</p>";
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

$result_k = mysql_query ("SELECT kompozycija.id, kompozycija.title, vykonavec.title AS vykonavec FROM view, kompozycija, vykonavec WHERE kompozycija.id = view.kompozycija AND kompozycija.vykonavec1 = vykonavec.id ORDER BY kompozycija.title, view.num DESC LIMIT $start, $limit", $db); 
verification_query_2($result_k);

echo '<ul class="compositions__list">';
while ($myrow_k = mysql_fetch_array($result_k))
{
  echo '
    <li class="compositions__item">
      <a class="compositions__link" href="kompozycija.php?id='.$myrow_k["id"].'">
        <b class="compositions__title">'.$myrow_k["title"].' - '.$myrow_k["vykonavec"].'</b>
      </a>
    </li>
    ';
}
echo '
  </ul>
  ';

//2022-02-14 запозичино з main__chronology__list.php
// Виводимо поточну сторінку 
if (isset($page) && $page != 1 && $page != $total) $page_current = '<li class="pagination__item"><a class="pagination__link pagination__link--active" title="Поточна сторінка" href="pisni.php?page='.$page.'#pagination">'.$page.'</a></li>';
// Виводимо посилання на першу сторінку
if ($page == 1 && $total >= 2) $page_first = '<li class="pagination__item"><a class="pagination__link pagination__link--active" title="Перша"> 1 </a></li>';
elseif ($page == 2 && $total > 2) $page_first = '';
else $page_first = '<li class="pagination__item"><a class="pagination__link" title="Перша" href="pisni.php?page=1#pagination">1</a></li>';
// Виводимо попередню сторінку 
if ($page != 1) $page_previous = '<li class="pagination__item"><a class="pagination__link" title="Попередня" href="pisni.php?page='.($page - 1).'#pagination">&lt;</a></li>';
// Виводимо наступну сторінку
if ($page != $total) $page_next = '<li class="pagination__item"><a class="pagination__link" title="Наступна" href="pisni.php?page='.($page + 1).'#pagination">&gt;</a></li>';
// Додаю початковий розрив
if ($total > 3 && ($page - 1) > 1 && ($page - 2) > 1 ) $page_others_start = '<li class="pagination__item"><a class="pagination__link--nonactive">...</a></li>';
// Додаю кінцевий розрив
if ($total > 3 && ($page + 1) < $total && ($page + 2) < $total ) $page_others_end = '<li class="pagination__item"><a class="pagination__link--nonactive">...</a></li>';
// Вивожу посилання на останню сторінку, якщо воно потрібно
if ($page == $total) $page_total = '<li class="pagination__item"><a class="pagination__link pagination__link--active" title="Остання">'.$total.'</a></li>';
else $page_total = '<li class="pagination__item"><a class="pagination__link" title="Остання" href="pisni.php?page='.$total.'#pagination">'.$total.'</a></li>';
// Виводимо три найближчі сторінки з обох боків, якщо вони є
if($page + 1 < $total) $page_right_1 = '<li class="pagination__item"><a class="pagination__link" title="На одну зправа" href="pisni.php?page='.($page + 1).'#pagination">'.($page + 1).'</a></li>';
if($page + 2 < $total && $page < 2) $page_right_2 = '<li class="pagination__item"><a class="pagination__link" title="На дві зправа" href="pisni.php?page='.($page + 2).'#pagination">'.($page + 2).'</a></li>';
if($page + 3 <= $total) $page_right_3 = '<li class="pagination__item"><a class="pagination__link" title="На три зправа" href="pisni.php?page='.($page + 3).'#pagination">'.($page + 3).'</a></li>';
if($page - 1 > 0) $page_left_1 = '<li class="pagination__item"><a class="pagination__link" title=" title="На одну зліва" href="pisni.php?page='.($page - 1).'#pagination">'.($page - 1).'</a></li>';
if($page - 2 > 0 && $page > $total - 2 ) $page_left_2 = '<li class="pagination__item"><a class="pagination__link" title="На дві зліва" href="pisni.php?page='.($page - 2).'#pagination">'.($page - 2).'</a></li>';
if($page - 3 > 0) $page_left_3 = '<li class="pagination__item"><a class="pagination__link" title="На три зліва" href="pisni.php?page='.($page - 3).'#pagination">'.($page - 3).'</a></li>';

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

// Находим две ближайшие станицы с обоих краев, если они есть
// if($page - 5 > 0) $page_left_5 = '<a href="pisni.php?page='. ($page - 5) .'">'. ($page - 5) .'</a> | ';
// if($page - 4 > 0) $page_left_4 = '<a href="pisni.php?page='. ($page - 4) .'">'. ($page - 4) .'</a> | ';
//if($page - 3 > 0) $page_left_3 = '<a href="pisni.php?page='. ($page - 3) .'">'. ($page - 3) .'</a> | ';
//if($page - 2 > 0) $page_left_2 = '<a href="pisni.php?page='. ($page - 2) .'">'. ($page - 2) .'</a> | ';
//if($page - 1 > 0) $page_left_1 = '<a href="pisni.php?page='. ($page - 1) .'">'. ($page - 1) .'</a> | ';

// if($page + 5 <= $total) $page_right_5 = ' | <a href="pisni.php?page='. ($page + 5) .'">'. ($page + 5) .'</a>';
// if($page + 4 <= $total) $page_right_4 = ' | <a href="pisni.php?page='. ($page + 4) .'">'. ($page + 4) .'</a>';
//if($page + 3 <= $total) $page_right_3 = ' | <a href="pisni.php?page='. ($page + 3) .'">'. ($page + 3) .'</a>';
//if($page + 2 <= $total) $page_right_2 = ' | <a href="pisni.php?page='. ($page + 2) .'">'. ($page + 2) .'</a>';
//if($page + 1 <= $total) $page_right_1 = ' | <a href="pisni.php?page='. ($page + 1) .'">'. ($page + 1) .'</a>';

// Вывод меню если страниц больше одной
//if ($total > 1)
//{
//  Error_Reporting(E_ALL & ~E_NOTICE);
//  echo '<div class="pstrnav">';
  //echo $page_previous.$page_left_5.$page_left_4.$page_left_3.$page_left_2.$page_left_1.'<b>'.$page.'</b>'.$page_right_1.$page_right_2.$page_right_3.$page_right_4.$page_right_5.$page_next;
//  echo $page_first.$page_previous.$page_left_3.$page_left_2.$page_left_1.'<b>'.$page.'</b>'.$page_right_1.$page_right_2.$page_right_3.$page_next;
//  echo "</div>";
//}

// 2016-02-01
// Виводимо посилання на першу сторінку
// if ($page != 1) $page_first = '<a title="Перша" href="pisni.php?page=1"> <<< </a>';
// Проверяем нужны ли стрелки назад
// if ($page != 1) $page_previous = ' | <a  title="Попередня" href="pisni.php?page='. ($page - 1) .'"> < </a> | ';
// Проверяем нужны ли стрелки вперед
// if ($page != $total) $page_next = ' | <a title="Наступна" href="pisni.php?page='. ($page + 1) .'"> > </a> | <a title="Остання" href="pisni.php?page=' .$total. '"> >>> </a>';

// Находим две ближайшие станицы с обоих краев, если они есть
// if($page - 5 > 0) $page_left_5 = '<a href="pisni.php?page='. ($page - 5) .'">'. ($page - 5) .'</a> | ';
// if($page - 4 > 0) $page_left_4 = '<a href="pisni.php?page='. ($page - 4) .'">'. ($page - 4) .'</a> | ';
// if($page - 3 > 0) $page_left_3 = '<a href="pisni.php?page='. ($page - 3) .'">'. ($page - 3) .'</a> | ';
// if($page - 2 > 0) $page_left_2 = '<a href="pisni.php?page='. ($page - 2) .'">'. ($page - 2) .'</a> | ';
// if($page - 1 > 0) $page_left_1 = '<a href="pisni.php?page='. ($page - 1) .'">'. ($page - 1) .'</a> | ';

// if($page + 5 <= $total) $page_right_5 = ' | <a href="pisni.php?page='. ($page + 5) .'">'. ($page + 5) .'</a>';
// if($page + 4 <= $total) $page_right_4 = ' | <a href="pisni.php?page='. ($page + 4) .'">'. ($page + 4) .'</a>';
// if($page + 3 <= $total) $page_right_3 = ' | <a href="pisni.php?page='. ($page + 3) .'">'. ($page + 3) .'</a>';
// if($page + 2 <= $total) $page_right_2 = ' | <a href="pisni.php?page='. ($page + 2) .'">'. ($page + 2) .'</a>';
// if($page + 1 <= $total) $page_right_1 = ' | <a href="pisni.php?page='. ($page + 1) .'">'. ($page + 1) .'</a>';

// Вывод меню если страниц больше одной

//if ($total > 1)
//{
//  Error_Reporting(E_ALL & ~E_NOTICE);
//  echo '<div class="pstrnav">';
  //echo $page_previous.$page_left_5.$page_left_4.$page_left_3.$page_left_2.$page_left_1.'<b>'.$page.'</b>'.$page_right_1.$page_right_2.$page_right_3.$page_right_4.$page_right_5.$page_next;
//  echo $page_first.$page_previous.$page_left_3.$page_left_2.$page_left_1.'<b>'.$page.'</b>'.$page_right_1.$page_right_2.$page_right_3.$page_next;
//  echo "</div>";
//}

?>
