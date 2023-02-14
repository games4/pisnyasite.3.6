<?php 
include_once("blocks/func.inc.php");
include("blocks/db.php");

$page = 'index';

$result_set = mysql_query ("SELECT * FROM settings WHERE page = 'index'", $db);
verification_query($result_set);
$myrow_set = mysql_fetch_array ($result_set);

$result = mysql_query ("SELECT * FROM view, kompozycija WHERE view.kompozycija = kompozycija.id ORDER BY view.date DESC, view.num DESC", $db);
verification_query($result);
$myrow = mysql_fetch_array ($result);

if (isset($myrow["povidomlennya"]))
{
  $notes = $myrow["povidomlennya"];
  //echo "<BR>".$notes;
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
$result_tvir = mysql_query ("SELECT * FROM tvir WHERE id = $tvir", $db);
verification_query($result_tvir);
$myrow_tvir = mysql_fetch_array ($result_tvir);

$avtor_muzyky = $myrow_tvir['avtor_muzyky'];
$result_am = mysql_query ("SELECT title FROM avtor_muzyky WHERE id = $avtor_muzyky" ,$db);
verification_query($result_am);
$myrow_am = mysql_fetch_array ($result_am);

$avtor_sliv = $myrow_tvir['avtor_sliv'];
$result_as = mysql_query ("SELECT title FROM avtor_sliv WHERE id = $avtor_sliv", $db);
verification_query($result_as);
$myrow_as = mysql_fetch_array ($result_as);

/* $result = mysql_query ("SELECT title, meta_d, meta_k, text FROM settings WHERE page = 'index'",$db);
verification_query($result);
$myrow = mysql_fetch_array ($result);
 */
?>

<!DOCTYPE html>
<html lang="uk">
  <head>
    <?php include("blocks/script__google-analytics.php");?>
    <meta charset="utf-8">
    <meta name="google-site-verification" content="<?php include("blocks/content__google-site-verification.php");?>">
    <title><?php echo $myrow_vykonavec1['title']." - ".$myrow['title']; ?> / текст пісні та відео до композиції - проект Українська пісня </title>
    <meta name="description" content="<?php echo $myrow_set['meta_d']; ?>">
    <meta name="keywords" content="<?php echo $myrow_set['meta_k']; ?>">
    <?php include("blocks/head.php");?>
    <?php include("blocks/head__script__adsense.php");?>
  </head>
  <body class="start-page">
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
        <?php include("blocks/main__index.php");?>
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
