<?php

/* @var $this yii\web\View */

$this->title = 'FB Application';

use yii\helpers\Url;

?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered Facebook App.</p>

        <?php if (Yii::$app->user->isGuest): ?>
        <p><a class="btn btn-lg btn-info" href="<?= $loginUrl ?>">Get started with FB Login</a></p>
        <!--<p><a class="btn btn-lg btn-info" href="javascript:login()">Get started with FB Login</a></p>-->
        <?php endif; ?>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-md-4 col-lg-4">
                <h2>FB Invite</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-success" href="javascript:invite()">Try it yourself! &raquo;</a></p>
            </div>
            <div class="col-md-4 col-lg-4">
                <h2>FB Share</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-primary" href="javascript:share()">Try it yourself! &raquo;</a></p>
            </div>
            <div class="col-md-4 col-lg-4">
                <h2>FB Notify</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-danger" href="<?= Url::to(['site/notify']) ?>">Try it yourself! &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
