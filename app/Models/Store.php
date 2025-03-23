<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Store extends Model
{
    use SoftDeletes,Searchable;
    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            '_geo' => [
                'lat' => $this->latitude,
                'lng' => $this->longitude,
            ],
        ];
    }
}
