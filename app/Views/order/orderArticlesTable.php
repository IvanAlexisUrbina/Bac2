<div class="container table-responsive">
  <table id="myTable"  class="DataTable text-center table align-middle slide-in-top table-hover">
    <thead>
      <tr>
        <th >Imagen</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Peso</th>
        <th>Color</th>
        <th>Cantidad</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($articles as $art) { ?>
        <tr>
          <td ><img src="<?= $art['ar_img_url']?>" alt="..." height="100"></td>
          <td><?= $art['ar_name']?></td>
          <td><?= $art['ar_desc']?></td>
          <td><?= $art['ar_measurement_value']?>kg</td>
          <?php foreach ($art['color'] as $color): ?>
          <td><?= $color['color_name']?></td>
          <?php endforeach; ?>
          <td><div style="display: flex; align-items: center;justify-content: space-evenly;">
          <input type="number" min="1"name="quantity" class="form form-control"id="" style="width:50%;"><button data-url="<?= Helpers\generateUrl("Order","Order","AddArticlesAjax",[],"ajax");?>"
                                        value="<?= $art['ar_id']?>" id="addArticles" class="btn btn-outline-success"><i class="fa-regular fa-square-plus"></i></button>
          </div></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

                                  