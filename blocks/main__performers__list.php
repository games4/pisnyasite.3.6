<?php 
$result_k = mysql_query ("SELECT id, title FROM vykonavec ORDER BY title",$db); 
verification_query_2($result_k);

echo '<ul class="names__list">';
while ($myrow_k = mysql_fetch_array($result_k))
{
  $myrow_k_title = $myrow_k["title"];
  $myrow_k_title = mb_ucfirst($myrow_k_title);
  echo '
    <li class="names__item">
      <a class="names__link" href="artist.php?id='.$myrow_k["id"].'">
        <span><b class="names__title">'.$myrow_k_title.'</b></span>
      </a>
    </li>';
  //echo '<p class="link_sp"><a href="artist.php?id='.$myrow_k["id"].'">'.ucfirst($myrow_k["title"]).'</a></p>';
  //echo '<p class="link_sp"><a href="artist.php?id='.$myrow_k["id"].'">'.$myrow_k["title"].'</a></p>';
}
echo '
  </ul>
  ';
?>
