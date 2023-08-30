<div class="container">
    <h2>Insertar un vendedor</h2>
    <form action="<?= Helpers\generateUrl("Clients","Clients","insertSeller")?>" method="POST">
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" class="form-control" id="u_name" name="u_name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="u_email" name="u_email" required>
        </div>
        <div class="form-group">
            <label for="phone">Teléfono:</label>
            <input type="text" class="form-control" id="u_phone" name="u_phone" required>
        </div>
        <div class="form-group">
            <label for="city">Codigo:</label>
            <input type="text" class="form-control" id="u_codeSeller" name="u_codeSeller" required>
        </div>
        <button type="submit" class="btn btn-primary">Insertar</button>
    </form>
</div>
