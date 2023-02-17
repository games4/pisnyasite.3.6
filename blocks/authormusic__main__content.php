<?php 
$result_composition = mysql_query ("SELECT kompozycija.id, kompozycija.title, vykonavec.title AS vykonavec FROM view, kompozycija, tvir, vykonavec WHERE view.kompozycija = kompozycija.id AND kompozycija.tvir = tvir.id AND tvir.avtor_muzyky = $id AND kompozycija.vykonavec1 = vykonavec.id ORDER BY kompozycija.title", $db);
verification_query_2($result_composition);

echo '<ul class="compositions__list">';
while ($myrow_composition = mysql_fetch_array($result_composition))
{
  echo '
    <li class="compositions__item">
      <a class="compositions__link" href="kompozycija.php?id='.$myrow_composition["id"].'">
        <span><b class="compositions__title">'.$myrow_composition["title"].' - '.$myrow_composition["vykonavec"].'</b></span>
      </a>
    </li>';
}
echo '
  </ul>
  ';

$result_subjects = mysql_query ("SELECT subject.id, subject.title FROM avtor_muzyky_sklad, subject WHERE avtor_muzyky_sklad.avtor_muzyky = $id AND avtor_muzyky_sklad.subject = subject.id", $db);
verification_query_2($result_subjects);

echo '<p class="composition__subject">';
if (mysql_num_rows($result_subjects) > 0)
{
  echo '<span>Дивитись також: </span>';
  while ($myrow_subjects = mysql_fetch_array($result_subjects))
  {
    echo '<a class="authors__link" href="subject.php?id='.$myrow_subjects["id"].'">'.mb_ucfirst($myrow_subjects["title"]).'</a> ';
  }
}
echo '</p>';
?>