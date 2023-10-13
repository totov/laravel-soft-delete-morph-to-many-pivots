<?php

namespace Totov\LaravelSoftDeleteMorphToManyPivots\Commands;

use Illuminate\Console\Command;

class LaravelSoftDeleteMorphToManyPivotsCommand extends Command
{
    public $signature = 'laravel-soft-delete-morph-to-many-pivots';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
