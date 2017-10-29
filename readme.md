# Laravel entity sync client

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ventrec/laravel-entity-sync-endpoint.svg?style=flat-square)](https://packagist.org/packages/ventrec/laravel-entity-sync-endpoint)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/ventrec/laravel-entity-sync-endpoint/master.svg?style=flat-square)](https://travis-ci.org/ventrec/laravel-entity-sync-endpoint)
[![Total Downloads](https://img.shields.io/packagist/dt/ventrec/laravel-entity-sync-endpoint.svg?style=flat-square)](https://packagist.org/packages/ventrec/laravel-entity-sync-endpoint)

Handles incoming sync requests for the [laravel entity sync](https://github.com/ventrec/laravel-entity-sync) package.

## Introduction

This is the client package of the [laravel entity sync](https://github.com/ventrec/laravel-entity-sync) package. The [laravel entity sync](https://github.com/ventrec/laravel-entity-sync) package syncs entities to the endpoints that this package creates. This package will then handle the data and create, update or delete the entity.

The structure of your tables should be the same on both the master database and the client database.

## Installation

1. `composer require ventrec/laravel-entity-sync-endpoint`
2. Add `Ventrec\LaravelEntitySyncClient\LaravelEntitySyncClientProvider::class` to providers in app.php
3. Publish the config file `php artisan vendor:publish --provider="Ventrec\LaravelEntitySyncClient\LaravelEntitySyncClientProvider"`
4. Update the config file
    - Add the entities that you expect to receive requests for. This should be the same entities that you have entered in the master config.
    - Enter an api token that should be used to verify the requests. This should be the same token that was used in the master config.
    - (Optional) Enter a prefix for the api-endpoint. If no prefix is entered, all requests will be sent to `/entity-sync`

## Usage

All models that is used must have `protected $guarded = []`.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.