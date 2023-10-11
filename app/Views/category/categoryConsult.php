<div class="container">
    <div class="col-md-12 d-flex">
        <div class="col-md-6 p-2">
            <form action="<?= Helpers\generateUrl("Category","Category","insertCategory")?>" method="post">
                <h1 class="tracking-in-expand">Categorias <i class="fa-solid fa-clipboard-list"></i></h1>

                <div class="col-md-12">
                    <label for="">Nombre de la categoria</label>
                    <input type="text" class="form form-control" name="cat_name">
                </div>
                <div class="col-md-12">
                    <label for="">Descripción de la categoria</label>
                    <textarea type="text" class="form form-control" name="cat_desc"></textarea>
                </div>

                <div class="col-md-6 mt-3">
                    <button class="btn btn-outline-primary">
                        Registrar categoria
                    </button>
                </div>

            </form>
        </div>
    </div>

    <hr>
    <div class="table-responsive">
        <table class="table DataTable slide-in-top table-hover table-secondary table-striped">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Subcategorias</th>
                    <th>Acciones</th>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="table-light">
                <?php foreach ($categories as $cate): ?>
                <tr>
                    <td><?= $cate['cat_id'] ?></td>
                    <td><?= $cate['cat_name'] ?></td>
                    <td><?= $cate['cat_desc'] ?></td>
                    <td>
                        <?php if (count($cate['subcategories']) > 0): ?>
                        <?php foreach ($cate['subcategories'] as $subcat): ?>
                        <?= $subcat['sbcat_name'] ?>,
                        <?php endforeach; ?>
                        <?php else: ?>
                        Vacío
                        <?php endif; ?>
                    </td>
                    <td>
                        <button class="btn btn-outline-primary subcatView"
                            data-url="<?= Helpers\generateUrl("Category","Category","createSubcategoryModal",[],"ajax") ?>"
                            data-id="<?= $cate['cat_id'] ?>">Crear subcategorías</button>
                        <button class="btn btn-outline-primary">Editar</button>
                        <button class="btn btn-outline-danger">Eliminar</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div>