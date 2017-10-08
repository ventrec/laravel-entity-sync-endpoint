<?php

namespace Ventrec\LaravelEntitySyncClient\Http\Controllers;

use App\Http\Controllers\Controller;
use Ventrec\LaravelEntitySyncClient\Exceptions\UnknownEntityException;
use Ventrec\LaravelEntitySyncClient\Http\Requests\EntityRequest;

class EntitySyncController extends Controller
{
    public function store(EntityRequest $request)
    {
        app($this->resolveEntity($request))->create($request->entity);
    }

    public function update(EntityRequest $request)
    {
        app($this->resolveEntity($request))->update($request->entity);
    }

    public function delete(EntityRequest $request)
    {
        app($this->resolveEntity($request))->findOrFail($request->entity->id)->delete();
    }

    private function resolveEntity($request)
    {
        $entities = config('laravelEntitySyncEndpoint.entities');

        if (!isset($entities[$request->name])) {
            throw new UnknownEntityException;
        }

        return $entities[$request->name];
    }
}
