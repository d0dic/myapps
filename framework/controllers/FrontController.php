<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 15-Sep-16
 * Time: 7:12 PM
 */

namespace app\controllers;

use app\assets\Session;
use app\models\User;

/**
 * Class FrontController
 * @package app\controllers
 */
class FrontController extends BaseController
{
    /**
     * @return mixed
     */
    function init()
    {
        // TODO: Implement init() method.
    }

    /**
     * @return mixed
     */
    function actionFilter()
    {
        // TODO: Implement actionFilter() method.
    }

    /**
     * @return string
     */
    public function actionHome(){

        return $this->render('front/home');
    }

    /**
     * @return string
     */
    public function actionAbout(){
        return $this->render('front/about');
    }

    /**
     * @return string
     */
    public function actionContact(){
        return $this->render('front/contact');
    }

    /**
     * @return string
     */
    public function actionProfile(){

        if (Session::getInstance()->userIdentity()) {
            return $this->render('front/profile', [
                'user' => Session::getInstance()->userIdentity()
            ]);
        }

        return $this->redirect('home');
    }

    /**
     * @return string
     */
    public function actionLogout(){

        if (Session::getInstance()->logoutUser(true)) {
            return $this->redirect('home');
        }
    }

    /**
     * @return string
     */
    public function actionLogin(){

        if (Session::getInstance()->userIdentity()) {
            return $this->redirect('profile');
        }

        if (Session::getInstance()->loginUser($this->testUser())) {
            return $this->render('front/profile', [
                'user' => Session::getInstance()->userIdentity()
            ]);
        }

//        dump(Session::getInstance()->userIdentity());
//        dump($_SESSION); die;

        return $this->redirect('home');
    }

    /**
     * @return User
     */
    private function testUser()
    {
        $user = new User();
        $user->id = 100;
        $user->role = 'user';
        $user->name = 'Test';
        $user->surname = 'Tester';
        $user->email = 'tester@live.com';
        $user->username = 'tester';
        $user->password = 'test.123';
        $user->created = time();

        return $user;
    }
}