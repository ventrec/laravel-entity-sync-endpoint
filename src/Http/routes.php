<?php

Route::group([
    'prefix' => config('laravelEntitySyncEndpoint.routeUrlPrefix'),
    'middleware' => Ventrec\LaravelEntitySyncClient\Http\Middleware\ResolveGlobalEntity::class,
], function () {
    Route::post('entity-sync', 'Ventrec\LaravelEntitySyncClient\Http\Controllers\EntitySyncController@store');
    Route::patch('entity-sync', 'Ventrec\LaravelEntitySyncClient\Http\Controllers\EntitySyncController@update');
    Route::delete('entity-sync', 'Ventrec\LaravelEntitySyncClient\Http\Controllers\EntitySyncController@delete');
});
