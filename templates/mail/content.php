<table class="container">
  <tr>
    <td>
      <table class="row">
        <tr>
          <td class="wrapper last">

            <table class="twelve columns">
              <tr>
                <td>
                  <p><?php echo $text ?></p>
                  <p>Nom : <?php echo $name ?></p>
                  <p>Email : <?php echo $sender ?></p>
                  <p>Tel : <?php echo $tel; ?></p>
                    <p>titre du bien à louer ou à visiter : <?php echo $title ;?></p>
                  <?php 
                  if(isset($url)){
                  ?>
                    <p>Url  : <a href="<?php echo $url ?>"> <?php echo $title ?></p>
                  <?php
                  }
                  ?>
                  <?php 
                  if(isset($date)){
                  ?>
                    <p>Date de visite souhaité  : <?php echo $date ;?></p>
                  <?php
                  }
                  ?>
                  <p></p>
                </td>
                <td class="expander"></td>
              </tr>
            </table>

          </td>
        </tr>
      </table>