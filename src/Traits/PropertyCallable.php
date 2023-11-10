<?php

namespace MyCustom\Traits;

trait PropertyCallable
{
    /**
     * クラスのプロパティ名をメソッド名としたGetterを定義する
     */
    public function __call(string $propertyName, array $parameters)
    {
        $reflectionProperty = new \ReflectionProperty(self::class, $propertyName);

        return $reflectionProperty->isStatic() ? self::$$propertyName : $this->$propertyName;
    }
}
