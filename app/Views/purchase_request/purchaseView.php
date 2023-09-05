<div class="container mt-5">
        <h1 class="text-center">Solicitud de Compra o Viáticos</h1>
        <form action="<?= Helpers\generateUrl("Purchase_request","Purchase_request","generateRequestPurchase")?>" method="POST">
            <div class="form-group col-md-6">
                <label for="motivo">Nombre:</label>
               <label class="form-control" ><?=$_SESSION['nameUser']." ".$_SESSION['LastNameUser']?></label>
            </div>
            <div class="form-group">
                <label for="motivo">Motivo:</label>
                <textarea class="form-control" id="reason" name="reason" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label for="monto">Monto Solicitado:</label>
                <input type="number" class="form-control" id="quantity" name="quantity" required>
            </div>


            <button type="submit" class="btn btn-primary mt-2">Enviar Solicitud</button>
        </form>
</div>

