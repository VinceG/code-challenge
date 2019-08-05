<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => data_get($this->resource, 'id'),
            'email' => data_get($this->resource, 'email'),
            'name' => trim(data_get($this->resource, 'first_name') . ' ' . data_get($this->resource, 'last_name')),
            'first_name' => data_get($this->resource, 'first_name'),
            'last_name' => data_get($this->resource, 'last_name'),
            'avatar' => data_get($this->resource, 'avatar')
        ];
    }
}