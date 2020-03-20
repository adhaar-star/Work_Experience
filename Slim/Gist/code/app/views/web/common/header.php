<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="user-scalable=no,initial-scale=1,maximum-scale=1">
       <!-- <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE" />
        <META HTTP-EQUIV="EXPIRES" CONTENT="Mon, 22 Jul 2002 11:12:01 GMT" />-->
        <title>
            <?= !empty($meta['title']) ? 'Gist | ' . $meta['title'] : ''; ?>
        </title>
        <link rel="icon" href="<?= $app['base_assets_url']; ?>images/favicon.ico" type="image/x-icon" />

        <link rel="stylesheet" href="<?= $app['base_assets_url']; ?>css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= $app['base_assets_url']; ?>css/bootstrap-select.css">
         
        <link rel="stylesheet" href="<?= $app['base_assets_url']; ?>css/style.css">
        <link href="<?= $app['base_assets_url']; ?>css/responsive.css" rel="stylesheet">
        <link rel="stylesheet" href="<?= $app['base_assets_url']; ?>css/toastr.min.css">
        <link href="<?= $app['base_assets_url']; ?>fonts/fonts.css" rel="stylesheet">
        <link rel="icon" type="image/png" href="<?= $app['base_assets_url']; ?>favicon.png" />
        
        <script src="<?= $app['base_assets_url']; ?>js/jquery.min.js"></script>
        <script src="<?= $app['base_assets_url']; ?>js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?= $app['base_assets_url']; ?>toastr-master/build/toastr.min.js" type="text/javascript"></script>

        <script src="<?= $app['base_assets_url']; ?>js/jquery.validate.min.js" type="text/javascript"></script>

        <script type="text/javascript">
<?php if (isset($data)): ?>

                var Data = <?php echo json_encode($data); ?>;
<?php endif; ?>

        </script>


        <script src="<?= $app['base_assets_url']; ?>js/routes.js" type="text/javascript"></script>
        <script src="<?= $app['base_assets_url']; ?>js/helpers.js" type="text/javascript"></script>
  
        <script type="text/javascript">
            toastr.options = {
                "closeButton": true,
                "preventDuplicates": true,
                "extendedTimeOut": false,
                "showDuration": "300",
                "positionClass": "toast-top-center"
            }

        </script>
       <script src="<?= $app['base_assets_url']; ?>js/scripts.js" type="text/javascript"></script>
    </head>

