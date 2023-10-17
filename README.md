# Allow morphToMany relationship pivots to be soft deleted.

## Installation

You can install the package via composer:

```bash
composer require totov/laravel-soft-delete-morph-to-many-pivots
```

## Usage

Use the `MorphToManySoftDeletesTrait` trait along with the `morphToManySoft` function and which returns a `MorphToManySoftDeletes`

```php
use Illuminate\Database\Eloquent\Model;
use Totov\LaravelSoftDeleteMorphToManyPivots\MorphToManySoftDeletes;
use Totov\LaravelSoftDeleteMorphToManyPivots\Traits\MorphToManySoftDeletesTrait;

class User extends Model
{
    use MorphToManySoftDeletesTrait;

    public function user_types(): MorphToManySoftDeletes
    {
        return $this->morphToManySoft(UserType::class, 'types');
    }
}
```

On the morphed model, use the `morphedByManySoft` function:

```php
use Illuminate\Database\Eloquent\Model;
use Totov\LaravelSoftDeleteMorphToManyPivots\MorphToManySoftDeletes;
use Totov\LaravelSoftDeleteMorphToManyPivots\Traits\MorphToManySoftDeletesTrait;

class UserType extends Model
{
use MorphToManySoftDeletesTrait;

    public function users(): MorphToManySoftDeletes
    {
        return $this->morphedByManySoft(User::class, 'types');
    }
}
```

Ensure that your pivot table has a `deleted_at` column which can be used for the soft deleting.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Stephen Hamilton](https://github.com/totov)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
