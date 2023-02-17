<?php
include_once("blocks/func.inc.php");
include("blocks/db.php");
if (isset($_GET['id'])) {$id = $_GET['id']; if ($id == '') {unset($id);}} 

$page = 'vykonavci';

$result_set = mysql_query ("SELECT * FROM settings WHERE page='artist'", $db);
verification_query($result_set);
$myrow_set = mysql_fetch_array ($result_set);
  
//  $result = mysql_query ("SELECT * FROM kompozycija WHERE id = $id", $db);
//  verification_query($result);
//  $myrow = mysql_fetch_array ($result);

$vykonavec = $id;
$vykonavec1 = $id1;
$vykonavec2 = $id2;

if (isset($vykonavec)) 
{
  $result_vykonavec = mysql_query ("SELECT * FROM vykonavec WHERE id = $vykonavec", $db);
  verification_query($result_vykonavec);
  $myrow_vykonavec = mysql_fetch_array ($result_vykonavec);
  
  $performance = mb_ucfirst($myrow_vykonavec['title']);
} 
else 
{
  $result_vykonavec1 = mysql_query ("SELECT * FROM vykonavec WHERE id = $vykonavec1", $db);
  verification_query($result_vykonavec1);
  $myrow_vykonavec1 = mysql_fetch_array ($result_vykonavec1);

  $result_vykonavec2 = mysql_query ("SELECT * FROM vykonavec WHERE id = $vykonavec2", $db);
  verification_query($result_vykonavec2);
  $myrow_vykonavec2 = mysql_fetch_array ($result_vykonavec2);

  $performance = mb_ucfirst($myrow_vykonavec1['title']." та ".$myrow_vykonavec2['title']);
}
  
  // if ($myrow['vykonannya'] != "")
  // {
    // $performance = mb_ucfirst($myrow['vykonannya']);
  // }
  // else
  // {
    // if ($myrow['vykonavec2'] == "")
    // {
      // $result_vykonavec1 = mysql_query ("SELECT * FROM vykonavec WHERE id = $vykonavec1", $db);
      // verification_query($result_vykonavec1);
      // $myrow_vykonavec1 = mysql_fetch_array ($result_vykonavec1);
      
      // $performance = mb_ucfirst($myrow_vykonavec1['title']);
    // }
    // else
    // {
      // $result_vykonavec1 = mysql_query ("SELECT * FROM vykonavec WHERE id = $vykonavec1", $db);
      // verification_query($result_vykonavec1);
      // $myrow_vykonavec1 = mysql_fetch_array ($result_vykonavec1);

      // $result_vykonavec2 = mysql_query ("SELECT * FROM vykonavec WHERE id = $vykonavec2", $db);
      // verification_query($result_vykonavec2);
      // $myrow_vykonavec2 = mysql_fetch_array ($result_vykonavec2);
      
      // $performance = mb_ucfirst($myrow_vykonavec1['title']." та ".$myrow_vykonavec2['title']);
    // }
  // }

?>
<!DOCTYPE html>
<html lang="uk">
  <head>
    <?php include("blocks/script__google-analytics.php");?>
    <meta charset="<?php include("settings/charset.php"); ?>">
    <title>Виконавець: <?php echo $performance; ?></title>
    <meta name="description" content="<?php echo $myrow['description']; ?>">
    <meta name="keywords" content="<?php echo $myrow['keywords']; ?>">
    <?php include("blocks/head.php");?>
    <?php include("blocks/head__script__adsense.php");?>
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
        <?php include("blocks/artist__main.php");?>
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