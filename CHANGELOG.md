# Changelog

All notable changes to `laravel-soft-delete-morph-to-many-pivots` will be documented in this file.

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
