<?php // $oAccounts = new Accounts();         ?>
<div class="modal-body">
    <p>Está seguro de que desea eliminar el cliente <strong><?= $oClientes->getNombre() ?></strong></p>
    <p>Esta acción no puede deshacerse.</p>
    <?=
    form_open('delete-client-action', [
        'id' => 'EliminarCliente_' .uniqid(),
        'class' => 'form ajax-form',
        'callback' => 'DefaultFormResponse'
            ], [Clientes::class . '[' . Clientes::COLUMN_ID . ']' => $oClientes->getID()])
    ?>
    <button class="btn btn-danger" type="submit">SÍ, ELIMINAR</button>
<?= form_close() ?>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Atrás</button>
</div>
<?= javascript_tag(['short-scripts/standar-ajax-form-control.min.js']) ?>