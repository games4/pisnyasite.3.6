<h1 class="page__title"><span class="page__label">Автор слів: </span><?php echo ' '.mb_ucfirst($myrow["title"]); ?></h1>
<? 
if ($myrow_set['description'] != "")
{
  echo '<p class="page__description">'.$myrow_set['description'].'</p>';
}
?>
<div class="section__caption">#Композиції</div>
<section class="compositions">
  <?php include("authorwords__main__content.php"); ?>
  <p class="the-end">* * *</p>
</section>
<div class="page-main__container">
  <div class="page-main__banner none"></div>
  <div class="page-main__banner--midle">
    <?php include("banner__main__middle.php"); ?>
  </div>
</div>