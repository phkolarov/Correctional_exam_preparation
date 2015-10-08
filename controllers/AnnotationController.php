<?php
/**
 * Created by PhpStorm.
 * User: Phill
 * Date: 10/7/2015
 * Time: 8:52 PM
 */

namespace controllers;


class AnnotationController
{




    public static function checkAnnotations($controllerName)
    {

        $defaultControllersPath = 'controllers\\defaultControllers';
        $areaControllersPath = 'areas\\areaControllers';
        $defaultControllersFileNames = scandir($defaultControllersPath);
        $areaControllersFileNames = scandir($areaControllersPath);

        foreach($defaultControllersFileNames as $fileName){

            spl_autoload_register(function($class){
                $classPath = $class.".php";
                if(file_exists($classPath)){}

                require_once($classPath);
            });

            if(strpos($fileName, ".php")> 0){

                $reflection = new \ReflectionClass("controllers\\defaultControllers\\".basename($fileName,".php"));
                $methodsOfCurrentClass = $reflection->getMethods();

                foreach($methodsOfCurrentClass as $method){

                    $pattern = '/@Route\(\"(\w+)\/(\w+)/';
                    $methodsOfCurrentClass = ;
                    $methodDoc =  $method->getDocComment();

                    if($methodDoc){

                        preg_match($pattern ,$methodDoc,$matches);

                        var_dump($matches);

                    }



                }
            }

        }
//        foreach($defaultControllersFileNames as $fileName){
//
//            var_dump($fileName);
//        }

    }
}