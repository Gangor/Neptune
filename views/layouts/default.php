<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" type="image/png" href="/favicon.png">

    <title>Neptune - <?php echo $title ?></title>

    <link async href="http://fonts.googleapis.com/css?family=Aladin" data-generated="http://enjoycss.com" rel="stylesheet" type="text/css"/>
    <link async href="http://fonts.googleapis.com/css?family=Nova%20Flat" data-generated="http://enjoycss.com" rel="stylesheet" type="text/css"/>
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

    <!-- FOOTER : START !-->
    <?php $this->renderPartial( VIEWS. "/shared/footer.php" ); ?>
    <!-- FOOTER : END !-->
    
    <script type="text/javascript" src="/assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/assets/bower_components/font-awesome/js/all.min.js"></script>
    <script type="text/javascript" src="/assets/bower_components/jquery-validation/dist/jquery.validate.min.js"></script>
    <script type="text/javascript" src="/assets/bower_components/jquery-validation/dist/localization/messages_fr.min.js" ></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/cookie-bar/cookiebar-latest.min.js?forceLang=fr&always=1"></script>
    <script type="text/javascript" src="/assets/js/custom.js"></script>
    
    <?php $this->renderSection( "scripts" ); ?>
</body>
</html>