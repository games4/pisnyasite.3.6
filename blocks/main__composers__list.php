<?php
$result_k = mysql_query ("SELECT id, name FROM avtor_muzyky ORDER BY name",$db); 
verification_query_2($result_k);

echo '<ul class="names__list">';
while ($myrow_k = mysql_fetch_array($result_k))
{
  echo '
    <li class="names__item">
      <a class="names__link" href="avtor_muzyky.php?id='.$myrow_k["id"].'">
        <span><b class="names__title">'.$myrow_k["name"].'</b></span>
      </a>
    </li>';
}
echo '
  </ul>
  ';
?>