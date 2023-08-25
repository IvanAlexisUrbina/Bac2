<?php foreach ($article as $ar) { ?>

<div class="container p-4">
  <div class="row">
    <div class="col-md-6">
      <img src="<?= $ar['ar_img_url'] ?>" alt="<?= $ar['ar_name'] ?>" class="img-fluid">
    </div>
    <div class="col-md-6">
      <h1><?= $ar['ar_name'] ?></h1>
      <p class="lead"><?= $ar['ar_desc'] ?></p>
      <hr>
      <h3>Precio: $<?= $priceArticle[0]['p_value'] ?></h3>
      <p>Cantidad disponible: <?= $stockArticle[0]['stock_Quantity'] ?></p>
      <a href="<?php echo $ar['ar_data_url'] ?>" target="_blank" class="btn btn-primary btn-lg">Ficha técnica</a>
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-md-6">
      <h4>Características:</h4>
      <?php
      $characteristicsList = explode(';',  $ar['ar_characteristics']);
      echo '<ul>';
      foreach ($characteristicsList as $characteristic) {
          echo '<li>' . $characteristic . '</li>';
      }
      echo '</ul>';
      ?>
    </div>
    <div class="col-md-6">
      <h4>Opiniones:</h4>
      <p>No hay opiniones aún.</p>
      <!-- <a href="#" class="btn btn-outline-primary">Escribe una opinión</a> -->
    </div>
  </div>
</div>

<?php } ?>
