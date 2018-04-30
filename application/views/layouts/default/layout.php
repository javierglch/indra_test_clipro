<!DOCTYPE HTML >
<html lang="es" hreflang="es">
    <head>
        <meta charset="utf-8">
        <link rel="shortcut icon" href="/assets/images/favicon.ico" type="image/x-icon"/>
        <link rel="icon" href="/assets/images/favicon.ico" type="image/x-icon"/>
        <link rel="apple-touch-icon" href="/assets/images/favicon.ico"/>
        <link rel="canonical" href="<?= base_url(get_instance()->uri->uri_string()) ?>" />
        <?= include_http_metas() ?>
        <?= include_metas() ?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <?= include_metas_properties() ?>
        <?= include_title() ?>


        <!-- Bootstrap && font awesome css -->
        <?= stylesheet_tag(['https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css','https://use.fontawesome.com/releases/v5.0.6/css/all.css'])?>

        <!-- custom css -->
        <?= include_stylesheets() ?>

    </head>
    <body>
        <div class="main-section">
            <?= $main_section ?>
        </div>

        <!-- jQuery library && Bootstrap -->
        <?= javascript_tag(['compatibility/modernizr-custom.js','https://code.jquery.com/jquery-3.3.1.min.js','https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js','https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js']) ?>

        <!-- custom js -->
        <?= include_javascripts() ?>

    </body>
</html>