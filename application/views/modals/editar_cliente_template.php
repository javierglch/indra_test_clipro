<?php
// $oAccounts = new Accounts();       

$aCampos = [
    [
        'label' => 'Nombre',
        "function" => "form_input",
        "data" => [
            'name' => Clientes::class . '[' . Clientes::COLUMN_NOMBRE . ']',
            'placeholder' => '',
            'class' => 'form-control',
            "required" => "required",
            'value' => $oClientes->getNombre()
        ]
    ],
    [
        'label' => 'Apellidos',
        "function" => "form_input",
        "data" => [
            'name' => Clientes::class . '[' . Clientes::COLUMN_APELLIDOS . ']',
            'placeholder' => '',
            'class' => 'form-control',
            "required" => "required",
            'value' => $oClientes->getApellidos()
        ]
    ],
    [
        'label' => 'DNI',
        "function" => "form_input",
        "data" => [
            'name' => Clientes::class . '[' . Clientes::COLUMN_DNI . ']',
            'placeholder' => '',
            'class' => 'form-control',
            "required" => "required",
            'value' => $oClientes->getDNI()
        ]
    ],
    [
        'label' => 'Dirección',
        "function" => "form_input",
        "data" => [
            'name' => Clientes::class . '[' . Clientes::COLUMN_DIRECCION . ']',
            'placeholder' => '',
            'class' => 'form-control',
            "required" => "required",
            'value' => $oClientes->getDireccion()
        ]
    ],
    [
        'label' => 'Email',
        "function" => "form_input",
        "data" => [
            'name' => Clientes::class . '[' . Clientes::COLUMN_EMAIL . ']',
            'placeholder' => '',
            'class' => 'form-control',
            "required" => "required",
            'value' => $oClientes->getEmail()
        ]
    ],
    [
        'label' => 'Telefono',
        "function" => "form_input",
        "data" => [
            'name' => Clientes::class . '[' . Clientes::COLUMN_TELEFONO . ']',
            'placeholder' => '',
            'class' => 'form-control',
            "required" => "required",
            'value' => $oClientes->getTelefono()
        ]
    ]
];
?>
<div class="modal-body">
    <p>Estás editando el cliente <strong><?= $oClientes->getNombre() ?></strong></p>
    <?=
    form_create('edit-client-action', [
        'id' => 'EditarCliente_' .uniqid(),
        'class' => 'form ajax-form',
        'callback' => 'DefaultFormResponse'
            ], [Clientes::class . '[' . Clientes::COLUMN_ID . ']' => $oClientes->getID()], $aCampos)
    ?>
    <div class="text-center">
        <button class="btn btn-primary" type="submit">GUARDAR</button>
    </div>
<?= form_close() ?>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Atrás</button>
</div>
<?= javascript_tag(['short-scripts/standar-ajax-form-control.min.js']) ?>