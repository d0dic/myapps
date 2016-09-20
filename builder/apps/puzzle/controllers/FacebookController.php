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

use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

abstract class FacebookController extends Controller
{
    /**
     * @property Facebook $facebook
     */
    private $facebook;

    public function init()
    {
        Yii::$app->session->open();
        $this->enableCsrfValidation = false;

        $this->facebook = new Facebook([
            'app_id' => Yii::$app->params['fb_app_id'],
            'app_secret' => Yii::$app->params['fb_app_secret'],
            'default_graph_version' => 'v2.6',
        ]);

        parent::init();
    }

    // fb login is implemented here
    public function actionLogin(){

        if (Yii::$app->user->isGuest) {
            $this->facebookLogin();
        }

        echo '<script> window.top.location="'.
            Yii::$app->params['afterLogin_url'].'"; </script>'; die;
    }

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

    public function actionNotify(){

        $userId = user()->id;
        $text = 'Just to notify you that I am In ;)';
        $href = 'https://facebook.com';

        $token = $this->getAppAccessToken();
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

    /**
     * @return mixed
     */
    protected function getLoginUrl()
    {
        foreach ($_SESSION as $k=>$v) {
            if(strpos($k, "FBRLH_")!==FALSE) {
                if(setcookie($k, $v)) {
                    $_COOKIE[$k]=$v;
                }
            }
        }

        $helper = $this->facebook->getRedirectLoginHelper();
        $permissions = ['user_friends', 'email']; // Optional permissions

        return  $helper->getLoginUrl(
            Yii::$app->params['fbLogin_url'], $permissions);
    }

    /**
     * @throws Exception
     */
    private function facebookLogin()
    {
        $helper = $this->facebook->getRedirectLoginHelper();

        try {
            $accessToken = $helper->getAccessToken();
        } catch (FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        if (!isset($accessToken)) {

            if ($helper->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                echo "Error: " . $helper->getError() . "\n";
                echo "Error Code: " . $helper->getErrorCode() . "\n";
                echo "Error Reason: " . $helper->getErrorReason() . "\n";
                echo "Error Description: " . $helper->getErrorDescription() . "\n";
            } else {
                header('HTTP/1.0 400 Bad Request');
                echo 'Bad request';
            }
            exit;
        }

        try {
            // Get the Facebook\GraphNodes\GraphUser object for the current user.
            // If you provided a 'default_access_token', the '{access-token}' is optional.
            $response = $this->facebook->get('/me?fields=id,link,name,gender,email', $accessToken);
        } catch (FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        $fbUser = $response->getGraphUser();

        $this->storeFbUser($fbUser);
    }

    /**
     * @param $fbUser
     * @throws Exception
     */
    private function storeFbUser($fbUser)
    {

        $user = User::findOne($fbUser->getId());

        if (!$user) {
            $user = new User();
            $user->role = 'user';
            $user->id = $fbUser->getId();
            $user->name = $fbUser->getName();
            $user->link = $fbUser->getLink();
            $user->gender = $fbUser->getGender();
            $user->email = $fbUser->getEmail();
            $user->ip_addr = request()->getUserIP();
            $user->user_agent = request()->getUserAgent();
            $user->created = time();
        }

        if (!$user->save()) {
            throw new Exception('User not saved!');
            # dump($user->errors); die();
        }

        Yii::$app->user->login($user, 3600 * 24 * 30);
    }

    /**
     * @return null|string
     * @throws Exception
     */
    private function getAppAccessToken()
    {
        $access_token = null;
        $url = 'https://graph.facebook.com/oauth/access_token?client_id=' .Yii::$app->params['fb_app_id'] .
            '&client_secret=' .Yii::$app->params['fb_app_secret'] . '&grant_type=client_credentials';

        try {
            $access_token = file_get_contents($url);
        } catch (Exception $exc) {
            throw $exc;
        }

        return $access_token;
    }
}
