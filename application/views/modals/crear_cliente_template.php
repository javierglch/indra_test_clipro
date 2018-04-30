<?php
// $oAccounts = new Accounts();       

$aCampos = [
    [
        'label' => 'Nombre',
        "function" => "form_input",
        "data" => [
            'name' => Clientes::class . '[' . Clientes::COLUMN_NOMBRE . ']',
            'placeholder' => '¿Cuál es el nombre de pila del cliente?',
            'class' => 'form-control',
            "required" => "required",
        ]
    ],
    [
        'label' => 'Apellidos',
        "function" => "form_input",
        "data" => [
            'name' => Clientes::class . '[' . Clientes::COLUMN_APELLIDOS . ']',
            'placeholder' => '¿Cómo se apellida el cliente?',
            'class' => 'form-control',
            "required" => "required",
        ]
    ],
    [
        'label' => 'DNI',
        "function" => "form_input",
        "data" => [
            'name' => Clientes::class . '[' . Clientes::COLUMN_DNI . ']',
            'placeholder' => '#########',
            'class' => 'form-control',
            "required" => "required",
        ]
    ],
    [
        'label' => 'Dirección',
        "function" => "form_input",
        "data" => [
            'name' => Clientes::class . '[' . Clientes::COLUMN_DIRECCION . ']',
            'placeholder' => 'C/... Provincia - CP',
            'class' => 'form-control',
            "required" => "required",
        ]
    ],
    [
        'label' => 'Email',
        "function" => "form_input",
        "data" => [
            'name' => Clientes::class . '[' . Clientes::COLUMN_EMAIL . ']',
            'placeholder' => 'email@dominio.es',
            'class' => 'form-control',
            "required" => "required",
        ]
    ],
    [
        'label' => 'Telefono',
        "function" => "form_input",
        "data" => [
            'name' => Clientes::class . '[' . Clientes::COLUMN_TELEFONO . ']',
            'placeholder' => '6## ### ###',
            'class' => 'form-control',
            "required" => "required",
        ]
    ]
];
?>
<div class="modal-body">
    <p>Estás creando un nuevo cliente.</p>
    <?=
    form_create('create-client-action', [
        'id' => 'CrearNuevoCliente_' . uniqid(),
        'class' => 'form ajax-form',
        'callback' => 'DefaultFormResponse'
            ], [], $aCampos)
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