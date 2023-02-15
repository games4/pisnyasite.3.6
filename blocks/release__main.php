<?php 
$result_publisher = mysql_query ("SELECT vydavnyk.id, vydavnyk.title, vydannya.vydavnyk FROM vydavnyk, vydannya WHERE vydannya.id = $id AND vydannya.vydavnyk = vydavnyk.id", $db);
verification_query_2($result_publisher);
$myrow_publisher = mysql_fetch_array ($result_publisher);

$result_performer = mysql_query ("SELECT vykonavec.id, vykonavec.title, vydannya.vykonavec FROM vykonavec, vydannya WHERE vydannya.id = $id AND vydannya.vykonavec = vykonavec.id", $db);
verification_query_2($result_performer);
$myrow_performer = mysql_fetch_array ($result_performer);
?>

<article class="release">
  <h1 class="page__title"><?php echo mb_ucfirst($myrow["header"]); ?></h1>
  <p class="section__caption">#Видання</p>
  <div class="release__picture">
    <?php if (isset($myrow['image'])) { echo '<img src="img/'.$myrow['image'].'" width="300" height="300">';} ?>
  </div>
  <section class="release__info">
    <h2 class="release__title"><?php echo $myrow['title']; ?> <span class="release__label">/ <?php echo $myrow['vyd']; ?></span></h2>
    <p class="releas__data"><span class="release__label">Рік: </span> <?php echo $myrow['rik']; ?></p>
    <p class="releas__data">
      <span class="release__label"><?php if (isset($myrow['vykonavec'])) { echo 'Виконавець: ';} else {$myrow['vyd'] ;} ?></span>
      <?php if (isset($myrow['vykonavec'])) { echo '<a class="release__link" href="artist.php?id='.$myrow_performer['id'].'">'.$myrow_performer['title'].'</a>';} ?>
    </p>
    <p class="releas__data">
      <span class="release__label">Видавець: </span>
      <?php // echo '<a class="release__link" href="publisher.php?id='.$myrow_publisher["id"].'">'.mb_ucfirst($myrow_publisher["title"]).'</a>'; ?>
      <?php echo mb_ucfirst($myrow_publisher["title"]); ?>
    </p>
    <?php if (isset($myrow['description'])) { echo '<p class="releas__data">'.$myrow['description'].'</p>' ;} ?>
  </section>
  <section class="release__compositions compositions">
    <p class="section__caption">#Композиції</p>
    <?php include("release__main__list.php"); ?>
    <div class="page-main__container">
      <div class="page-main__banner none"></div>
      <div class="page-main__banner--midle">
        <?php include("banner__main__middle.php"); ?>
      </div>
    </div>
    <p class="the-end">* * *</p>
  </section>
</article>