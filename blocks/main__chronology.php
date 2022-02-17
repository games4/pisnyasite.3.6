<h1 class="page__title"><?php echo $myrow_set['title']; ?></h1>
<p class="page__description"><?php echo $myrow_set['description']; ?></p>
<div class="page-main__container">
  <div class="page-main__banner none"></div>
  <div class="page-main__banner--midle">
    <?php include("banner__main__middle.php"); ?>
  </div>
</div>
<div class="section__caption">#<?php echo $myrow_set['title_s']; ?></div>
<section class="compositions">
  <!-- list -->
  <ul class="compositions__list">
    <?php include("main__chronology__list.php");?>
  </ul>
  <p class="the-end">* * *</p>
  <!-- /list -->
</section>