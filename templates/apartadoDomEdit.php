
<!-- Apartado Domicilio -->
<div class="contenido col-md-12">
    <hr>
    <h2 class="form-title">Domicilio</h2>
</div>

<!-- Calle -->
<div class="contenido col-md-6" id="calleBox">
    <label for="calle" class="form-label">Calle: <span class="text-danger">*</span></label>
    <input type="text" maxlength="100" class="form-control without-special" value="<?php echo $calle ?>" name="calle" id="calle" placeholder="Ingresa la calle" required>
</div>

<!-- Número Exterior -->
<div class="contenido col-md-3" id="numExtBox">
    <label for="numExt" class="form-label">N° Ext.: <span class="text-danger">*</span></label>
    <input type="text" maxlength="10" class="form-control with-point" value="<?php echo $numExt ?>" name="numExt" id="numExt" placeholder="123" required>
</div>

<!-- Número Interior -->
<div class="contenido col-md-3">
    <label for="numInt" class="form-label">N° Int.:</label>
    <input type="text" maxlength="10" class="form-control with-point" value="<?php echo $numInt ?>" name="numInt" id="numInt" placeholder="456">
</div>

<!-- Código Postal -->
<div class="contenido col-md-4" id="cpBox">
    <label for="cp" class="form-label">Código Postal: <span class="text-danger">*</span></label>
    <input type="text" class="form-control" value="<?php echo $codigo_postal; ?>" id="cp" placeholder="Ingresa un Código Postal" required>
</div>

<!-- Colonia -->
<div class="contenido col-md-4" id="coloniaBox">
    <label for="colonia" class="form-label">Colonia: <span class="text-danger">*</span></label>
    <select name="colonia" id="colonia" class="form-select" required>
    <option value="<?php echo $coloniaId; ?>"><?php echo $colonia; ?></option>
    </select>
</div>

<!-- Delegación o Municipio DISABLED -->
<div class="contenido col-md-4">
    <label for="delMun" class="form-label">Delegación/Municipio:</label>
    <select name="delMun" id="delMun" class="form-select" disabled>
        <option value=""><?php echo $municipio; ?></option>
    </select>
</div>

<!-- Estado DISABLED -->
<div class="contenido col-md-4">
    <label for="estadoDir" class="form-label">Estado:</label>
    <select name="estadoDir" id="estadoDir" class="form-select" disabled>
        <option value=""><?php echo $estado; ?></option>
    </select>
</div>
<!-- Entre calles -->
<div class="contenido col-md-4">
    <label for="calleUno" class="form-label">Entre la calle:</label>
    <input type="text" value="<?php echo $calleUno ?>" class="form-control without-special" name="calleUno" id="calleUno" maxlength="50" placeholder="Ingresa la primera calle">
</div>
<div class="contenido col-md-4">
    <label for="calleDos" class="form-label">Y la calle:</label>
    <input type="text" value="<?php echo $calleDos ?>" class="form-control without-special" name="calleDos" id="calleDos" maxlength="50" placeholder="Ingresa la segunda calle">
</div>

<!-- Referencias -->
<div class="contenido col-md5">
    <label for="referencias" class="form-label">Referencias:</label>
    <input type="text" value="<?php echo $referencias ?>" class="form-control without-special" name="referencias" id="referencias" maxlength="100" placeholder="Ingresa mayores referencias del domicilio" maxlength="249">
</div>