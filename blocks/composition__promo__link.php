        <section class="composition__promo promo">
          <div class="promo__icon">
            <a href="#composition">
              <?php 
                $img_promo = $myrow['img_promo'];
                if ($img_promo == "")
                {
                //  echo '<img src="img/promo_day-song.png" width="100" height="100" alt="Промо '.$myrow['title'].' - '.$myrow_vykonavec['title'].'">';
                  echo '<img src="img/promo_day-song.png" width="100" height="100" alt="Промо '.$myrow['header'].'">';
                }
                else
                {
                //  echo '<img src="img/'.$img_promo.'" width="100" height="100" alt="Промо '.$myrow['title'].' - '.$myrow_vykonavec['title'].'">';
                  echo '<img src="img/'.$img_promo.'" width="100" height="100" alt="Промо '.$myrow['header'].'">';
                }
              ?>
            </a>
          </div>
          <h2 class="promo__title">
            <a href="#composition">
              <!--<span class="promo__composition"><?php // echo $myrow['title']; ?> - <?php // echo $myrow_vykonavec['title']; ?></span><br>-->
              <span class="promo__composition"><?php echo $myrow['header']; ?></span><br>
              <span class="promo__authors">Текст пісні та відео до композиції</span>
            </a>
          </h2>
        </section>