<?php 
$result_composition = mysql_query ("SELECT vydannya.title AS vydannya, kompozycija.id, kompozycija.title, vykonavec.title AS vykonavec FROM vydannya, kompozycija, view, vykonavec WHERE vydannya.id = $id AND kompozycija.vydannya = vydannya.id AND view.kompozycija = kompozycija.id AND kompozycija.vykonavec1 = vykonavec.id ORDER BY kompozycija.title", $db);
verification_query_2($result_composition);

while ($myrow_composition = mysql_fetch_array($result_composition))
{
  echo '
    <li class="compositions__item">
      <a class="compositions__link" href="kompozycija.php?id='.$myrow_composition["id"].'">'.$myrow_composition["title"].' - '.$myrow_composition["vykonavec"].'</a>
    </li>
  ';
}
?>
