<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 18-Sep-16
 * Time: 11:17 AM
 */

require_once 'vendor/autoload.php';

function structurePreview($dir)
{

    $files = scandir($dir);
    print_r($files);

    foreach ($files as $file) {

        if ($file == '.' || $file == '..'
            || $file == 'test.php'
        ) {
            continue;
        }

        ob_start();
        echo file_get_contents($dir . '\\' . $file);
        $file = ob_get_contents();
        ob_end_clean();

        var_dump(htmlspecialchars($file));
        echo PHP_EOL;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>PHP Design patterns</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <style>
        body {
            padding-top: 50px;
        }

        .starter-template {
            padding: 40px 15px;
            text-align: center;
        }
    </style>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">PHP Design patterns</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a target="_blank" href="https://en.wikipedia.org/wiki/Creational_pattern">Creational Patterns</a>
                </li>
                <li><a target="_blank" href="https://en.wikipedia.org/wiki/Structural_pattern">Structural Patterns</a>
                </li>
                <li><a target="_blank" href="https://en.wikipedia.org/wiki/Behavioral_pattern">Behavioural Patterns</a>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>

<div class="container">

    <div class="starter-template">
        <h1>PHP Design patterns - Examples</h1>
        <p class="lead">Use this document as a way to quickly start any new project.<br> All you get is this text and a
            mostly barebones HTML document.</p>
    </div>

    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#factory" role="tab" data-toggle="tab">Factory Pattern</a></li>
        <li><a href="#adapter" role="tab" data-toggle="tab">Adapter Pattern</a></li>
        <li><a href="#observer" role="tab" data-toggle="tab">Observer pattern</a></li>
    </ul>
    <!-- TAB CONTENT -->
    <div class="tab-content">
        <div class="active tab-pane fade in" id="factory">
            <h2>Factory Pattern</h2>
            <pre>
                <?php include 'factory/test.php'; ?>
            </pre>
        </div>
        <div class="tab-pane fade" id="adapter">
            <h2>Adapter Pattern</h2>
            <pre>
                <?php include 'adapter/test.php'; ?>
            </pre>
        </div>
        <div class="tab-pane fade" id="observer">
            <h2>Observer pattern</h2>
            <pre>
                <?php include 'observer/test.php'; ?>
            </pre>
        </div>
    </div>


</div><!-- /.container -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
</body>
</html>

