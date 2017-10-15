<?php

namespace Ventrec\LaravelEntitySyncClient\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeletedEntityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'entity_id' => 'required',
            'name' => 'required',
            'force_delete' => 'required',
        ];
    }
}
