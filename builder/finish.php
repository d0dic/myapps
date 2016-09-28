<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 07-Sep-16
 * Time: 12:38 PM
 */

session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Finish</title>

    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <style type="text/css">
        body {
            padding-top: 50px;
        }
    </style>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="container">

    <div class="jumbotron">
        <h1>Congratulations!</h1>
        <h2>Your Facebook App in <a href="http://www.yiiframework.com/doc-2.0/guide-index.html">Yii 2 Framework</a>
            has just been created!</h2>

        <div class="progress">
            <div id="progres" class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="60"
                 aria-valuemin="0" aria-valuemax="100" style="width: <?= !$_SESSION['deployed'] ? '50' : '80' ?>%;">
                Setup <?= !$_SESSION['deployed'] ? '50' : '80' ?>%
            </div>
        </div>

        <?php if (!$_SESSION['deployed']): ?>
            <div class="alert alert-danger">
                <p><strong>Before</strong> you go to the link bellow you should open your <u>app folder</u> run cmd and
                    type
                    <code>composer update</code> command, or click <a href="javascript:deploy(this)">here!</a></p>
            </div>
        <?php endif; ?>

        <div class="alert alert-danger">
            <p><strong>Now</strong> after your project is set, you must setup the <u>database</u> by typing
                <code>yii migrate</code> in your project console.</p>
        </div>

        <p class="text-right">
            <a class="btn btn-success btn-lg" href="<?= $_SESSION['deployed'] ? $_SESSION['app_link'] : '#' ?>"> Go to
                Your App
                <span class="glyphicon glyphicon-send"></span></a>
        </p>
    </div>

</div><!-- /.container -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<script type="text/javascript">
    function deploy(link) {
        link.setAttribute('href', '#');
        $('#progres').addClass('active');

        location.href =
            "<?= $_SESSION['app_link'] ?>/deploy.php";
    }
</script>

</body>
</html>

