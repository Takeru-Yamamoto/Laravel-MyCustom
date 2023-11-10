<?php

namespace MyCustom\Http\Forms;

use Illuminate\Support\Facades\Validator as Validation;

use Illuminate\Validation\Validator;
use Illuminate\Validation\ValidationException;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

use MyCustom\Utils\Facades\Crypt;


/**
 * Formクラスで使用する基底クラス
 * 
 * Controllerで受け取るRequestはすべてFormクラスでバリデーションを行う
 */
abstract class BaseForm
{
    /**
     * バリデーションに使用するvalidator
     *
     * @var Validator
     */
    protected Validator $validator;

    /**
     * Controllerから受け取ったリクエスト
     *
     * @var Request
     */
    protected Request $request;

    /**
     * Requestから抽出されたもの
     * また、バリデーションを通過したもの
     *
     * @var array
     */
    protected array $input;


    function __construct(Request|array $input)
    {
        if ($input instanceof Request) {
            $this->request = $input;
            $this->input   = $this->request->all();
        } else {
            $this->request = request();
            $this->input   = $input;
        }

        $this->prepareValidation();

        $this->validator = Validation::make($this->input, array_merge(
            $this->rules(),
            $this->additionalRules(),
        ), $this->messages(), $this->attributes());

        if ($this->isValidationFailure()) $this->validationFailed();

        $this->input = $this->validator->validated();

        $this->bind();

        $this->afterBinding();
    }


    /**
     * Requestを返す
     *
     * @return Request
     */
    final public function request(): Request
    {
        return $this->request;
    }

    /**
     * バリデーションに失敗したかどうか
     */
    final public function isValidationFailure(): bool
    {
        return $this->validator->fails();
    }


    /**
     * バリデーションを行う前に行う処理
     * 必要に応じでオーバーライドする
     */
    protected function prepareValidation(): void
    {
    }

    /**
     * 各プロパティにvalidatedをバインドした後に行う処理
     * 必要に応じでオーバーライドする
     */
    protected function afterBinding(): void
    {
    }


    /**
     * バリデーションに失敗した際の処理
     * 必要に応じでオーバーライドする
     */
    protected function validationFailed(): void
    {
        $this->validator->validate();
    }

    /**
     * バリデーションに失敗した際のexceptionを返す
     * 
     * @param array $messages
     */
    final protected function validationException(array $messages = []): ValidationException
    {
        if (empty($messages)) $messages = $this->validator->errors()->toArray();

        return ValidationException::withMessages($messages);
    }

    /**
     * バリデーションに失敗した際のリダイレクト処理
     * 
     * @param string $url
     * @param array $messages
     */
    final protected function validationFailureRedirect(string $url, array $messages = []): void
    {
        throw $this->validationException($messages)->redirectTo($url);
    }

    /**
     * バリデーションに失敗した際のリダイレクト処理
     * 
     * @param string $route
     * @param array $params
     * @param array $messages
     */
    final protected function validationFailureRoute(string $route, array $params = [], array $messages = []): void
    {
        $this->validationFailureRedirect(route($route, $params), $messages);
    }

    /**
     * APP_KEYを用いて暗号化された encrypted を復号する
     *
     * @param string|int $key
     */
    final protected function decryptParams(string|int $key): void
    {
        try {
            $encrypted = $this->inputString($key);

            if (is_null($encrypted)) return;

            $decrypt = Crypt::decryptParams($encrypted);

            if (!is_array($decrypt)) return;

            foreach ($decrypt as $key => $value) {
                if (!isset($this->input[$key])) $this->input[$key] = $value;
            }
        } catch (\Exception $ex) {
            return;
        }
    }


    abstract protected function bind(): void;
    abstract protected function rules(): array;

    /**
     * BaseForm以外のabstract Formクラスを使用する場合にオーバーライドして使用する
     */
    protected function additionalRules(): array
    {
        return [];
    }

    protected function attributes(): array
    {
        return [];
    }

    /**
     * BaseForm以外のabstract Formクラスを使用する場合にオーバーライドして使用する
     */
    protected function additionalAttributes(): array
    {
        return [];
    }

    protected function messages(): array
    {
        return [];
    }

    /**
     * BaseForm以外のabstract Formクラスを使用する場合にオーバーライドして使用する
     */
    protected function additionalMessages(): array
    {
        return [];
    }



    /*----------------------------------------
     * Property Getter
     *----------------------------------------*/

    /**
     * $this->input に $key がキーとして存在するかどうか
     *
     * @param string|int $key
     */
    final protected function issetInput(string|int $key): bool
    {
        return isset($this->input[$key]);
    }

    /**
     * $key に対応する $this->input の value を返す
     * 存在しない場合は null を返す
     *
     * @param string|int $key
     */
    final protected function input(string|int $key): mixed
    {
        return $this->issetInput($key) ? $this->input[$key] : null;
    }

    /**
     * $key に対応し、string型である $this->input の value を返す
     * 存在しない場合は空文字を返す
     *
     * @param string|int $key
     * @param string $default
     * 
     */
    final protected function inputString(string|int $key, string $default = ""): string
    {
        return $this->issetInput($key) && is_string($this->input[$key]) ? strval($this->input[$key]) : $default;
    }

    /**
     * $key に対応し、string型である $this->input の value を返す
     * 存在しない場合は null を返す
     *
     * @param string|int $key
     */
    final protected function inputNullableString(string|int $key): ?string
    {
        return $this->issetInput($key) && is_string($this->input[$key]) ? strval($this->input[$key]) : null;
    }

    /**
     * $key に対応し、int型である $this->input の value を返す
     * 存在しない場合は0を返す
     *
     * @param string|int $key
     * @param int $default
     */
    final protected function inputInt(string|int $key, int $default = 0): int
    {
        return $this->issetInput($key) && is_numeric($this->input[$key]) ? intval($this->input[$key]) : $default;
    }

    /**
     * $key に対応し、int型である $this->input の value を返す
     * 存在しない場合は null を返す
     *
     * @param string|int $key
     */
    final protected function inputNullableInt(string|int $key): ?int
    {
        return $this->issetInput($key) && is_numeric($this->input[$key]) ? intval($this->input[$key]) : null;
    }

    /**
     * $key に対応し、int型である $this->input の value を返す
     * 存在しない場合は0を返す
     *
     * @param string|int $key
     * @param float $default
     */
    final protected function inputFloat(string|int $key, float $default = 0): float
    {
        return $this->issetInput($key) && is_numeric($this->input[$key]) ? floatval($this->input[$key]) : $default;
    }

    /**
     * $key に対応し、int型である $this->input の value を返す
     * 存在しない場合は null を返す
     *
     * @param string|int $key
     */
    final protected function inputNullableFloat(string|int $key): ?float
    {
        return $this->issetInput($key) && is_numeric($this->input[$key]) ? floatval($this->input[$key]) : null;
    }

    /**
     * $key に対応し、bool型である $this->input の value を返す
     * 存在しない場合はfalseを返す
     *
     * @param string|int $key
     * @param bool $default
     */
    final protected function inputBool(string|int $key, bool $default = false): bool
    {
        return $this->issetInput($key) && is_bool($this->input[$key]) ? boolval($this->input[$key]) : $default;
    }

    /**
     * $key に対応し、bool型である $this->input の value を返す
     * 存在しない場合は null を返す
     *
     * @param string|int $key
     */
    final protected function inputNullableBool(string|int $key): ?bool
    {
        return $this->issetInput($key) && is_bool($this->input[$key]) ? boolval($this->input[$key]) : null;
    }

    /**
     * $key に対応し、array型である $this->input の value を返す
     * 存在しない場合は空配列を返す
     *
     * @param string|int $key
     * @param array $default
     */
    final protected function inputArray(string|int $key, array $default = []): array
    {
        return $this->issetInput($key) && is_array($this->input[$key]) ? $this->input[$key] : $default;
    }

    /**
     * $key に対応し、array型である $this->input の value を返す
     * 存在しない場合は null を返す
     *
     * @param string|int $key
     */
    final protected function inputNullableArray(string|int $key): ?array
    {
        return $this->issetInput($key) && is_array($this->input[$key]) ? $this->input[$key] : null;
    }

    /**
     * $key に対応し、UnitEnumクラスである $this->input の value を返す
     * 存在しない場合は null を返す
     *
     * @param string|int $key
     * @param string $enumClass
     */
    final protected function inputEnumFrom(string|int $key, string $enumClass): ?\UnitEnum
    {
        return $this->issetInput($key) && enum_exists($enumClass) ? $enumClass::tryFrom($this->input[$key]) : null;
    }

    /**
     * $key に対応し、UploadedFileクラスまたはUploadedFileクラスの配列である $this->input の value を返す
     * 存在しない場合は null を返す
     *
     * @param string|int $key
     */
    final protected function inputFile(string|int $key): UploadedFile|array|null
    {
        return $this->issetInput($key) && ($this->input[$key] instanceof UploadedFile || is_array($this->input[$key])) ? $this->input[$key] : null;
    }



    /*----------------------------------------
     * Validation Rule
     *----------------------------------------*/

    /* 
        field: 必須
        input: 空でない
    */
    final protected function required(mixed ...$rules): array
    {
        return arrayMergeUnique(["required"], multiDimensionsArrayMergeUnique($rules));
    }

    /* 
        field: 不要
        input: 空でもよい
    */
    final protected function nullable(mixed ...$rules): array
    {
        return arrayMergeUnique(["nullable"], multiDimensionsArrayMergeUnique($rules));
    }

    /* 
        field: 不要
        input: fieldあり => 空でない, fieldなし => 空でもよい
    */
    final protected function filled(mixed ...$rules): array
    {
        return arrayMergeUnique(["filled"], multiDimensionsArrayMergeUnique($rules));
    }

    /* 
        field: 必須
        input: 空でもよい
    */
    final protected function present(mixed ...$rules): array
    {
        return arrayMergeUnique(["present"], multiDimensionsArrayMergeUnique($rules));
    }


    // useful
    final protected function id(string $tableName): array
    {
        return ["integer", $this->exists($tableName, "id")];
    }
    final protected function userId(): array
    {
        return $this->id("users");
    }
    final protected function email(): array
    {
        return ["string", "email", "max:255"];
    }
    final protected function tel(): array
    {
        return ["string", "regex:/^[0-9]{2,3}-[0-9]{3,4}-[0-9]{4}$/"];
    }
    final protected function password(int $min = 8, int $max = 32): array
    {
        return ["string", "min:" . $min, "max:" . $max];
    }
    final protected function passwordConfirmed(int $min = 8, int $max = 32): array
    {
        return ["string", "min:" . $min, "max:" . $max, "confirmed"];
    }
    final protected function passwordLetters(int $min = 8): array
    {
        return [Rules\Password::min($min)->letters()];
    }
    final protected function passwordMixedCase(int $min = 8): array
    {
        return [Rules\Password::min($min)->mixedCase()];
    }
    final protected function passwordNumbers(int $min = 8): array
    {
        return [Rules\Password::min($min)->numbers()];
    }
    final protected function passwordSymbols(int $min = 8): array
    {
        return [Rules\Password::min($min)->symbols()];
    }
    final protected function passwordUncompromised(int $min = 8): array
    {
        return [Rules\Password::min($min)->uncompromised()];
    }
    final protected function postCode(): array
    {
        return ["string", "regex:/^[0-9]{3}-[0-9]{4}$/"];
    }
    final protected function code(mixed $digit): array
    {
        return ["string", "regex:/^[0-9]{" . $digit . "}$/"];
    }


    /* string */
    final protected function string(): array
    {
        return ["string", "max:255"];
    }
    final protected function currentPassword(string $guard = "web"): array
    {
        return ["current_password:" . $guard];
    }
    final protected function longtext(): array
    {
        return ["string"];
    }
    final protected function lowercase(): array
    {
        return ["lowercase"];
    }
    final protected function uppercase(): array
    {
        return ["uppercase"];
    }
    final protected function json(): array
    {
        return ["json"];
    }
    final protected function alpha(): array
    {
        return ["regex:/^[a-zA-Z]+$/"];
    }
    final protected function alphaNum(): array
    {
        return ["regex:/^[a-zA-Z0-9]+$/"];
    }
    final protected function alphaDash(): array
    {
        return ["regex:/^[a-zA-Z0-9\-_]+$/"];
    }
    final protected function ip(): array
    {
        return ["ip"];
    }
    final protected function ascii(): array
    {
        return ["ascii"];
    }
    final protected function url(): array
    {
        return ["url"];
    }
    final protected function activeUrl(): array
    {
        return ["active_url"];
    }
    final protected function ipv4(): array
    {
        return ["ipv4"];
    }
    final protected function ipv6(): array
    {
        return ["ipv6"];
    }
    final protected function ulid(): array
    {
        return ["ulid"];
    }
    final protected function uuid(): array
    {
        return ["uuid"];
    }
    final protected function macAddress(): array
    {
        return ["mac_address"];
    }

    /* int */
    final protected function integer(): array
    {
        return ["integer"];
    }
    final protected function numeric(): array
    {
        return ["numeric"];
    }
    final protected function tinyInteger(): array
    {
        return ["integer", "in:0,1"];
    }
    final protected function multipleOf(int $num): array
    {
        return ["multiple_of" . $num];
    }
    final protected function decimal(int $min, int $max = null): array
    {
        return is_null($max) ? ["decimal:" . $min] : ["decimal:" . $min . "," . $max];
    }
    final protected function digits(int $min, int $max = null): array
    {
        return is_null($max) ? ["digits:" . $min] : ["digits_between:" . $min . "," . $max];
    }
    final protected function maxDigits(int $digit): array
    {
        return ["max_digits:" . $digit];
    }
    final protected function minDigits(int $digit): array
    {
        return ["min_digits:" . $digit];
    }

    /* bool */
    final protected function boolean(): array
    {
        return ["boolean"];
    }

    /* array */
    final protected function array(array $acceptKeys = []): array
    {
        return empty($acceptKeys) ? ["array"] : ["array:" . implode(",", $acceptKeys)];
    }
    final protected function inArray(string $arrayField, string $key): array
    {
        return ["in_array:" . $arrayField . "." . $key];
    }
    final protected function distinct(string $rule = null): array
    {
        return is_null($rule) || !in_array($rule, ["strict", "ignore_case"]) ? ["distinct"] : ["distinct:" . $rule];
    }
    final protected function size(int $size): array
    {
        return ["size:" . $size];
    }

    /* datetime */
    final protected function dateFormat(string $format): array
    {
        return ["date_format:" . $format];
    }
    final protected function date(): array
    {
        return $this->dateFormat("Y-m-d");
    }
    final protected function time(): array
    {
        return $this->dateFormat("H:i:s");
    }
    final protected function datetime(): array
    {
        return $this->dateFormat("Y-m-d H:i:s");
    }
    final protected function yearMonth(): array
    {
        return $this->dateFormat("Y-m");
    }
    final protected function monthDay(): array
    {
        return $this->dateFormat("m-d");
    }
    final protected function hourMunite(): array
    {
        return $this->dateFormat("H:i");
    }
    final protected function muniteSecond(): array
    {
        return $this->dateFormat("i:s");
    }
    final protected function year(): array
    {
        return $this->dateFormat("Y");
    }
    final protected function month(): array
    {
        return $this->dateFormat("n");
    }
    final protected function day(): array
    {
        return $this->dateFormat("j");
    }
    final protected function hour(): array
    {
        return $this->dateFormat("G");
    }
    final protected function minute(): array
    {
        return $this->dateFormat("i");
    }
    final protected function second(): array
    {
        return $this->dateFormat("d");
    }
    final protected function dateEqual(string $date): array
    {
        return ["date_equals:" . $date];
    }
    final protected function after(string $dateOrField): array
    {
        return ["after:" . $dateOrField];
    }
    final protected function afterOrEqual(string $dateOrField): array
    {
        return ["after_or_equal:" . $dateOrField];
    }
    final protected function before(string $dateOrField): array
    {
        return ["before:" . $dateOrField];
    }
    final protected function beforeOrEqual(string $dateOrField): array
    {
        return ["before_or_equal:" . $dateOrField];
    }
    final protected function timezone(): array
    {
        return ["timezone"];
    }

    /* file */
    final protected function file(): array
    {
        return ["file"];
    }
    final protected function image(): array
    {
        return ["image"];
    }
    final protected function mimes(array $mimes): array
    {
        return ["mimes:" . implode(",", $mimes)];
    }
    final protected function mime(string $mime): array
    {
        return $this->mimes([$mime]);
    }
    final protected function mimetypes(array $mimetypes): array
    {
        return ["mimetypes:" . implode(",", $mimetypes)];
    }
    final protected function mimetype(string $mimetype): array
    {
        return $this->mimetypes([$mimetype]);
    }
    final protected function dimensions(): Rules\Dimensions
    {
        return Rule::dimensions();
    }

    /* other */
    final protected function requiredIf(string $field, array $values): array
    {
        return ["required_if:" . $field . "," . implode(",", $values)];
    }
    final protected function requiredUnless(string $field, array $values): array
    {
        return ["required_unless:" . $field . "," . implode(",", $values)];
    }
    final protected function requiredWith(array|string $fields): array
    {
        if (is_array($fields)) $fields = implode(",", $fields);

        return ["required_with:" . $fields];
    }
    final protected function requiredWithAll(array|string $fields): array
    {
        if (is_array($fields)) $fields = implode(",", $fields);

        return ["required_with_all:" . $fields];
    }
    final protected function requiredWithout(array|string $fields): array
    {
        if (is_array($fields)) $fields = implode(",", $fields);

        return ["required_without:" . $fields];
    }
    final protected function requiredWithoutAll(array|string $fields): array
    {
        if (is_array($fields)) $fields = implode(",", $fields);

        return ["required_without_all:" . $fields];
    }
    final protected function requiredArrayKeys(array|string $keys): array
    {
        if (is_array($keys)) $keys = implode(",", $keys);

        return ["required_array_keys:" . $keys];
    }

    final protected function exists(string $table, string $column): Rules\Exists
    {
        return Rule::exists($table, $column);
    }
    final protected function existsNotDeleted(string $table, string $column): Rules\Exists
    {
        return $this->exists($table, $column)->whereNull("deleted_at");
    }
    final protected function unique(string $table, string $column): Rules\Unique
    {
        return Rule::unique($table, $column);
    }
    final protected function uniqueNotDeleted(string $table, string $column): Rules\Unique
    {
        return $this->unique($table, $column)->whereNull("deleted_at");
    }

    final protected function regex(string $regex): array
    {
        return ["regex:" . $regex];
    }
    final protected function notRegex(string $regex): array
    {
        return ["not_regex:" . $regex];
    }

    final protected function max(string $num): array
    {
        return ["max:" . $num];
    }
    final protected function min(string $num): array
    {
        return ["min:" . $num];
    }

    final protected function gt(string $field): array
    {
        return ["gt:" . $field];
    }
    final protected function gte(string $field): array
    {
        return ["gte:" . $field];
    }
    final protected function lt(string $field): array
    {
        return ["lt:" . $field];
    }
    final protected function lte(string $field): array
    {
        return ["lte:" . $field];
    }

    final protected function accepted(): array
    {
        return ["accepted"];
    }
    final protected function acceptedIf(string $field, mixed $value): array
    {
        return ["accepted_if:" . $field . "," . $value];
    }
    final protected function declined(): array
    {
        return ["declined"];
    }
    final protected function declinedIf(string $field, mixed $value): array
    {
        return ["declined_if:" . $field . "," . $value];
    }

    final protected function between(int $min, int $max): array
    {
        return ["between:" . $min . "," . $max];
    }
    final protected function in(array $values): Rules\In
    {
        return Rule::in($values);
    }
    final protected function notIn(array $values): Rules\NotIn
    {
        return Rule::notIn($values);
    }

    final protected function confirmed(): array
    {
        return ["confirmed"];
    }
    final protected function different(string $field): array
    {
        return ["different:" . $field];
    }
    final protected function same(string $field): array
    {
        return ["same:" . $field];
    }

    final protected function startsWith(array|string $values): array
    {
        if (is_array($values)) $values = implode(",", $values);

        return ["starts_with:" . $values];
    }
    final protected function doesntStartWith(array|string $values): array
    {
        if (is_array($values)) $values = implode(",", $values);

        return ["doesnt_start_with:" . $values];
    }
    final protected function endsWith(array|string $values): array
    {
        if (is_array($values)) $values = implode(",", $values);

        return ["ends_with:" . $values];
    }
    final protected function doesntEndWith(array|string $values): array
    {
        if (is_array($values)) $values = implode(",", $values);

        return ["doesnt_end_with:" . $values];
    }

    final protected function enum(string $enumClass): Rules\Enum
    {
        return Rule::enum($enumClass);
    }
}
