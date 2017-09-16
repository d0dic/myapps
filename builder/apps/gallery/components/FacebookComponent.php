<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 25-Sep-16
 * Time: 10:42 PM
 */

namespace app\components;

use yii;
use app\models\User;
use Facebook\Facebook;
use yii\base\Component;
use yii\base\Exception;

/**
 * Class FacebookComponent
 * @package app\components
 */
class FacebookComponent extends Component
{
    /**
     * @property Facebook $facebook
     */
    private $facebook;

    /**
     * Initialize Facebook object on every call
     */
    public function init()
    {
        Yii::$app->session->open();
        $this->facebook = new Facebook([
            'app_id' => Yii::$app->params['fb_app_id'],
            'app_secret' => Yii::$app->params['fb_app_secret'],
            'default_graph_version' => 'v2.6',
        ]);
        parent::init();
    }

    /**
     * @return string
     */
    public function getLoginUrl()
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

        return $helper->getLoginUrl(
            Yii::$app->params['fbLogin_url'], $permissions);
    }

    /**
     * @return boolean
     * @throws Exception
     */
    public function facebookLogin()
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

        return $this->storeFbUser($fbUser);
    }

    /**
     * @param $fbUser
     * @return boolean
     * @throws Exception
     */
    public function storeFbUser($fbUser)
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

        return Yii::$app->user->login($user, 3600 * 24 * 30);
    }

    /**
     * @return null|string
     * @throws Exception
     */
    public function getAppAccessToken()
    {
        $access_token = null;
        $url = 'https://graph.facebook.com/oauth/access_token?client_id=' .Yii::$app->params['fb_app_id'] .
            '&client_secret=' .Yii::$app->params['fb_app_secret'] . '&grant_type=client_credentials';

        try {
            $access_token = file_get_contents($url);
        } catch (Exception $exc) {
            throw $exc;
        }

        $response = json_decode($access_token);
        return $response->access_token;
    }

}