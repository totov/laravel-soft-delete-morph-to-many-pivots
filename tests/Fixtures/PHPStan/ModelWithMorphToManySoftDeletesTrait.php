<?php

namespace Totov\LaravelSoftDeleteMorphToManyPivots\Tests\Fixtures\PHPStan;

use Illuminate\Database\Eloquent\Model;
use Totov\LaravelSoftDeleteMorphToManyPivots\Traits\MorphToManySoftDeletesTrait;

class ModelWithMorphToManySoftDeletesTrait extends Model
{
    use MorphToManySoftDeletesTrait;
}
