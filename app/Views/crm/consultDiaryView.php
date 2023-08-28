<div class="container table-responsive">
    <h1>Agenda</h1>
    <div class="p-2">
        <a class="btn btn-outline-primary" 
            href="<?= Helpers\generateUrl("CRM","CRM","consultViewDate")?>">Crear reunión</a>
    </div>
    <div class="table-responsive">

        <table class="table DataTable text-center slide-in-top align-middle table-hover table-responsive">
            <thead class="table-dark">
                <tr>
                    <th>Clientes</th>
                    <th>Fecha reunion</th>
                    <th>Hora reunion</th>
                    <th>Asunto</th>
                    <th>Comentarios</th>
                    <th>Link</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php
    foreach ($meeting as $meet) { 
    ?>
                <tr>
                    <td><?= $meet['d_clients']?></td>
                    <td><?= $meet['meeting_date']?></td>
                    <td><?= $meet['meeting_time']?></td>
                    <td><?= $meet['meeting_type']?></td>
                    <td><?= $meet['comments']?></td>
                    <td><?= $meet['meeting_link']?></td>
                    <td><?= $meet['d_status']?></td>
                </tr>
                <?php
    }
    ?>
            </tbody>

        </table>
    </div>

</div>