<?php

namespace Totov\LaravelSoftDeleteMorphToManyPivots;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @method Builder withoutTrashed()
 * @method Builder withTrashed(bool $withTrashed = true)
 * @method Builder onlyTrashed()
 */
class MorphToManySoftDeletes extends MorphToMany
{
    private static $deletedAtCallback = null;

    public static function setDeletedAtCallback(callable $closure): void
    {
        self::$deletedAtCallback = $closure;
    }

    public static function resetDeletedAtCallback(): void
    {
        self::$deletedAtCallback = null;
    }

    public function __construct(Builder $query, Model $parent, $name, $table, $foreignPivotKey,
        $relatedPivotKey, $parentKey, $relatedKey, $relationName = null, $inverse = false)
    {
        parent::__construct(...func_get_args());

        $query->macro('withoutTrashed', [$this, 'addWithoutTrashed']);

        $query->macro('withTrashed', [$this, 'addWithTrashed']);

        $query->macro('onlyTrashed', [$this, 'addOnlyTrashed']);

        /** @phpstan-ignore-next-line */
        $query->withoutTrashed();
    }

    public function newPivotStatement()
    {
        return $this->query->getQuery()->newQuery()->from($this->table)->whereNull($this->qualifyPivotColumn('deleted_at'));
    }

    public function newPivotQuery()
    {
        return parent::newPivotQuery()->whereNull($this->qualifyPivotColumn('deleted_at'));
    }

    /**
     * SoftDeletes pivot model.
     *
     * @return bool|null
     *
     * @phpstan-ignore-next-line
     * */
    public function detach($ids = null, $touch = true): int
    {
        $results = 0;

        $query = $this->newPivotQuery();

        if (! is_null($ids)) {
            $ids = $this->parseIds($ids);

            if (empty($ids)) {
                return 0;
            }

            $query->whereIn($this->getQualifiedRelatedPivotKeyName(), (array) $ids);

            $callback = self::$deletedAtCallback;

            $results = $query->update([
                $this->qualifyPivotColumn('deleted_at') => $callback ? $callback() : now(),
            ]);
        }

        if ($touch) {
            $this->touchIfTouching();
        }

        return $results;
    }

    public function addWithoutTrashed(Builder $builder): Builder
    {
        $builder->withGlobalScope('morph_to_many_soft_deletes', function (Builder $builder) {
            $builder->whereNull(
                $this->qualifyPivotColumn('deleted_at')
            );
        });

        return $builder;
    }

    public function addWithTrashed(Builder $builder): Builder
    {
        return $builder->withoutGlobalScope('morph_to_many_soft_deletes');
    }

    public function addOnlyTrashed(Builder $builder): Builder
    {
        $builder->withoutGlobalScope('morph_to_many_soft_deletes')->whereNotNull(
            $this->qualifyPivotColumn('deleted_at')
        );

        return $builder;
    }

    protected function performJoin($query = null)
    {
        $query = $query ?: $this->query;

        // We need to join to the intermediate table on the related model's primary
        // key column with the intermediate table's foreign key for the related
        // model instance. Then we can set the "where" for the parent models.
        $query->join($this->table, $this->getQualifiedRelatedKeyName(), '=', $this->getQualifiedRelatedPivotKeyName());

        $query->macro('withoutTrashed', [$this, 'addWithoutTrashed']);

        $query->macro('withTrashed', [$this, 'addWithTrashed']);

        $query->macro('onlyTrashed', [$this, 'addOnlyTrashed']);

        /** @phpstan-ignore-next-line */
        return $query->withoutTrashed();
    }
}
