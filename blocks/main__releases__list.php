<?php 
$result_release = mysql_query ("SELECT DISTINCT vyd FROM vydannya ORDER BY vyd", $db); 
verification_query_2($result_release);

echo '<ul class="types__list">';
while ($myrow_release = mysql_fetch_array($result_release)) 
{
  $release = $myrow_release["vyd"];
  if ($release != "")
  {
    $result_k = mysql_query ("SELECT vydannya.id, vydannya.title, vydannya.vyd, vydannya.rik, vydavnyk.title AS vydavnyk FROM vydannya, vydavnyk WHERE vydannya.vydavnyk = vydavnyk.id AND vydannya.vyd = '$release' AND vydannya.vyd != '' ORDER BY vydannya.title",$db); 
    verification_query_2($result_k);
    echo '
    <li>
      <h2 class="">'.$release.'</h2>
      <ul class="releases__list">';
    while ($myrow_k = mysql_fetch_array($result_k))
    {
      echo '
        <li class="release__item">
          <a class="relese__link" href="release.php?id='.$myrow_k["id"].'">'.$myrow_k["title"].' / '.$myrow_k["vydavnyk"].', '.$myrow_k["rik"].' рік'.'</a>
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