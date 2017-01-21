<?php

use yii\helpers\Url;

?>

<script type="text/javascript">

    function login() {

        FB.login(function (response) {
            if (response.authResponse) {
                location.href = "<?= Url::to(['site/home']) ?>?code=" +
                    response.authResponse.accessToken;
            } else {
                console.log(response);
            }
        }, {scope: "user_friends, email"});
    }

    function invite(friendIds) {

        var invited = <?= \app\models\Invite::getInvited() ?>;

        var requestObject = {
            type: 'inviteFriends'
        };

        FB.ui({
            method: 'apprequests',
            type: 'request', to: friendIds,
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
            caption: 'Facebook Applications for your purpose',
            description: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            picture: 'https://learn.plus/wp-content/uploads/2015/01/coding-600x315.jpg',
            link: 'https://www.codeit.rs'
        }, function (response) {
            console.log(response);
        });
    }
</script>