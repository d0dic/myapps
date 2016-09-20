<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>FB App Builder</title>

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
        <h1>FB App Builder template</h1>
        <p class="lead">Use this document as a way to quickly start any new project.<br> All you get is this text and a
            mostly barebones HTML document.</p>
    </div>

    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <form action="create.php" method="post" role="form">
                <div class="panel panel-danger">
                    <div class="panel-body">
                        <legend>App Properties</legend>

                        <div class="form-group has-error">
                            <input type="text" class="form-control" name="appName"
                                   placeholder="App Name" required>
                        </div>

                        <div class="form-group has-error">
                            <input type="text" class="form-control" name="appDatabase"
                                   placeholder="DB Name" required>
                        </div>

                        <div class="form-group has-error">
                            <input type="number" class="form-control" name="fbId"
                                   placeholder="FB ID" required>
                        </div>

                        <div class="form-group has-error">
                            <input type="text" class="form-control" name="fbSecret"
                                   placeholder="FB Secret" required>
                        </div>

                        <div class="form-group has-error">
                            <input type="text" class="form-control" name="fbNamespace"
                                   placeholder="FB Namespace" required>
                        </div>

                        <div class="panel panel-primary">
                            <div class="panel-body">

                                <legend>Test App Properties</legend>

                                <div class="form-group">
                                    <input type="number" class="form-control" name="fbIdTest"
                                           placeholder="FB ID TEST" required>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control" name="fbSecretTest"
                                           placeholder="FB Secret TEST" required>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control" name="fbNamespaceTest"
                                           placeholder="FB Namespace TEST" required>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">App type</h3>
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

