<?php 
include_once("blocks/func.inc.php");
include("blocks/db.php");

$page = 'kompozytory';

if (isset($_GET['id'])) {$id = $_GET['id'];	if ($id == '') {unset($id);}} 

/* Безпека. Перевіряємо, чи є змінна, що передається, числом */
if (!preg_match("|^[\d]+$|", $id)) { exit ("<p>Неверный формат запроса! Проверьте URL!</p>"); }

$result = mysql_query ("SELECT * FROM avtor_muzyky WHERE id = $id",$db);
verification_query($result);
$myrow = mysql_fetch_array ($result);

?>
<!DOCTYPE html>
<html lang="uk">
  <head>
    <?php include("blocks/script__google-analytics.php");?>
    <meta charset="<?php include("settings/charset.php"); ?>">
    <title>Автор музики: <?php echo $myrow['title']; ?></title>
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
        <?php include("blocks/authormusic__main.php");?>
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