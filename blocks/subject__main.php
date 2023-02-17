<h1 class="page__title"><?php echo mb_ucfirst($myrow["title"]); ?></h1>
<?php if (isset($myrow['description'])) { echo '<p class="page__description">'.$myrow['description'].'</p>' ;} ?>
<?php include("subject__main__content__performer.php"); ?>
<?php include("subject__main__content__authorwords.php"); ?>
<?php include("subject__main__content__authormusic.php"); ?>
<div class="page-main__container">
  <div class="page-main__banner none"></div>
  <div class="page-main__banner--midle">
    <?php include("banner__main__middle.php"); ?>
  </div>
</div>
