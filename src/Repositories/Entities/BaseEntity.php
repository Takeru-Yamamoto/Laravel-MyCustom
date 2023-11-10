<?php

namespace MyCustom\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;

use MyCustom\Jsonables\BaseJsonable;

use UnitEnum;
use Carbon\Carbon;

/**
 * 基底Entityクラス
 *
 * EntityはDTOであり、Modelから不必要な情報を削ぎ落したもの。
 * メンバ変数の定義と、constructでの代入処理を定義する。
 * 
 */
abstract class BaseEntity extends BaseJsonable
{
    /**
     * Entityに紐づけられたModelのクラス名
     * 
     * @var string $modelClass
     */
    protected string $modelClass;

    /**
     * コンストラクタで受け取ったModelの一時保存
     * コンストラクタ内で破棄する
     */
    private ?Model $model;

    /**
     * Entityのメンバ変数にModelの値を代入できたかどうか
     *
     * @var bool
     */
    private bool $isSetProperty = false;


    function __construct(?Model $model)
    {
        $this->model = $model;

        if (!is_null($this->model) && $this->model instanceof $this->modelClass) {
            $this->isSetProperty = true;
            $this->bindProperties();
        }

        $this->model = null;
    }

    abstract protected function bindProperties(): void;


    /**
     * Entityの各プロパティにModelの値を代入できたかどうか
     */
    final public function isSetProperty(): bool
    {
        return $this->isSetProperty;
    }


    /**
     * $model の $propertyName が string型として判断出来る場合は、その値を返す
     * そうでない場合は $defaultValue を返す
     * 
     * @param string $propertyName
     * @param ?string $defaultValue
     */
    final protected function stringValue(string $propertyName, ?string $defaultValue = null): ?string
    {
        return is_string($this->model->$propertyName) ? strval($this->model->$propertyName) : $defaultValue;
    }

    /**
     * $model の $propertyName が int型として判断出来る場合は、その値を返す
     * そうでない場合は $defaultValue を返す
     * 
     * @param string $propertyName
     * @param ?int $defaultValue
     */
    final protected function intValue(string $propertyName, ?int $defaultValue = null): ?int
    {
        return is_numeric($this->model->$propertyName) ? intval($this->model->$propertyName) : $defaultValue;
    }

    /**
     * $model の $propertyName が float型として判断出来る場合は、その値を返す
     * そうでない場合は $defaultValue を返す
     * 
     * @param string $propertyName
     * @param ?float $defaultValue
     */
    final protected function floatValue(string $propertyName, ?float $defaultValue = null): ?float
    {
        return is_float($this->model->$propertyName) ? floatval($this->model->$propertyName) : $defaultValue;
    }

    /**
     * $model の $propertyName が bool型として判断出来る場合は、その値を返す
     * そうでない場合は $defaultValue を返す
     * 
     * @param string $propertyName
     * @param ?bool $defaultValue
     */
    final protected function boolValue(string $propertyName, ?bool $defaultValue = null): ?bool
    {
        return is_bool($this->model->$propertyName) || intval($this->model->$propertyName) === 1 || intval($this->model->$propertyName) === 0 ? boolval($this->model->$propertyName) : $defaultValue;
    }

    /**
     * $model の $propertyName が array型として判断出来る場合は、その値を返す
     * そうでない場合は $defaultValue を返す
     * 
     * @param string $propertyName
     * @param ?array $defaultValue
     */
    final protected function arrayValue(string $propertyName, ?array $defaultValue = null): ?array
    {
        return is_array($this->model->$propertyName) ? $this->model->$propertyName : $defaultValue;
    }

    /**
     * $model の $propertyName が timestamp型として判断出来る場合は、その値のCarbonを返す
     * そうでない場合は null を返す
     * 
     * @param string $propertyName
     */
    final protected function timestampValue(string $propertyName): ?Carbon
    {
        try {
            return new Carbon($this->model->$propertyName);
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * $model の $propertyName が Enumとして判断出来る場合は、その値を返す
     * そうでない場合は $defaultValue を返す
     * 
     * @param string $propertyName
     * @param string $enumType
     * @param ?\UnitEnum $defaultValue
     */
    final protected function enumValue(string $propertyName, string $enumType, ?UnitEnum $defaultValue = null): ?UnitEnum
    {
        return $this->model->$propertyName instanceof $enumType ? $this->model->$propertyName : $defaultValue;
    }

    /**
     * $model の $propertyName が Modelとして判断出来る場合は、その値を返す
     * そうでない場合は $defaultValue を返す
     * 
     * @param string $propertyName
     * @param string $entityType
     */
    final protected function entityValue(string $propertyName, string $entityType): ?static
    {
        return $this->model->$propertyName instanceof Model ? new $entityType($this->model->$propertyName) : null;
    }
}
