<?php
$result_authormusic = mysql_query ("SELECT avtor_muzyky.id, avtor_muzyky.title FROM avtor_muzyky, avtor_muzyky_sklad WHERE avtor_muzyky_sklad.subject = $id AND avtor_muzyky.id = avtor_muzyky_sklad.avtor_muzyky", $db);
verification_query_2($result_authormusic);

if (mysql_num_rows($result_authormusic) > 0)
{
  while ($myrow_authormusic = mysql_fetch_array ($result_authormusic))
  {
  echo '
    <section class="compositions">
      <h2 class="composition__subject">
        <span class="page__label">Автор музики </span> 
        <a class="performer" href="avtor_sliv.php?id='.$myrow_authormusic["id"].'">'.mb_ucfirst($myrow_authormusic["title"]).'</a>
      </h2>
      ';
    echo '<p class="list__caption">#Композиції</p>
      ';
    $id_authormusic = $myrow_authormusic['id'];
    $result_composition = mysql_query ("SELECT kompozycija.id, kompozycija.title, kompozycija.vykonannya FROM view, kompozycija, tvir WHERE tvir.avtor_muzyky = $id_authormusic AND kompozycija.tvir = tvir.id AND view.kompozycija = kompozycija.id",$db);
    verification_query_2($result_composition);
    echo '<ul class="compositions__list">';
    while ($myrow_composition = mysql_fetch_array ($result_composition))
    {
      echo '
        <li class="compositions__item">
          <a class="compositions__link" href="kompozycija.php?id='.$myrow_composition["id"].'">
            <span><b class="compositions__title">'.$myrow_composition["title"].'</b></span>
          </a>
        </li>';
    //echo '<li class="compositions__item"><a href="kompozycija.php?id='.$myrow_composition["id"].'">'.$myrow_composition["title"]." - ".$myrow_composition["vykonannya"].'</a></li>';
    }
    echo '
      </ul>
      <p class="the-end">* * *</p>
    </section>';
  }
}
?>