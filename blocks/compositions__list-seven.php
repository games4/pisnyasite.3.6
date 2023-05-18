<?php
$num = $myrow["num"]; 
$count = mysql_query ("SELECT num FROM view WHERE num < $num ORDER BY date DESC, num DESC");
verification_query_2($count);

echo '<ul class="compositions__list">';
if (mysql_num_rows($count) < 7)
  {
    $result_k = mysql_query ("SELECT kompozycija.id, kompozycija.title, kompozycija.header, view.date, vykonavec.title AS vykonavec FROM view, kompozycija, vykonavec WHERE kompozycija.id = view.kompozycija AND kompozycija.vykonavec1 = vykonavec.id ORDER BY view.date, view.num LIMIT 7",$db); 
    verification_query_2($result_k);
    
    while ($myrow_k = mysql_fetch_array($result_k))
    {
      echo '
          <li>
            <a class="compositions__link" href="kompozycija.php?id='.$myrow_k["id"].'">
              <time class="compositions__date" datetime="'.$myrow_k["date"].'">'.date("d-m-Y", strtotime($myrow_k["date"])).'</time>
              <b class="compositions__title">'.$myrow_k["header"].'</b>
            </a>
          </li>';
    }
  }
else
  {
    $result_k = mysql_query ("SELECT kompozycija.id, kompozycija.title, kompozycija.header, view.date, vykonavec.title AS vykonavec FROM view, kompozycija, vykonavec WHERE kompozycija.id = view.kompozycija AND kompozycija.vykonavec1 = vykonavec.id AND view.num < $num ORDER BY view.date DESC, view.num DESC LIMIT 7",$db); 
    verification_query_2($result_k);
                 
    while ($myrow_k = mysql_fetch_array($result_k))
    {
      echo '
          <li>
            <a class="compositions__link" href="kompozycija.php?id='.$myrow_k["id"].'">
              <span><time class="compositions__date" datetime="'.$myrow_k["date"].'">'.date("d-m-Y", strtotime($myrow_k["date"])).'</time></span>
              <span><b class="compositions__title">'.$myrow_k["header"].'</b></span>
            </a>
          </li>';
    }
  }
echo '
  </ul>
';
?>