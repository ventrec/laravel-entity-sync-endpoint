<?php

namespace Ventrec\LaravelEntitySyncClient\Http\Controllers;

use App\Http\Controllers\Controller;
use Ventrec\LaravelEntitySyncClient\Exceptions\UnknownEntityException;
use Ventrec\LaravelEntitySyncClient\Http\Requests\DeletedEntityRequest;
use Ventrec\LaravelEntitySyncClient\Http\Requests\EntityRequest;

class EntitySyncController extends Controller
{
    public function store(EntityRequest $request)
    {
        app($this->resolveEntity($request))->insert($request->entity);
    }

    public function update(EntityRequest $request)
    {
        $data = collect($request->entity);

        app($this->resolveEntity($request))
            ->whereId($data->get('id'))
            ->update($data->except('id')->toArray());
    }

    public function delete(DeletedEntityRequest $request)
    {
        $entity = app($this->resolveEntity($request))->findOrFail($request->entity_id);

        if ($request->force_delete) {
            $entity->forceDelete();
        } else {
            $entity->delete();
        }
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
