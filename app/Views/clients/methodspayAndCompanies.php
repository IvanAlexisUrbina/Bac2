<div class="container p-4">
    <h1 class="text-center">Agregar Métodos de Pago a una Empresa</h1>
    <form action="<?= Helpers\generateUrl("Clients", "Clients", "paymentMethodsCompany") ?>" method="POST">
        <div class="form-group text-center">
            <label for="empresa">Empresa:</label>
            <h3><?= $company[0]['c_name'] ?></h3>
            <input type="hidden" value="<?=$company[0]['c_id']?>" name="c_id">
        </div>
        <div class="form-group">
            <label>Métodos de Pago:</label>

            <?php foreach ($methodsPay as $m) { ?>
                <div class="form-check">
                    <?php
                    $isChecked = false;
                    foreach ($company[0]['payment_methods'] as $pm) {
                        if ($pm['payment_method_id'] === $m['payment_method_id']) {
                            $isChecked = true;
                            break;
                        }
                    }
                    ?>
                    <input type="checkbox" class="form-check-input" id="metodo<?= $m['payment_method_id'] ?>" name="method_pay[]" value="<?= $m['payment_method_id'] ?>" <?php if ($isChecked) echo 'checked'; ?>>
                    <label class="form-check-label" for="metodo<?= $m['payment_method_id'] ?>"><?= $m['name'] ?></label>
                </div>
            <?php } ?>

        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Guardar Métodos de Pago</button>
        </div>
    </form>
</div>
