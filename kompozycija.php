<?php 
include_once("blocks/func.inc.php");
include("blocks/db.php");

$page = 'pisni';

if (isset($_GET['id'])) {$id = $_GET['id']; if ($id == '') {unset($id);}} 

/* Безпека - Перевіряємо, чи є змінна, що передається, числом */
if (!preg_match("|^[\d]+$|", $id)) { exit ("<p>Невірний формат запиту! Перевірте URL!"); }

$result = mysql_query ("SELECT * FROM view, kompozycija WHERE view.kompozycija = kompozycija.id AND view.kompozycija= $id",$db);
verification_query($result);
$myrow = mysql_fetch_array ($result);

if (isset($myrow["povidomlennya"]))
{
  $notes = $myrow["povidomlennya"];
  $result_notes = mysql_query ("SELECT * FROM povidomlennya WHERE id = $notes", $db);
  verification_query($result_notes);
  $myrow_notes = mysql_fetch_array ($result_notes);
}

$vykonavec1 = $myrow["vykonavec1"];
$result_vykonavec1 = mysql_query ("SELECT * FROM vykonavec WHERE id = $vykonavec1", $db);
verification_query($result_vykonavec1);
$myrow_vykonavec1 = mysql_fetch_array ($result_vykonavec1);

if (isset($myrow["vykonavec2"])) 
{
  $vykonavec2 = $myrow["vykonavec2"];
  $result_vykonavec2 = mysql_query ("SELECT * FROM vykonavec WHERE id = $vykonavec2" ,$db);
  verification_query($result_vykonavec2);
  $myrow_vykonavec2 = mysql_fetch_array ($result_vykonavec2);
}

$tvir = $myrow['tvir'];
$result_tvir = mysql_query ("SELECT * FROM tvir WHERE id=$tvir",$db);
verification_query($result_tvir);
$myrow_tvir = mysql_fetch_array ($result_tvir);

$avtor_muzyky = $myrow_tvir['avtor_muzyky'];
$result_am = mysql_query ("SELECT title FROM avtor_muzyky WHERE id=$avtor_muzyky",$db);
verification_query($result_am);
$myrow_am = mysql_fetch_array ($result_am);

$avtor_sliv = $myrow_tvir['avtor_sliv'];
$result_as = mysql_query ("SELECT title FROM avtor_sliv WHERE id=$avtor_sliv",$db);
verification_query($result_as);
$myrow_as = mysql_fetch_array ($result_as);

$vydannya = $myrow['vydannya'];
if (isset($vydannya))
{
  $result_vykonavecd = mysql_query ("SELECT vydannya.title, vydannya.vyd, vydannya.rik, vydavnyk.title AS vydavnyk FROM vydannya, vydavnyk WHERE vydannya.id=$vydannya AND vydannya.vydavnyk = vydavnyk.id",$db);
  verification_query_2($result_vykonavecd);
  $myrow_vykonavecd = mysql_fetch_array ($result_vykonavecd);
}

if (isset($myrow['comment']))
{
  $comment = $myrow['comment'];
  $result_comment = mysql_query ("SELECT * FROM comment WHERE id = $comment", $db);
  verification_query($result_comment);
  $result_comment = mysql_fetch_array ($result_comment);
}

?>
<!DOCTYPE html>
<html lang="uk">
  <head>
    <link rel="canonical" href="https://pisnya.org.ua/kompozycija.php?id=<?php echo $id ?>">
    <?php include("settings/script-google-analytics.php");?>
    <meta charset="<?php include("settings/charset.php"); ?>">
    <title><?php echo $myrow_vykonavec1['title']." - ".$myrow['title']; ?> / текст пісні та відео до композиції</title>
    <meta name="description" content='Проект "Українська пісня" представляє: <?php echo $myrow_vykonavec1['title']; ?> з композицією "<?php echo $myrow['title']; ?>", текст пісні та відео до композиції, інформацію про авторів та виконавців.'>
    <meta name="keywords" content="<?php echo $myrow['title'].", ".$myrow_vykonavec1['name']; ?>">
    <?php include("blocks/head.php");?>
    <?php include("settings/script-google-adsense.php");?>
  </head>
  <body>
    <header class="page-header">
      <div class="page-header__wrapper-top">
        <?php include("blocks/header__top.php");?>
      </div>
      <nav class="site-nav site-nav--closed site-nav--nojs">
        <button class="site-nav__toggle" type="button"><span class="visually-hidden">Відкрити меню</span></button>
        <ul class="site-nav__list site-list">
          <?php include("blocks/header__nav.php");?>
        </ul>
      </nav>
    </header>
    <div class="main-wrapper">
      <aside class="left-column">
        <?php include("blocks/left.php");?>
      </aside>
      <main class="page-main">
        <?php include("blocks/main__composition.php");?>
      </main>
      <aside class="right-column">
        <?php include("blocks/right.php");?>
      </aside>
    </div>
    <footer class="page-footer">
      <div class="page-footer__wrapper">
        <?php include("blocks/footer.php");?>
      </div>
    </footer>
    <?php include("blocks/script.php");?>
  </body>
</html>