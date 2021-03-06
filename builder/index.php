<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Facebook App Builder</title>

    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <style>
        body {
            padding-top: 30px;
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

<div class="container">

    <div class="starter-template">
        <h1>Facebook App Builder</h1>
        <p class="lead">Use this document as a way to quickly start any new project.<br> All you get is this text and a
            mostly barebones HTML document.</p>
    </div>

    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <form action="create.php" method="post" role="form">
                <div class="panel panel-danger">
                    <div class="panel-body">
                        <legend>App Properties</legend>

                        <?php if (isset($_SESSION['message'])): ?>
                        <div class="alert alert-danger">
                        	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        	<strong>Warning!</strong> <?= $_SESSION['message'] ?>
                        </div>
                        <?php endif; ?>

                        <div class="form-group has-error">
                            <input type="text" class="form-control" name="appName"
                                   placeholder="Application Name" required>
                        </div>

                        <div class="panel panel-danger">
                            <div class="panel-body">
                                <legend>Database Params</legend>

                                <div class="form-group has-error">
                                    <input type="text" class="form-control" name="dbName"
                                           placeholder="Database Name" required>
                                </div>

                                <div class="form-group has-error">
                                    <input type="text" class="form-control" name="dbHost"
                                           placeholder="Database Host" required>
                                </div>

                                <div class="form-group has-error">
                                    <input type="text" class="form-control" name="dbUsername"
                                           placeholder="Database Username" required>
                                </div>

                                <div class="form-group has-error">
                                    <input type="password" class="form-control" name="dbPassword"
                                           placeholder="Database Password" required>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-primary">
                            <div class="panel-body">
                                <legend>Facebook Params</legend>

                                <div class="form-group has-error">
                                    <input type="number" class="form-control" name="fbId"
                                           placeholder="Facebook ID" required>
                                </div>

                                <div class="form-group has-error">
                                    <input type="text" class="form-control" name="fbSecret"
                                           placeholder="Facebook Secret" required>
                                </div>

                                <div class="form-group has-error">
                                    <input type="text" class="form-control" name="fbNamespace"
                                           placeholder="Facebook Namespace" required>
                                </div>

                                <legend>Facebook Test Params</legend>

                                <div class="form-group">
                                    <input type="number" class="form-control" name="fbIdTest"
                                           placeholder="Facebook ID TEST" required>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control" name="fbSecretTest"
                                           placeholder="Facebook Secret TEST" required>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control" name="fbTestNamespace"
                                           placeholder="Facebook Namespace TEST" required>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">Application type</h3>
                            </div>
                            <div class="panel-body">
                                <label class="radio-inline">
                                    <input type="radio" name="appType" value="default" checked> Basic App
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="appType" value="query"> Questionnaire
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="appType" value="gallery"> Photo Contest
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="appType" value="puzzle"> Puzzle Match
                                </label>
                            </div>
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-success">Create app</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div><!-- /.container -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>

