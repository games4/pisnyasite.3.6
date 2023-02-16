<?php 
$result_k = mysql_query ("SELECT kompozycija.id, video.title FROM view, kompozycija, video WHERE kompozycija.id = view.kompozycija AND video.id = kompozycija.video ORDER BY video.title",$db); 
verification_query_2($result_k);

echo '<ul class="compositions__list">';
while ($myrow_k = mysql_fetch_array($result_k))
{
  echo '
    <li class="compositions__item">
      <a class="compositions__link" href="kompozycija.php?id='.$myrow_k["id"].'">
        <span><b class="compositions__title">'.$myrow_k["title"].'</b></span>
      </a>
    </li>';
}
echo '
  </ul>
  ';
?>
