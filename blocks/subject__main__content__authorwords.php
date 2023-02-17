<?php
$result_authorwords = mysql_query ("SELECT avtor_sliv.id, avtor_sliv.title FROM avtor_sliv, avtor_sliv_sklad WHERE avtor_sliv_sklad.subject = $id AND avtor_sliv.id = avtor_sliv_sklad.avtor_sliv", $db);
verification_query_2($result_authorwords);

if (mysql_num_rows($result_authorwords) > 0)
{
  while ($myrow_authorwords = mysql_fetch_array ($result_authorwords))
  {
  echo '
    <section class="compositions">
      <h2 class="composition__subject">
        <span class="page__label">Автор текстів </span> 
        <a class="performer" href="avtor_sliv.php?id='.$myrow_authorwords["id"].'">'.mb_ucfirst($myrow_authorwords["title"]).'</a>
      </h2>';
    echo '
      <p class="list__caption">#Композиції</p>
      ';
    $id_avtor_sliv = $myrow_authorwords['id'];
    $result_composition = mysql_query ("SELECT kompozycija.id, kompozycija.title, kompozycija.vykonannya FROM view, kompozycija, tvir WHERE tvir.avtor_sliv = $id_avtor_sliv AND kompozycija.tvir = tvir.id AND view.kompozycija = kompozycija.id",$db);
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