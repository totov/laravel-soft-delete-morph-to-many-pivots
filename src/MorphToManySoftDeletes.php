<?php

namespace Totov\LaravelSoftDeleteMorphToManyPivots;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class MorphToManySoftDeletes extends MorphToMany
{
    public function __construct(Builder $query, Model $parent, $name, $table, $foreignPivotKey,
        $relatedPivotKey, $parentKey, $relatedKey, $relationName = null, $inverse = false)
    {
        parent::__construct(...func_get_args());

        $query->whereNull(
            $this->qualifyPivotColumn('deleted_at')
        );
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
        $query = $this->newPivotQuery();

        if (! is_null($ids)) {
            $ids = $this->parseIds($ids);

            if (empty($ids)) {
                return 0;
            }

            $query->whereIn($this->getQualifiedRelatedPivotKeyName(), (array) $ids);

            $results = $query->update([
                $this->qualifyPivotColumn('deleted_at') => now(),
            ]);
        }

        if ($touch) {
            $this->touchIfTouching();
        }

        /**
         * @phpstan-ignore-next-line
         */
        return $results;
    }
}
