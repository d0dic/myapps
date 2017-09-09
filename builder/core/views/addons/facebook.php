<?php

use yii\helpers\Url;
use app\models\Invite;

?>

<script type="text/javascript">

    function login() {

        FB.login(function (response) {
            if (response.authResponse) {
                location.href = "<?= Url::to(['site/login']) ?>?code=" +
                    response.authResponse.accessToken;
            }
            console.log(response);
        }, {scope: "email"});
    }

    function invite(friendIds) {

        var invited = <?= Invite::getInvited() ?>;
        var redirectUri = "<?= Yii::$app->params['afterLogin_url'] ?>";

        var requestObject = {
            type: 'inviteFriends'
        };

        FB.ui({
            method: 'apprequests',
            type: 'request', to: friendIds,
            redirect_uri: redirectUri,
            message: 'Poruka kojom pozivamo korisnika!',
            exclude_ids: invited,
            data: requestObject,
        }, function (response) {

            if (response.to) {
                window.location = "<?= Url::to(['site/invite']) ?>?list=" + response.to;
            }

            console.log(response);
        });
    }

    function share() {
        FB.ui({
            method: 'feed',
            name: 'Application name',
            caption: 'Facebook Applications for your purpose',
            description: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, ' +
            'sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            picture: 'https://learn.plus/wp-content/uploads/2015/01/coding-600x315.jpg',
            href: 'https://apps.facebook.com/'
        }, function (response) {
            console.log(response);
        });
    }
</script>