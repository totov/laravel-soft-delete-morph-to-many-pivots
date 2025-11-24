# Changelog

All notable changes to `laravel-soft-delete-morph-to-many-pivots` will be documented in this file.

## v1.0.10 - 2025-11-24

### What's Changed

* Bumps available Laravel versions. by @totov in https://github.com/totov/laravel-soft-delete-morph-to-many-pivots/pull/19

**Full Changelog**: https://github.com/totov/laravel-soft-delete-morph-to-many-pivots/compare/v1.0.9...v1.0.10

## Resolves phpstan issues. - 2025-09-01

**Full Changelog**: https://github.com/totov/laravel-soft-delete-morph-to-many-pivots/compare/v1.0.8...v1.0.9

## v1.0.8 - 2025-09-01

### What's Changed

* Bump aglipanci/laravel-pint-action from 2.3.0 to 2.3.1 by @dependabot[bot] in https://github.com/totov/laravel-soft-delete-morph-to-many-pivots/pull/4
* Bump aglipanci/laravel-pint-action from 2.3.1 to 2.4 by @dependabot[bot] in https://github.com/totov/laravel-soft-delete-morph-to-many-pivots/pull/7
* Bump dependabot/fetch-metadata from 1.6.0 to 2.1.0 by @dependabot[bot] in https://github.com/totov/laravel-soft-delete-morph-to-many-pivots/pull/8
* Bump ramsey/composer-install from 2 to 3 by @dependabot[bot] in https://github.com/totov/laravel-soft-delete-morph-to-many-pivots/pull/5
* Bump dependabot/fetch-metadata from 2.1.0 to 2.2.0 by @dependabot[bot] in https://github.com/totov/laravel-soft-delete-morph-to-many-pivots/pull/9
* Bump dependabot/fetch-metadata from 2.2.0 to 2.3.0 by @dependabot[bot] in https://github.com/totov/laravel-soft-delete-morph-to-many-pivots/pull/10
* Bump aglipanci/laravel-pint-action from 2.4 to 2.5 by @dependabot[bot] in https://github.com/totov/laravel-soft-delete-morph-to-many-pivots/pull/11
* Bump dependabot/fetch-metadata from 2.3.0 to 2.4.0 by @dependabot[bot] in https://github.com/totov/laravel-soft-delete-morph-to-many-pivots/pull/12
* Bump stefanzweifel/git-auto-commit-action from 5 to 6 by @dependabot[bot] in https://github.com/totov/laravel-soft-delete-morph-to-many-pivots/pull/13
* Bump aglipanci/laravel-pint-action from 2.5 to 2.6 by @dependabot[bot] in https://github.com/totov/laravel-soft-delete-morph-to-many-pivots/pull/14
* Bump actions/checkout from 4 to 5 by @dependabot[bot] in https://github.com/totov/laravel-soft-delete-morph-to-many-pivots/pull/15
* Fixes issue with relationship querying. by @totov in https://github.com/totov/laravel-soft-delete-morph-to-many-pivots/pull/16

### New Contributors

* @totov made their first contribution in https://github.com/totov/laravel-soft-delete-morph-to-many-pivots/pull/16

**Full Changelog**: https://github.com/totov/laravel-soft-delete-morph-to-many-pivots/compare/v1.0.7...v1.0.8

## Adds callback for soft deleting - 2023-10-17

**Full Changelog**: https://github.com/totov/laravel-soft-delete-morph-to-many-pivots/compare/v1.0.6...v1.0.7

## Adds type hinting support for soft delete scopes - 2023-10-17

**Full Changelog**: https://github.com/totov/laravel-soft-delete-morph-to-many-pivots/compare/v1.0.5...v1.0.6

## Improves scopes - 2023-10-17

Allows use of the Laravel conventions for `withTrashed()`, `onlyTrashed()`, etc.

**Full Changelog**: https://github.com/totov/laravel-soft-delete-morph-to-many-pivots/compare/v1.0.3...v1.0.4

## Changes query to use global scope - 2023-10-17

Uses a global scope instead of adding where statements directly to allow the scope to be removed when querying for trashed pivots.

**Full Changelog**: https://github.com/totov/laravel-soft-delete-morph-to-many-pivots/compare/v1.0.2...v1.0.3

## Fixes minor issues. - 2023-10-17

**Full Changelog**: https://github.com/totov/laravel-soft-delete-morph-to-many-pivots/compare/v1.0.1...v1.0.2
