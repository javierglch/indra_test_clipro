<?php
//$oProduct = new Products();
$aProducts = $this->Products->selectAll();
?>

<div class="modal-body">

    <?=
    form_create('assoc-client-products-action', [
        'id' => 'GestionProductosCliente_' . uniqid(),
        'class' => 'form ajax-form',
        'callback' => 'DefaultFormResponse'
            ], [Clientes::class . '[' . Clientes::COLUMN_ID . ']' => $oClientes->getID()])
    ?>

    <p>A continuación se muestra el listado de productos, marca los checks de los productos que quieres que estén asociados a <strong><?= $oClientes->getNombre() ?></strong></p>
    <table class="table datatable2 table-responsive">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Código</th>
                <th>Descripción</th>
                <th>Asociado</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($aProducts as $oProduct): ?>
                <tr>
                    <td><?= $oProduct->getNombre() ?></td>
                    <td><?= $oProduct->getCodigo() ?></td>
                    <td><?= substr($oProduct->getDescripcion(), 0, 70) ?>...</td>
                    <td class="text-center">
                        <input <?= $oClientes->hasProductAssoc($oProduct) ? 'checked="checked"' : '' ?> name="<?= Products::class ?>[]" value="<?= $oProduct->getID() ?>" type="checkbox" class="form-checkbox" id="checkbox_<?= $oProduct->getCodigo() ?>">
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="text-center">
        <button class="btn btn-primary" type="submit">GUARDAR</button>
    </div>
    <?= form_close() ?>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Atrás</button>
</div>
<?= javascript_tag(['short-scripts/standar-ajax-form-control.min.js']) ?>
<script type="text/javascript">
    $(document).ready(function (e) {
        $('.datatable2').DataTable({
            paging: false
        });
        $('.datatable2').find('th').css('width','');
    })
</script>