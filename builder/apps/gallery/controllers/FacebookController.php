<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 07-Sep-16
 * Time: 1:13 PM
 */

namespace app\controllers;

use Yii;
use yii\db\Exception;
use yii\web\Controller;

use app\models\User;
use app\models\Invite;
use app\models\Share;

use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

abstract class FacebookController extends Controller
{
    /**
     * Disable CSRF on init
     */
    public function init()
    {
        $this->enableCsrfValidation = false;
        parent::init();
    }

    /**
     * Facebook login redirection
     */
    public function actionLogin(){

        if (Yii::$app->user->isGuest) {
            Yii::$app->facebook->facebookLogin();
        }

        echo '<script> window.top.location="'.
            Yii::$app->params['afterLogin_url'].'"; </script>'; die;
    }

    /**
     * @param array User $list
     * @return \yii\web\Response
     * @throws Exception
     */
    public function actionInvite($list){

        $invited = explode(',', $list);

        foreach ($invited as $invitedId){
            $invite = new Invite();
            $invite->user = user()->id;
            $invite->friend = $invitedId;
            $invite->created = time();

            if (!$invite->save()){
                throw new Exception('Invite not saved to database!');
                # echo '<pre>'; var_dump($invite->errors); die();
            }
        }

        return $this->redirect('index');
    }

    /**
     * @param $post
     * @return mixed
     * @throws \Exception
     */
    public function actionShare($post)
    {
        $share = new Share();
        $share->user = user()->id;
        $share->post = $post;
        $share->created = time();

        if (!$share->save()) {
            throw new \Exception('Share information not saved!');
        }

        return $this->redirect('index');
    }

    /**
     * @return \yii\web\Response
     * @throws \yii\base\Exception
     */
    public function actionNotify(){

        $userId = user()->id;
        $text = 'Just to notify you that I am In ;)';
        $href = 'https://facebook.com';

        $token = Yii::$app->facebook->getAppAccessToken();
        $post_data = /*"access_token=".*/ $token ."&template={$text}&href={$href}";

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL,
            "https://graph.facebook.com/v2.6/". $userId ."/notifications");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $data = curl_exec($curl);

        curl_close($curl);

        $response = json_decode($data);

        if (!$response->success) {
            throw new \yii\base\Exception('Notification failed!');
        }

        return $this->redirect('index');

        # var_dump($data);
    }
}
