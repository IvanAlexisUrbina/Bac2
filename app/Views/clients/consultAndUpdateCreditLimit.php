<?php foreach ($company as $c) { ?>
    <div class="container">
        <h1>Actualizar Límite Crediticio</h1>
        <form action="<?= Helpers\generateUrl("Clients","Clients","UpdateLimitCredit") ?>" method="POST">
            <div class="form-group p-2">
                <label for="empresa">Empresa:</label>
                <input type="text" class="form-control" value="<?= $c['c_name'] ?>" readonly>
                <input type="hidden" name="c_id" value="<?= $c['c_id'] ?>">
            </div>
            <?php if (!empty($c['LimitCredit'])): ?>
                <div class="form-group p-2">
                    <label for="limite-crediticio">Límite Crediticio:</label>
                    <label class="form-control"><?= number_format($c['LimitCredit'][0]['credit_limit'], 0, '.', ',') ?></label>
                </div>
            <?php endif; ?>

            <div class="form-group p-2">
                <label for="nuevo-limite">Nuevo Límite Crediticio:</label>
                <input type="number" class="form-control" name="credit_limit_new">
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
<?php } ?>
