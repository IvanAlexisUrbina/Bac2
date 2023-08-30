<?php foreach ($seller as $s) {

?>
<div class="container p-4">
    <h2>Actualizar vendedor</h2>
    <form action="<?= Helpers\generateUrl("Clients","Clients","SellerUpdate")?>" method="POST">
        <input type="hidden" class="form-control" id="u_id" value="<?=$s['u_id']?>" name="u_id" required>
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" class="form-control" id="u_name" value="<?=$s['u_name']?>" name="u_name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="u_email" name="u_email" value="<?=$s['u_email']?>" required>
        </div>
        <div class="form-group">
            <label for="phone">Teléfono:</label>
            <input type="text" class="form-control" id="u_phone" name="u_phone" value="<?=$s['u_phone']?>" required>
        </div>
        <div class="form-group">
            <label for="city">Código:</label>
            <input type="text" class="form-control" id="u_codeSeller" name="u_codeSeller" value="<?=$s['u_codeSeller']?>" required>
        </div>
        <div class="form-group p-2">

            <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>

    </form>
</div>
<?php }
?>