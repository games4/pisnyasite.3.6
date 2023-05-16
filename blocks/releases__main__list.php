<?php 
$result_release_type = mysql_query ("SELECT DISTINCT type, release_type.id, release_type.name FROM vydannya, release_type WHERE type = release_type.id ORDER BY type", $db); 
verification_query_2($result_release_type);

echo '<ul class="types__list">';
while ($myrow_release_type = mysql_fetch_array($result_release_type)) 
{
  $release_type_id = $myrow_release_type["type"];
  if ($release_type_id != "")
  {
    $result_vydannya = mysql_query ("SELECT DISTINCT vydannya.id, vydannya.title, vydannya.rik, vydavnyk.title AS vydavnyk FROM view, kompozycija, vydannya, vydavnyk WHERE view.kompozycija = kompozycija.id AND kompozycija.vydannya = vydannya.id AND vydannya.vydavnyk = vydavnyk.id AND vydannya.type = '$release_type_id' AND vydannya.type != '' ORDER BY vydannya.title", $db); 
    verification_query_2($result_vydannya);
    echo '
    <li>
      <h2 class="">'.$myrow_release_type["name"].'</h2>
      <ul class="releases__list">';
      while ($myrow_vydannya = mysql_fetch_array($result_vydannya))
      {
        echo '
        <li class="release__item">
          <a class="relese__link" href="release.php?id='.$myrow_vydannya["id"].'">'.$myrow_vydannya["title"].' / '.$myrow_vydannya["vydavnyk"].', '.$myrow_vydannya["rik"].' рік'.'</a>
        </li>';
      }
      echo '
      </ul>
    </li>';
  }
}
echo '
  </ul>
  ';
?>