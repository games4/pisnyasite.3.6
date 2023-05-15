<?php 
include_once("blocks/func.inc.php");
include("blocks/db.php");

$page = 'kompozytory';

$result_set = mysql_query ("SELECT * FROM settings WHERE page='kompozytory'",$db);
verification_query($result_set);
$myrow_set = mysql_fetch_array ($result_set);

?>
<!DOCTYPE html>
<html lang="uk">
  <head>
    <?php include("settings/script-google-analytics.php");?>
    <meta charset="<?php include("settings/charset.php"); ?>">
    <title><?php echo $myrow_set['title']; ?></title>
    <meta name="description" content="<?php echo $myrow_set['description']; ?>">
    <meta name="keywords" content="<?php echo $myrow_set['keywords']; ?>">
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
        <?php include("blocks/main__composers.php");?>
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