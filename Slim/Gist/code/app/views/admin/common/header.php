<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= !empty($meta['title']) ? 'Gist | ' . $meta['title'] : ''; ?></title>
      
        <link rel="icon" href="<?= $app['base_assets_admin_url']; ?>images/favicon.ico" type="image/x-icon" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link rel="stylesheet" href="<?= $app['base_assets_admin_url']; ?>css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= $app['base_assets_admin_url']; ?>css/style.css?v=1.1">
        <link rel="stylesheet" href="<?= $app['base_assets_admin_url']; ?>css/font-awesome.min.css"> 
        <link href="<?= $app['base_assets_url']; ?>toastr-master/build/toastr.min.css" rel="stylesheet">
        <!--inculde jquery file-->
        <script src="<?= $app['base_assets_url']; ?>js/jquery.1.11.1.js" type="text/javascript"></script>
        <!--inculde toastr js file-->
        <script src="<?= $app['base_assets_url']; ?>toastr-master/build/toastr.min.js" type="text/javascript"></script>
        <!--inculde bootstrp js file-->
        <script src="<?= $app['base_assets_admin_url']; ?>js/bootstrap.min.js" type="text/javascript"></script>

        <script type="text/javascript">
<?php if (isset($data)): ?> // get urls path

                var Data = <?php echo json_encode($data); ?>;
<?php endif; ?>
        </script>
        
        <script src="<?= $app['base_assets_url']; ?>js/routes.js?v=1.1" type="text/javascript"></script>
        <script src ="<?= $app['base_assets_url']; ?>js/helpers.js?v=1.1" type ="text/javascript" ></script>

        <script type="text/javascript">

            toastr.options = { // toastr customise
                "closeButton": true,
                "preventDuplicates": true,
                "extendedTimeOut": false,
                "showDuration": "300",
                "positionClass": "toast-top-center"
            }

        </script>
    </head>

