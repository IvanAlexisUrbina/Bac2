<div class="container">
    <h1>Actualizar informacion de la compañia</h1>
    <?php foreach ($company as $comp) { ?>
    <form action="<?php echo Helpers\generateUrl("Company","Company","UpdateDataCompany",[],"ajax")?>" method="POST">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="company_name">Nombre de la compañía</label>
                    <input type="text" id="company_name" name="company_name" class="form-control"
                        value="<?php echo $comp['c_name']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="NIT">Número de identificación tributaria (NIT)</label>
                    <input type="text" id="NIT" name="NIT" class="form-control"
                        value="<?php echo $comp['c_num_nit']; ?>">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Industria</label>
                    <select name="industry" id="industry" class="form-select">
                        <?php foreach ($industries as $i) { ?>
                        <option value="<?=$i['tpi_id']?>" <?php if($i['tpi_id'] == $comp['tpi_id']) echo 'selected'; ?>>
                            <?=$i['industry_name']?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="c_desc">Descripción</label>
                    <textarea id="c_desc" name="c_desc" class="form-control"><?php echo $comp['c_desc']; ?></textarea>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="country">País</label>
                    <input type="text" id="country" name="country" class="form-control"
                        value="<?php echo $comp['c_country']; ?>">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="department">Departamento</label>
                    <input type="text" id="department" name="department" class="form-control"
                        value="<?php echo $comp['c_state']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="city">Ciudad</label>
                    <input type="text" id="city" name="city" class="form-control"
                        value="<?php echo $comp['c_city']; ?>">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="representative_name">Nombre/s representante</label>
                    <?php foreach ($comp['representant'] as $rep) { ?>
                    <input type="text" id="representative_name" name="representative_name" class="form-control"
                        value="<?php echo $rep['u_name']; ?>">
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="representative_lastname">Apellido/s representante</label>
                    <?php foreach ($comp['representant'] as $rep) { ?>
                    <input type="text" id="representative_lastname" name="representative_lastname" class="form-control"
                        value="<?php echo $rep['u_lastname']; ?>">
                    <input type="hidden" name="u_id" value="<?php echo $rep['u_id']; ?>">
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="representative_document">Número de documento</label>
                    <?php foreach ($comp['representant'] as $rep) { ?>
                    <input type="text" id="representative_document" name="representative_document" class="form-control"
                        value="<?php echo $rep['u_document']; ?>">
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="representative_email">Correo electrónico</label>
                    <?php foreach ($comp['representant'] as $rep) { ?>
                    <input type="email" id="representative_email" name="representative_email" class="form-control"
                        value="<?php echo $rep['u_email']; ?>">
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="representative_document_type">Tipo de documento</label>
                    <select id="representative_document_type" name="representative_document_type" class="form-select"
                        required>
                        <option value="" disabled>Seleccione una opción</option>
                        <?php
                $documentTypes = array("Cedula de ciudadanía", "Cedula de extranjeria", "Pasaporte");
                foreach ($documentTypes as $type) {
                    $selected = ($type == $comp['representant'][0]['u_type_document']) ? 'selected' : '';
                    ?>
                        <option value="<?php echo $type; ?>" <?php echo $selected; ?>><?php echo $type; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>


        <div class="container p-4">
            <input type="hidden" name="c_id" value="<?php echo $comp['c_id']; ?>">
            <button type="submit" class="btn btn-outline-primary">Actualizar</button>
            <!-- <button type="button" data-bs-dismiss="modal" class="btn btn-outline-danger">Cancelar</button> -->
        </div>
    </form>
    <?php } ?>
</div>