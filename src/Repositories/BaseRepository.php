<?php

namespace MyCustom\Repositories;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Support\Collection;

use Carbon\Carbon;

use MyCustom\Repositories\Entities\BaseEntity;
use MyCustom\Repositories\Enums\OperatorEnum;

/**
 * 基底Repositoryクラス
 * 
 * Eloquentをwrapし、データベースからデータを取り出す担当。
 * Repositoryは原則Serviceクラスでのみ操作する。
 * Repositoryはデータを取り出しServiceに渡す際にデフォルトのModel|Collectionだけでなく、オリジナルのDTOであるEntityクラスとして渡すことができる。
 * 
 */
abstract class BaseRepository
{
    /**
     * 関連するModelのクラス名
     *
     * @var string
     */
    protected string $modelClass;

    /**
     * 関連するEntityのクラス名
     *
     * @var string
     */
    protected string $entityClass;

    /**
     * クエリビルダ
     *
     * @var Builder
     */
    private Builder $query;

    /**
     * 関連するModel
     *
     * @var Model
     */
    private Model $model;

    /**
     * 関連するデータベース名
     *
     * @var string
     */
    private string $tableName;


    function __construct()
    {
        $this->model     = $this->model();
        $this->tableName = $this->model->getTable();

        $this->initialize();
    }


    /**
     * 各変数の初期化処理
     * 必要に応じて各Repositoryにてoverrideする
     */
    protected function initialize(): void
    {
        $this->query = $this->model::query();
    }

    /**
     * 各変数の初期化処理
     */
    final public function reset(): static
    {
        $this->initialize();
        return $this;
    }

    /**
     * CollectionをEntityクラスのCollectionに変換する
     *
     * @param Collection $collection
     */
    final public function toEntityCollection(EloquentCollection $collection): Collection
    {
        $array = array_map(
            function ($entity) {
                return $this->toEntity($entity);
            },
            $collection->all()
        );

        return new Collection($array);
    }

    /**
     * Builderを取得
     */
    final public function query(): Builder
    {
        return $this->query;
    }

    /**
     * 関連するModelを定義する
     *
     * @return Model
     */
    final public function model(): Model
    {
        return new $this->modelClass();
    }

    /**
     * Modelから必要な情報のみを抽出したEntityクラスにconvertする
     *
     * @param ?Model $model
     */
    final public function toEntity(?Model $model): BaseEntity
    {
        return new $this->entityClass($model);
    }


    /**
     * tableNameを取得
     */
    final public function tableName(): string
    {
        return $this->tableName;
    }

    /**
     * 現在のBuilderを用いてEntityクラスのCollectionを取得する
     * column と value がnull出ない場合、取得前にwhereメソッドを実行する
     *
     * @param string|null $column
     * @param mixed $value
     */
    final public function get(?string $column = null, mixed $value = null): Collection
    {
        return $this->toEntityCollection($this->getRaw($column, $value));
    }

    /**
     * 現在のBuilderを用いてCollectionを取得する
     * column と value がnull出ない場合、取得前にwhereメソッドを実行する
     *
     * @param string|null $column
     * @param mixed $value
     */
    final public function getRaw(?string $column = null, mixed $value = null): EloquentCollection
    {
        if (!is_null($column) && !is_null($value)) $this->where($column, $value);

        $result = $this->query->get();

        $this->reset();
        return $result;
    }

    /**
     * 現在のBuilderを用いてEntityクラスを取得する
     * column と value がnull出ない場合、取得前にwhereメソッドを実行する
     *
     * @param string|null $column
     * @param mixed $value
     */
    final public function find(?string $column = null, mixed $value = null): BaseEntity
    {
        $result = $this->findRaw($column, $value);

        return $this->toEntity($result);
    }

    /**
     * 現在のBuilderを用いてModelクラスを取得する
     * column と value がnull出ない場合、取得前にwhereメソッドを実行する
     *
     * @param string|null $column
     * @param mixed $value
     */
    final public function findRaw(?string $column = null, mixed $value = null): Model|null
    {
        if (!is_null($column) && !is_null($value)) $this->where($column, $value);

        $result = $this->query->first();
        $this->reset();
        return $result;
    }

    /**
     * 現在のBuilderを用いて該当するレコード数を取得する
     * column と value がnull出ない場合、取得前にwhereメソッドを実行する
     *
     * @param string|null $column
     * @param mixed $value
     */
    final public function count(?string $column = null, mixed $value = null): int
    {
        if (!is_null($column) && !is_null($value)) $this->where($column, $value);

        $result = $this->query->count();
        $this->reset();
        return $result;
    }

    /**
     * 現在のBuilderを用いて該当するレコードが存在するかを取得する
     * column と value がnull出ない場合、取得前にwhereメソッドを実行する
     *
     * @param string|null $column
     * @param mixed $value
     */
    final public function isExist(?string $column = null, mixed $value = null): bool|null
    {
        if (!is_null($column) && !is_null($value)) $this->where($column, $value);

        $result = $this->query->exists();
        $this->reset();
        return $result;
    }

    /**
     * 現在のBuilderを用いて該当するレコードをページネーションで利用しやすい形で取得する
     *
     * @param integer $page
     * @param integer $limit
     */
    final public function paginate(int $page, int $limit): \stdClass
    {
        $result = new \stdClass();

        $copy = $this->query();
        $result->total = $this->count();

        $this->query = $copy;
        $result->items = $this->forPage($page, $limit)->get();

        return $result;
    }


    /**
     * 以下有用な定義済みメソッド
     */
    final public function valid(): static
    {
        return $this->where("is_valid", 1);
    }

    final public function invalid(): static
    {
        return $this->where("is_valid", 0);
    }

    final public function isValid(int $isValid): static
    {
        if ($isValid === 0) return $this->invalid();
        if ($isValid === 1) return $this->valid();

        return $this->where("is_valid", $isValid);
    }

    final public function expirationDateOver(): static
    {
        return $this->whereLessEqual("expiration_date", Carbon::now());
    }

    final public function notExpirationDateOver(): static
    {
        return $this->whereGreater("expiration_date", Carbon::now());
    }


    /**
     * Eloquentのwrap
     */
    final public function select(array|string $columns): static
    {
        $this->query = $this->query->select($columns);
        return $this;
    }

    final public function addSelect(array|string $columns): static
    {
        $this->query = $this->query->addSelect($columns);
        return $this;
    }


    final public function where(string $column, mixed $value, OperatorEnum $operator = OperatorEnum::EQUAL): static
    {
        $this->query = $this->query->where($column, $operator->value, $value);
        return $this;
    }

    final public function whereLike(string $column, mixed $value): static
    {
        if (!str_contains($value, "%")) return $this->where($column, "%" . $value . "%", OperatorEnum::LIKE);

        return $this->where($column, $value, OperatorEnum::LIKE);
    }

    final public function whereGreater(string $column, mixed $value): static
    {
        return $this->where($column, $value, OperatorEnum::GREATER_THAN);
    }

    final public function whereGreaterEqual(string $column, mixed $value): static
    {
        return $this->where($column, $value, OperatorEnum::GREATER_THAN_OR_EQUAL);
    }

    final public function whereLess(string $column, mixed $value): static
    {
        return $this->where($column, $value, OperatorEnum::LESS_THAN);
    }

    final public function whereLessEqual(string $column, mixed $value): static
    {
        return $this->where($column, $value, OperatorEnum::LESS_THAN_OR_EQUAL);
    }

    final public function whereClosure(\Closure $closure): static
    {
        $this->query = $this->query->where($closure);
        return $this;
    }

    final public function whereNot(string $column, mixed $value): static
    {
        $this->query = $this->query->whereNot($column, $value);
        return $this;
    }

    final public function whereIn(string $column, array $values): static
    {
        $this->query = $this->query->whereIn($column, $values);
        return $this;
    }

    final public function whereNotIn(string $column, array $values): static
    {
        $this->query = $this->query->whereNotIn($column, $values);
        return $this;
    }

    final public function whereBetween(string $column, mixed $start, mixed $end): static
    {
        $this->query = $this->query->whereBetween($column, [$start, $end]);
        return $this;
    }

    final public function whereNotBetween(string $column, mixed $start, mixed $end): static
    {
        $this->query = $this->query->whereNotBetween($column, [$start, $end]);
        return $this;
    }

    final public function whereNull(string $column): static
    {
        $this->query = $this->query->whereNull($column);
        return $this;
    }

    final public function whereNotNull(string $column): static
    {
        $this->query = $this->query->whereNotNull($column);
        return $this;
    }

    final public function whereColumn(string $column1, string $column2, OperatorEnum $operator = OperatorEnum::EQUAL): static
    {
        $this->query = $this->query->whereColumn($column1, $operator->value, $column2);
        return $this;
    }

    final public function whereColumnGreater(string $column1, string $column2): static
    {
        return $this->whereColumn($column1, $column2, OperatorEnum::GREATER_THAN);
    }

    final public function whereColumnGreaterEqual(string $column1, string $column2): static
    {
        return $this->whereColumn($column1, $column2, OperatorEnum::GREATER_THAN_OR_EQUAL);
    }

    final public function whereColumnLess(string $column1, string $column2): static
    {
        return $this->whereColumn($column1, $column2, OperatorEnum::LESS_THAN);
    }

    final public function whereColumnLessEqual(string $column1, string $column2): static
    {
        return $this->whereColumn($column1, $column2, OperatorEnum::LESS_THAN_OR_EQUAL);
    }

    final public function orWhere(string $column, mixed $value, OperatorEnum $operator = OperatorEnum::EQUAL): static
    {
        $this->query = $this->query->orWhere($column, $operator->value, $value);
        return $this;
    }

    final public function orWhereLike(string $column, mixed $value): static
    {
        return $this->orWhere($column, $value, OperatorEnum::LIKE);
    }

    final public function orWhereGreater(string $column, mixed $value): static
    {
        return $this->orWhere($column, $value, OperatorEnum::GREATER_THAN);
    }

    final public function orWhereGreaterEqual(string $column, mixed $value): static
    {
        return $this->orWhere($column, $value, OperatorEnum::GREATER_THAN_OR_EQUAL);
    }

    final public function orWhereLess(string $column, mixed $value): static
    {
        return $this->orWhere($column, $value, OperatorEnum::LESS_THAN);
    }

    final public function orWhereLessEqual(string $column, mixed $value): static
    {
        return $this->orWhere($column, $value, OperatorEnum::LESS_THAN_OR_EQUAL);
    }

    final public function orWhereClosure(\Closure $closure): static
    {
        $this->query = $this->query->orWhere($closure);
        return $this;
    }

    final public function orWhereNot(string $column, mixed $value): static
    {
        $this->query = $this->query->whereNot($column, $value);
        return $this;
    }

    final public function orWhereIn(string $column, array $values): static
    {
        $this->query = $this->query->orWhereIn($column, $values);
        return $this;
    }

    final public function orWhereNotIn(string $column, array $values): static
    {
        $this->query = $this->query->orWhereNotIn($column, $values);
        return $this;
    }

    final public function orWhereBetween(string $column, mixed $start, mixed $end): static
    {
        $this->query = $this->query->orWhereBetween($column, [$start, $end]);
        return $this;
    }

    final public function orWhereNotBetween(string $column, mixed $start, mixed $end): static
    {
        $this->query = $this->query->orWhereNotBetween($column, [$start, $end]);
        return $this;
    }

    final public function orWhereNull(string $column): static
    {
        $this->query = $this->query->orWhereNull($column);
        return $this;
    }

    final public function orWhereNotNull(string $column): static
    {
        $this->query = $this->query->orWhereNotNull($column);
        return $this;
    }

    final public function orWhereColumn(string $column1, string $column2, OperatorEnum $operator = OperatorEnum::EQUAL): static
    {
        $this->query = $this->query->orWhereColumn($column1, $operator->value, $column2);
        return $this;
    }

    final public function orWhereColumnGreater(string $column1, string $column2): static
    {
        return $this->orWhereColumn($column1, $column2, OperatorEnum::GREATER_THAN);
    }

    final public function orWhereColumnGreaterEqual(string $column1, string $column2): static
    {
        return $this->orWhereColumn($column1, $column2, OperatorEnum::GREATER_THAN_OR_EQUAL);
    }

    final public function orWhereColumnLess(string $column1, string $column2): static
    {
        return $this->orWhereColumn($column1, $column2, OperatorEnum::LESS_THAN);
    }

    final public function orWhereColumnLessEqual(string $column1, string $column2): static
    {
        return $this->orWhereColumn($column1, $column2, OperatorEnum::LESS_THAN_OR_EQUAL);
    }

    final public function whereJsonContains(string $jsonColumn, array $values): static
    {
        $this->query = $this->query->whereJsonContains($jsonColumn, $values);
        return $this;
    }

    final public function whereJsonLength(string $jsonColumn, int $length, OperatorEnum $operator = OperatorEnum::EQUAL): static
    {
        $this->query = $this->query->whereJsonLength($jsonColumn, $operator->value, $length);
        return $this;
    }

    final public function whereJsonLengthGreater(string $jsonColumn, int $length): static
    {
        return $this->whereJsonLength($jsonColumn, $length, OperatorEnum::GREATER_THAN);
    }

    final public function whereJsonLengthGreaterEqual(string $jsonColumn, int $length): static
    {
        return $this->whereJsonLength($jsonColumn, $length, OperatorEnum::GREATER_THAN_OR_EQUAL);
    }

    final public function whereJsonLengthLess(string $jsonColumn, int $length): static
    {
        return $this->whereJsonLength($jsonColumn, $length, OperatorEnum::LESS_THAN);
    }

    final public function whereJsonLengthLessEqual(string $jsonColumn, int $length): static
    {
        return $this->whereJsonLength($jsonColumn, $length, OperatorEnum::LESS_THAN_OR_EQUAL);
    }

    final public function whereDate(string $dateColumn, ?string $date, OperatorEnum $operator = OperatorEnum::EQUAL): static
    {
        $date = (new Carbon($date))->toDateString();
        $this->query = $this->query->whereDate($dateColumn, $operator->value, $date);
        return $this;
    }

    final public function whereDateGreater(string $dateColumn, ?string $date): static
    {
        return $this->whereDate($dateColumn, $date, OperatorEnum::GREATER_THAN);
    }

    final public function whereDateGreaterEqual(string $dateColumn, ?string $date): static
    {
        return $this->whereDate($dateColumn, $date, OperatorEnum::GREATER_THAN_OR_EQUAL);
    }

    final public function whereDateLess(string $dateColumn, ?string $date): static
    {
        return $this->whereDate($dateColumn, $date, OperatorEnum::LESS_THAN);
    }

    final public function whereDateLessEqual(string $dateColumn, ?string $date): static
    {
        return $this->whereDate($dateColumn, $date, OperatorEnum::LESS_THAN_OR_EQUAL);
    }

    final public function whereYear(string $dateColumn, ?int $year, OperatorEnum $operator = OperatorEnum::EQUAL): static
    {
        if (is_null($year)) $year = (new Carbon())->year;

        $this->query = $this->query->whereYear($dateColumn, $operator->value, $year);
        return $this;
    }

    final public function whereYearGreater(string $dateColumn, ?int $year): static
    {
        return $this->whereYear($dateColumn, $year, OperatorEnum::GREATER_THAN);
    }

    final public function whereYearGreaterEqual(string $dateColumn, ?int $year): static
    {
        return $this->whereYear($dateColumn, $year, OperatorEnum::GREATER_THAN_OR_EQUAL);
    }

    final public function whereYearLess(string $dateColumn, ?int $year): static
    {
        return $this->whereYear($dateColumn, $year, OperatorEnum::LESS_THAN);
    }

    final public function whereYearLessEqual(string $dateColumn, ?int $year): static
    {
        return $this->whereYear($dateColumn, $year, OperatorEnum::LESS_THAN_OR_EQUAL);
    }

    final public function whereMonth(string $dateColumn, ?int $month, OperatorEnum $operator = OperatorEnum::EQUAL): static
    {
        if (is_null($month)) $month = (new Carbon())->month;

        $this->query = $this->query->whereMonth($dateColumn, $operator->value, $month);
        return $this;
    }

    final public function whereMonthGreater(string $dateColumn, ?int $month): static
    {
        return $this->whereMonth($dateColumn, $month, OperatorEnum::GREATER_THAN);
    }

    final public function whereMonthGreaterEqual(string $dateColumn, ?int $month): static
    {
        return $this->whereMonth($dateColumn, $month, OperatorEnum::GREATER_THAN_OR_EQUAL);
    }

    final public function whereMonthLess(string $dateColumn, ?int $month): static
    {
        return $this->whereMonth($dateColumn, $month, OperatorEnum::LESS_THAN);
    }

    final public function whereMonthLessEqual(string $dateColumn, ?int $month): static
    {
        return $this->whereMonth($dateColumn, $month, OperatorEnum::LESS_THAN_OR_EQUAL);
    }

    final public function whereDay(string $dateColumn, ?int $day, OperatorEnum $operator = OperatorEnum::EQUAL): static
    {
        if (is_null($day)) $day = (new Carbon())->day;

        $this->query = $this->query->whereDay($dateColumn, $operator->value, $day);
        return $this;
    }

    final public function whereDayGreater(string $dateColumn, ?int $day): static
    {
        return $this->whereDay($dateColumn, $day, OperatorEnum::GREATER_THAN);
    }

    final public function whereDayGreaterEqual(string $dateColumn, ?int $day): static
    {
        return $this->whereDay($dateColumn, $day, OperatorEnum::GREATER_THAN_OR_EQUAL);
    }

    final public function whereDayLess(string $dateColumn, ?int $day): static
    {
        return $this->whereDay($dateColumn, $day, OperatorEnum::LESS_THAN);
    }

    final public function whereDayLessEqual(string $dateColumn, ?int $day): static
    {
        return $this->whereDay($dateColumn, $day, OperatorEnum::LESS_THAN_OR_EQUAL);
    }

    final public function whereTime(string $dateColumn, ?string $time, OperatorEnum $operator = OperatorEnum::EQUAL): static
    {
        $time = (new Carbon($time))->toTimeString();
        $this->query = $this->query->whereTime($dateColumn, $operator->value, $time);
        return $this;
    }

    final public function whereTimeGreater(string $dateColumn, ?string $time): static
    {
        return $this->whereTime($dateColumn, $time, OperatorEnum::GREATER_THAN);
    }

    final public function whereTimeGreaterEqual(string $dateColumn, ?string $time): static
    {
        return $this->whereTime($dateColumn, $time, OperatorEnum::GREATER_THAN_OR_EQUAL);
    }

    final public function whereTimeLess(string $dateColumn, ?string $time): static
    {
        return $this->whereTime($dateColumn, $time, OperatorEnum::LESS_THAN);
    }

    final public function whereTimeLessEqual(string $dateColumn, ?string $time): static
    {
        return $this->whereTime($dateColumn, $time, OperatorEnum::LESS_THAN_OR_EQUAL);
    }


    final public function orderBy(string $column, string $order): static
    {
        $this->query = $this->query->orderBy($column, $order);
        return $this;
    }

    final public function asc(string $column = "created_at"): static
    {
        return $this->orderBy($column, "asc");
    }

    final public function desc(string $column = "created_at"): static
    {
        return $this->orderBy($column, "desc");
    }


    final public function groupBy(string|array $columns): static
    {
        $this->query = $this->query->groupBy($columns);
        return $this;
    }

    final public function having(string $column, string|int|float|null $value, OperatorEnum $operator = OperatorEnum::EQUAL): static
    {
        $this->query = $this->query->having($column, $operator->value, $value);
        return $this;
    }

    final public function havingGreater(string $column, string|int|float|null $value): static
    {
        return $this->having($column, $value, OperatorEnum::GREATER_THAN);
    }

    final public function havingGreaterEqual(string $column, string|int|float|null $value): static
    {
        return $this->having($column, $value, OperatorEnum::GREATER_THAN_OR_EQUAL);
    }

    final public function havingLess(string $column, string|int|float|null $value): static
    {
        return $this->having($column, $value, OperatorEnum::LESS_THAN);
    }

    final public function havingLessEqual(string $column, string|int|float|null $value): static
    {
        return $this->having($column, $value, OperatorEnum::LESS_THAN_OR_EQUAL);
    }

    final public function havingBetween(string $column, mixed $start, mixed $end): static
    {
        $this->query = $this->query->havingBetween($column, [$start, $end]);
        return $this;
    }


    final public function limit(int $limit): static
    {
        $this->query = $this->query->limit($limit);
        return $this;
    }

    final public function offset(int $offset): static
    {
        $this->query = $this->query->offset($offset);
        return $this;
    }

    final public function forPage(int $page, int $limit): static
    {
        return $this->limit($limit)->offset(($page - 1) * $limit);
    }


    final public function selectRaw(string $sql, array $bindings = []): static
    {
        $this->query = $this->query->selectRaw($sql, $bindings);
        return $this;
    }

    final public function whereRaw(string $sql, array $bindings = []): static
    {
        $this->query = $this->query->whereRaw($sql, $bindings);
        return $this;
    }

    final public function orWhereRaw(string $sql, array $bindings = []): static
    {
        $this->query = $this->query->orWhereRaw($sql, $bindings);
        return $this;
    }

    final public function havingRaw(string $sql, array $bindings = []): static
    {
        $this->query = $this->query->havingRaw($sql, $bindings);
        return $this;
    }

    final public function orHavingRaw(string $sql, array $bindings = []): static
    {
        $this->query = $this->query->orHavingRaw($sql, $bindings);
        return $this;
    }

    final public function orderByRaw(string $sql, array $bindings = []): static
    {
        $this->query = $this->query->orderByRaw($sql, $bindings);
        return $this;
    }

    final public function groupByRaw(string $sql): static
    {
        $this->query = $this->query->groupByRaw($sql);
        return $this;
    }


    final public function join(string $table, string $tableColumn, string $column, OperatorEnum $operator = OperatorEnum::EQUAL): static
    {
        $this->query = $this->query->join($table, $this->tableName . "." . $column, $operator->value, $table . "." . $tableColumn);
        return $this;
    }

    final public function leftJoin(string $table, string $tableColumn, string $column, OperatorEnum $operator = OperatorEnum::EQUAL): static
    {
        $this->query = $this->query->leftJoin($table, $this->tableName . "." . $column, $operator->value, $table . "." . $tableColumn);
        return $this;
    }

    final public function rightJoin(string $table, string $tableColumn, string $column, OperatorEnum $operator = OperatorEnum::EQUAL): static
    {
        $this->query = $this->query->rightJoin($table, $this->tableName . "." . $column, $operator->value, $table . "." . $tableColumn);
        return $this;
    }

    final public function with(string $method): static
    {
        $this->query = $this->query->with($method);

        return $this;
    }

    final public function withTrashed(): static
    {
        $this->query = $this->query->withTrashed();

        return $this;
    }

    final public function onlyTrashed(): static
    {
        $this->query = $this->query->onlyTrashed();

        return $this;
    }
}
