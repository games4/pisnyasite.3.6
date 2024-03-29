        <h1 class="visually-hidden">Сайт "Українська пісня" - тільки найкраща відчизняна музика, тількі найцікавіші новини.</h1>
<?php 
  if (isset($myrow['povidomlennya'])) 
  {
        include("composition__notes.php");
        include("composition__promo__link.php");
  }
  else 
  {
        include("composition__promo.php");
  }
?>
        <div class="section__caption">#Наша сімка </div>
        <section class="compositions">
          <h3 class="visually-hidden">Cімка попередніх комозицій</h3>
          <?php include("compositions__list-seven.php"); ?>
          <p class="the-end">* * *</p>
        </section>
        <div class="page-main__container">
          <div class="page-main__banner none"></div>
          <div class="page-main__banner--midle">
            <?php include("banner__main__middle.php"); ?>
          </div>
        </div>
        <div class="section__caption">#Композиція</div>
        <article class="composition" id="composition">
          <div class="composition__video">
            <?php include("composition__video.php"); ?>
          </div>
          <header class="composition__info">
            <?php include("composition__info.php"); ?>
          </header>
<?php 
  if (isset($comment)) 
  {
          include("composition__main__comment.php");
  }
?>
          <section class="composition__lyric lyric">
            <h3 class="lyric__title"><?php echo $myrow['title']; ?></h3>
            <?php if ( trim($myrow_tvir['ftext']) == "" ) { echo '<p>'.nl2br(trim($myrow_tvir['text'])).'</p>' ;} else { echo trim($myrow_tvir['ftext']) ;} ?>
            <p class="the-end">* * *</p>
          </section>
          <?php include("composition__release.php"); ?>
        </article>