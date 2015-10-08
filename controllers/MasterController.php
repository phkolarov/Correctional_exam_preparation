<?php
/**
 * Created by PhpStorm.
 * User: Phill
 * Date: 10/7/2015
 * Time: 7:14 PM
 */

namespace controllers;

use controllers\defaultControllers\IndexController;
use controllers\DefaultRouterController;
use controllers\AreaController;
use controllers\AnnotationController;

include('DefaultRouterController.php');
include('AreaController.php');
include('CustomRouteController.php');
include('AnnotationController.php');

class MasterController
{




    public static function controllerChecker($ctrl,$action,$parameters)
    {

//        if(!isset($_SESSION['username'])){
//            $controller = "index";
//            $action = "login";
//        }

        //CHECK FOR CUSTOM ROUTES AND RETURN EXISTED
        $controller = CustomRouteController::routeChecker($ctrl);

        //CHECK FOR ANNOTATIONS
        $controller = AnnotationController::checkAnnotations($controller);


        $controllerName = "controllers\\defaultControllers\\".ucfirst($controller)."Controller";

        if(!file_exists($controllerName.'.php')){
            $controllerName="controllers\\defaultControllers\\IndexController";
        };

        //CHECK FOR AREAS
        $areaChecker = AreaController::areaChecker($controller);

        if($areaChecker){
            $controllerName =  "areas\\areaControllers\\".ucfirst($controller)."Controller";
        }



        spl_autoload_register(function($class){
            $controllerPath = $class.".php";
            if(file_exists($controllerPath)){
                require_once($controllerPath);
            };
        }
        );

        $loadedController = new $controllerName();

        if(method_exists($loadedController,$action)){

            call_user_func_array(array($loadedController,$action),array($parameters));
        }


    }

}