<?php 
include_once("blocks/func.inc.php");
include("blocks/db.php");

$page = 'pisni';

if (isset($_GET['id'])) {$id = $_GET['id'];	if ($id == '') {unset($id);}} 

/* Безпека. Перевіряємо, чи є змінна, що передається, числом */
if (!preg_match("|^[\d]+$|", $id)) { exit ("<p>Неверный формат запроса! Проверьте URL!</p>"); }

//if (isset($_GET['id_vk'])) {$id_vk = $_GET['id_vk']; $id = $id_vk; if ($id_vk == '') {unset($id_vk);}}
//if (isset($_GET['id_as'])) {$id_as = $_GET['id_as']; $id = $id_as; if ($id_as == '') {unset($id_as);}}
//if (isset($_GET['id_am'])) {$id_am = $_GET['id_am']; $id = $id_am; if ($id_am == '') {unset($id_am);}}

$result = mysql_query ("SELECT * FROM subject WHERE id = $id",$db);
verification_query($result);
$myrow = mysql_fetch_array ($result);

?>
<!DOCTYPE html>
<html lang="uk">
  <head>
    <?php include("settings/script-google-analytics.php");?>
    <meta charset="<?php include("settings/charset.php"); ?>">
    <title><?php echo $myrow['title']; ?> / композиції</title>
    <meta name="description" content="<?php echo $myrow['description']; ?>">
    <meta name="keywords" content="<?php echo $myrow['keywords']; ?>">
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
        <?php include("blocks/subject__main.php");?>
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