<?php

namespace Totov\LaravelSoftDeleteMorphToManyPivots\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Totov\LaravelSoftDeleteMorphToManyPivots\LaravelSoftDeleteMorphToManyPivots
 */
class LaravelSoftDeleteMorphToManyPivots extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Totov\LaravelSoftDeleteMorphToManyPivots\LaravelSoftDeleteMorphToManyPivots::class;
    }
}
