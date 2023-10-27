<?php
namespace App\Helpers;

use ReflectionClass;

class Reflection{
    public static function getClassDependencies($className) {
        $dependencies = [];
        $reflectionClass = new ReflectionClass($className);
    
        if ($constructor = $reflectionClass->getConstructor()) {
            $parameters = $constructor->getParameters();
    
            foreach ($parameters as $parameter) {
                $dependencyClass = $parameter->getClass();
                if ($dependencyClass) {
                    $dependencies[] = $dependencyClass->getName();
                }
            }
        }
    
        return $dependencies;
    }
}