<?php 
$result_composition = mysql_query ("SELECT DISTINCT vydannya.title AS vydannya, kompozycija.id, kompozycija.title, kompozycija.header, vykonavec.title AS vykonavec FROM vydannya, kompozycija, view, vykonavec WHERE vydannya.id = $id AND kompozycija.vydannya = vydannya.id AND view.kompozycija = kompozycija.id AND kompozycija.vykonavec1 = vykonavec.id ORDER BY kompozycija.title", $db);
verification_query_2($result_composition);

echo '<ul class="compositions__list">';
while ($myrow_composition = mysql_fetch_array($result_composition))
{
  echo '
      <li class="compositions__item">
        <a class="compositions__link" href="kompozycija.php?id='.$myrow_composition["id"].'">
          <span><b class="compositions__title">'.$myrow_composition["header"].'</b></span>
        </a>
      </li>';
}
echo '
    </ul>
';
?>