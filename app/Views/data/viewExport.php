
<div class="container">
    <h1>Exportar Artículos</h1>
    <form action="<?php echo Helpers\generateUrl("Data","Data","ExportArticlesExe")?>" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="archivo">Selecciona un archivo Excel:</label>
        <input type="file" class="form-control-file" name="archivo" id="archivo">
      </div>
      <button type="submit" class="btn btn-primary">Importar</button>
    </form>
  </div>
