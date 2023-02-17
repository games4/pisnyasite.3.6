<?php
if (isset($vykonavec))
{ 
  $result_composition = mysql_query ("SELECT kompozycija.id, kompozycija.title FROM view, kompozycija WHERE kompozycija.vykonavec1 = $vykonavec AND view.kompozycija = kompozycija.id" , $db);
  verification_query_2($result_composition);
  
  echo '  <ul class="compositions__list">';
  while ($myrow_composition = mysql_fetch_array ($result_composition))
  {
    echo '
      <li class="compositions__item">
        <a class="compositions__link" href="kompozycija.php?id='.$myrow_composition["id"].'">
          <span><b class="compositions__title">'.$myrow_composition["title"].'</b></span>
        </a>
      </li>
      ';
  }
echo '
    </ul>
    ';
  
  echo '  <ul class="compositions__list">';
  $result_composition = mysql_query ("SELECT kompozycija.id, kompozycija.title FROM view, kompozycija WHERE kompozycija.vykonavec2 = $vykonavec AND view.kompozycija = kompozycija.id", $db);
  verification_query_2($result_composition);

  while ($myrow_composition = mysql_fetch_array ($result_composition))
  {
    echo '
      <li class="compositions__item">
        <a class="compositions__link" href="kompozycija.php?id='.$myrow_composition["id"].'">
          <span><b class="compositions__title">'.$myrow_composition["title"].'</b></span>
        </a>
      </li>
      ';
  }
echo '
    </ul>
    ';
  
  $result_subjects = mysql_query ("SELECT subject.id, subject.title FROM vykonavec_sklad, subject WHERE vykonavec_sklad.vykonavec = $id AND vykonavec_sklad.subject = subject.id", $db);
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
  else
    {
      echo '<span>'.mb_ucfirst($myrow["title"]).'</span>';
    }
  echo '</p>';
}
else
{
  $result_composition = mysql_query ("SELECT kompozycija.id, kompozycija.title FROM view, kompozycija WHERE kompozycija.vykonavec1 = $vykonavec1 AND kompozycija.vykonavec2 = $vykonavec2 AND view.kompozycija = kompozycija.id",$db);
  
  echo '  <ul class="compositions__list">';
  while ($myrow_composition = mysql_fetch_array ($result_composition))
  {
    echo '
      <li class="compositions__item">
        <a class="compositions__link" href="kompozycija.php?id='.$myrow_composition["id"].'">
          <span><b class="compositions__title">'.$myrow_composition["title"].'</b></span>
        </a>
      </li>
      ';
  }
echo '
    </ul>
    ';
  
  $result_vykonavec1 = mysql_query ("SELECT * FROM vykonavec WHERE id = $vykonavec1", $db);
  verification_query($result_vykonavec1);
  $myrow_vykonavec1 = mysql_fetch_array ($result_vykonavec1);
  
  $result_vykonavec2 = mysql_query ("SELECT * FROM vykonavec WHERE id = $vykonavec2", $db);
  verification_query($result_vykonavec2);
  $myrow_vykonavec2 = mysql_fetch_array ($result_vykonavec2);
  
  echo '
  <p class="composition__subject">
    <a href="artist.php?id='.$myrow_vykonavec1['id'].'"><b>'.mb_ucfirst($myrow_vykonavec1['title']).'</b></a>
    <a href="artist.php?id='.$myrow_vykonavec2['id'].'"><b>'.mb_ucfirst($myrow_vykonavec2['title']).'</b></a>
  </p>';
}
?>