<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" type="image/png" href="./favicon.png">

    <title>Neptune - <?php echo $title ?></title>

    <link href="/assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/assets/bower_components/font-awesome/css/all.min.css" rel="stylesheet" />
    <link href="/assets/css/style.css" rel="stylesheet" />

    <?php $this->renderSection( "header" ); ?>
</head>
<body>

    <!-- MENU : START !-->
    <?php $this->renderPartial( VIEWS. "/shared/menu.php" ); ?>
    <!-- MENU : END !-->

    <!-- VIEW : START !-->
    <?php $this->renderSection( "body" ); ?>
    <!-- VIEW : END !-->
    
    <script src="/assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/assets/bower_components/font-awesome/js/all.min.js"></script>
    <script src="/assets/bower_components/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="/assets/bower_components/jquery-validation/dist/localization/messages_fr.min.js" ></script>
    
    <?php $this->renderSection( "scripts" ); ?>
</body>
</html>