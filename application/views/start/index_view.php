<header class="container my-4">
    <h1 class="h1">Bienvenido a Clipro</h1>
    <p>En esta pequeña aplicación <em>Clipro</em> podrás gestionar los productos y clientes, asociandolos entre ellos facilmente en una interfaz intuitiva y responsive.</p>
</header>

<div class="container">
    <?php print_all_flash_messages() ?>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" id="NavProductsClients" role="tablist">
        <li class="nav-item">
            <a class="nav-link" id="products-tab" data-toggle="tab" href="#products" role="tab" aria-controls="products" aria-selected="false">Productos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" id="clients-tab" data-toggle="tab" href="#clients" role="tab" aria-controls="clients" aria-selected="true">Clientes</a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane" id="products" role="tabpanel" aria-labelledby="products-tab">
            <?= form_open('update-produts-list-action', ['class' => 'form form-inline my-3']) ?>
            <p>La estructura de los productos servidos por la url debe ser en forma de array, y dentro de este objetos con los parametros "Nombre", "Codigo", "Descripcion".</p>
            <div class="form-group">
                <input type="text" class="mb-2 form-control" value="<?= base_url('json_products.json') ?>" name="url_products_json">
            </div>
            <button type="submit" class="mb-2 ml-3 btn btn-primary">Actualizar productos</button>
            <?= form_close(); ?>
            <table class="table datatable table-responsive">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Código</th>
                        <th>Descripción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($aProducts as $oProduct): ?>
                        <tr>
                            <td><?= $oProduct->getNombre() ?></td>
                            <td><?= $oProduct->getCodigo() ?></td>
                            <td><?= $oProduct->getDescripcion() ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="tab-pane active" id="clients" role="tabpanel" aria-labelledby="clients-tab">
            <div class="text-right">
                <button type="button" class="btn btn-lg btn-primary m-3" onclick="loadModalView(this)" data-modal-template="modals/crear_cliente_template" data-modal-title="Crear cliente" data-modal-params-json='' data-toggle="tooltip" title="Crear nuevo cliente">Crear nuevo cliente <i class="fas fa-plus"></i></button>
            </div>
            <table class="table datatable table-responsive">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>DNI</th>
                        <th>Dirección</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th style="min-width: 170px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($aClientes as $oCliente): ?>
                        <?php // $oCliente = new Clientes(); ?>
                        <tr>
                            <td><?= $oCliente->getNombre() ?></td>
                            <td><?= $oCliente->getApellidos() ?></td>
                            <td><?= $oCliente->getDNI() ?></td>
                            <td><?= $oCliente->getDireccion() ?></td>
                            <td><?= $oCliente->getEmail() ?></td>
                            <td><?= $oCliente->getTelefono() ?></td>
                            <td>
                                <button type="button" class="btn btn-sm btn-info mr-2 mb-2" onclick="loadModalView(this)" data-modal-template="modals/gestion_cliente_productos_template" data-modal-title="Gestión de productos del cliente" data-modal-params-json='<?= json_encode([Clientes::class => [Clientes::COLUMN_ID => $oCliente->getID()]]) ?>' data-toggle="tooltip" title="Gestionar productos asociados"><i class="fas fa-database text-white"></i></button>
                                <button type="button" class="btn btn-sm btn-warning mr-2 mb-2" onclick="loadModalView(this)" data-modal-template="modals/editar_cliente_template" data-modal-title="Editar cliente" data-modal-params-json='<?= json_encode([Clientes::class => [Clientes::COLUMN_ID => $oCliente->getID()]]) ?>' data-toggle="tooltip" title="Editar"><i class="fa fa-edit text-white"></i></button>
                                <button type="button" class="btn btn-sm btn-danger mr-2 mb-2" onclick="loadModalView(this)" data-modal-template="modals/eliminar_cliente_template" data-modal-title="Borrar cliente" data-modal-params-json='<?= json_encode([Clientes::class => [Clientes::COLUMN_ID => $oCliente->getID()]]) ?>' data-toggle="tooltip" title="Borrar"><i class="fa fa-trash text-white"></i></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<footer class="my-5 py-2 text-center">
    &copy; 2018 javiergordoweb.es
</footer>