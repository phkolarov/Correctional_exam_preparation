<?php
/**
 * Created by PhpStorm.
 * User: Phill
 * Date: 10/7/2015
 * Time: 9:54 PM
 */

namespace controllers\defaultControllers;


class IndexController
{

    public function index(){

        var_dump('index-a');
    }

    /**
     * @Route("dontlogin/nelogin")
     */
    public function login(){



        var_dump('login-a');
    }
}