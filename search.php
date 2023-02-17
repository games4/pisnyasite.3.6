<?php 
include_once("blocks/func.inc.php");
include("blocks/db.php");
?>
<!DOCTYPE html>
<html lang="uk">
  <head>
    <?php include("blocks/script__google-analytics.php");?>
    <meta charset="<?php include("settings/charset.php"); ?>">
    <title>Результати пошуку по сайту "Українська пісня"</title>
    <meta name="robots" content="noindex">
    <meta name="description" content="Сторінка результатів пошуку по сайту https://pisnya.org.ua">
    <meta name="keywords" content="<?php // echo $myrow['keywords']; ?>">
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
        <?php include("blocks/search__main.php");?>
        <?php // include("blocks/banner__main.php");?>
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