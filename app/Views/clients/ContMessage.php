<div class="container">
    <h1>Bandeja de Entrada</h1>

    <!-- Formulario para crear un nuevo mensaje -->
    <form id="emailForm" action="<?= Helpers\generateUrl("Clients","Clients","sendEmails",[],"ajax")?>" method="POST">
        <div class="form-group">
            <label for="addressee">Destinatarios:</label>
            <input type="text" class="form-control" id="addressee" name="addressee" required>
            <small>Ingresa los correos separados por comas (ej. correo1@example.com, correo2@example.com)</small>
        </div>
        <div class="form-group">
            <label for="subject">Asunto:</label>
            <input type="text" class="form-control" id="subject" name="subject" required>
        </div>
        <div class="form-group">
            <label for="message">Mensaje:</label>
            <textarea class="form-control" id="message" name="message" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

    <!-- Lista de mensajes -->
    <div class="table_responsive">
        <table class="table DataTable table-hover slide-in-top table-dark table-stripe">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Correos</th>
                    <th scope="col">Fecha de envio</th>
                    <th scope="col">Asunto</th>
                    <th scope="col">Mensaje</th>
                </tr>
            </thead>
            <tbody class="table-light">
            <?php
				foreach ($Messages as $m) {
					echo '<tr>
					<td>'.$m['id'].'</td>
					<td>'.$m['recipients'].'</td>
					<td>'.$m['send_date'].'</td>
					<td>'.$m['subject'].'</td>
					<td>'.$m['message'].'</td>
					</tr>';
				}
			?>
            </tbody>
        </table>
    </div>
</div>