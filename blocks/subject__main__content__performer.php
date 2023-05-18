<?php
$result_performer = mysql_query ("SELECT vykonavec.id, vykonavec.title FROM vykonavec, vykonavec_sklad WHERE vykonavec_sklad.subject = $id AND vykonavec.id = vykonavec_sklad.vykonavec", $db);
verification_query_2($result_performer);

if (mysql_num_rows($result_performer) > 0)
{
  while ($myrow_performer = mysql_fetch_array ($result_performer))
  {
    echo '
    <section class="compositions">
      <h2 class="composition__subject">
        <span class="page__label">Виконавець: </span> 
        <a class="performer" href="artist.php?id='.$myrow_performer["id"].'">'.$myrow_performer["title"].'</a>
      </h2>';
    echo '
      <p class="list__caption">#Композиції</p>
      ';
    $id_performer1 = $myrow_performer['id'];
    $result_composition = mysql_query ("SELECT DISTINCT kompozycija.id, kompozycija.title, kompozycija.name FROM view, kompozycija WHERE kompozycija.vykonavec1 = $id_performer1 AND view.kompozycija = kompozycija.id",$db);
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
    }
    $id_performer2 = $myrow_performer['id'];
    $result_composition = mysql_query ("SELECT DISTINCT kompozycija.id, kompozycija.title FROM view, kompozycija WHERE kompozycija.vykonavec2 = $id_performer2 AND view.kompozycija = kompozycija.id",$db);
    verification_query_2($result_composition);
    while ($myrow_composition = mysql_fetch_array ($result_composition))
    {
      echo '
        <li class="compositions__item">
          <a class="compositions__link" href="kompozycija.php?id='.$myrow_composition["id"].'">
            <span><b class="compositions__title">'.$myrow_composition["title"].'</b></span>
          </a>
        </li>';
    }
    echo '
      </ul>
      <p class="the-end">* * *</p>
    </section>';
  }
}
?>