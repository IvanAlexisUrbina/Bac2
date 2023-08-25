<div class="container">
    <h2>Insertar un vendedor</h2>
    <form action="<?= Helpers\generateUrl("Clients","Clients","insertSeller")?>" method="POST">
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" class="form-control" id="s_name" name="s_name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="s_email" name="s_email" required>
        </div>
        <div class="form-group">
            <label for="phone">Teléfono:</label>
            <input type="text" class="form-control" id="s_phone" name="s_phone" required>
        </div>
        <div class="form-group">
            <label for="city">Codigo:</label>
            <input type="text" class="form-control" id="s_code" name="s_code" required>
        </div>
        <button type="submit" class="btn btn-primary">Insertar</button>
    </form>
</div>
