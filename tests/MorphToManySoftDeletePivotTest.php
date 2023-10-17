<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Totov\LaravelSoftDeleteMorphToManyPivots\MorphToManySoftDeletes;
use Totov\LaravelSoftDeleteMorphToManyPivots\Traits\MorphToManySoftDeletesTrait;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

uses(RefreshDatabase::class);

class UserType extends Model
{
    use MorphToManySoftDeletesTrait;

    public function users(): MorphToManySoftDeletes
    {
        return $this->morphedByManySoft(User::class, 'types');
    }
}

class User extends Model
{
    use MorphToManySoftDeletesTrait;

    public function user_types(): MorphToManySoftDeletes
    {
        return $this->morphToManySoft(UserType::class, 'types');
    }
}

it('can soft delete and restore morphToMany relationship pivots', function () {

    $user = User::create();

    $userType = UserType::create();
    $secondUserType = UserType::create();

    $user->user_types()->attach($userType);

    expect($user->user_types->count())->toBe(1);
    expect($userType->users->count())->toBe(1);

    /**
     * @var MorphPivot $pivot
     *
     * @phpstan-ignore-next-line
     */
    $pivot = $user->user_types->first()->pivot;

    expect($pivot)->not->toBeNull();
    expect($pivot->getAttribute('deleted_at'))->toBeNull();

    $user->user_types()->detach($userType);

    assertDatabaseHas('users', [
        'id' => 1,
        'created_at' => now(),
        'updated_at' => now(),
        'deleted_at' => null,
    ]);

    assertDatabaseHas('user_types', [
        'id' => 1,
        'created_at' => now(),
        'updated_at' => now(),
        'deleted_at' => null,
    ]);

    assertDatabaseHas('user_types', [
        'id' => 2,
        'created_at' => now(),
        'updated_at' => now(),
        'deleted_at' => null,
    ]);

    assertDatabaseHas('types', [
        'user_type_id' => 1,
        'types_id' => 1,
        'types_type' => User::class,
        'deleted_at' => now(),
    ]);

    $pivot->refresh();

    expect($pivot)->not->toBeNull();
    expect($pivot->getAttribute('deleted_at'))->not->toBeNull();

    $user->refresh()->load('user_types');

    expect($user->user_types->count())->toBe(0);

    $user->user_types()->attach($userType);
    $user->user_types()->attach($secondUserType);

    expect($user->refresh()->user_types->count())->toBe(2);

    $user->user_types()->sync([]);

    expect($user->refresh()->user_types->count())->toBe(0);

    assertDatabaseCount('types', 3);

    $user->user_types()->sync([$secondUserType->id]);

    assertDatabaseCount('types', 4);

    assertDatabaseHas('types', [
        'user_type_id' => 1,
        'types_id' => 1,
        'types_type' => User::class,
        'deleted_at' => now(),
    ]);

    assertDatabaseHas('types', [
        'user_type_id' => 1,
        'types_id' => 1,
        'types_type' => User::class,
        'deleted_at' => now(),
    ]);

    assertDatabaseHas('types', [
        'user_type_id' => 2,
        'types_id' => 1,
        'types_type' => User::class,
        'deleted_at' => now(),
    ]);

    assertDatabaseHas('types', [
        'user_type_id' => 2,
        'types_id' => 1,
        'types_type' => User::class,
        'deleted_at' => null,
    ]);

    expect($user->refresh()->user_types->count())->toBe(1);

    expect($userType->refresh()->users->count())->toBe(0);
    expect($secondUserType->refresh()->users->count())->toBe(1);

    $user->user_types()->toggle($secondUserType->id);

    expect($user->refresh()->user_types->count())->toBe(0);

    expect($secondUserType->refresh()->users->count())->toBe(0);

    $user->user_types()->toggle($secondUserType->id);

    expect($user->refresh()->user_types->count())->toBe(1);

    expect($secondUserType->refresh()->users->count())->toBe(1);
});
