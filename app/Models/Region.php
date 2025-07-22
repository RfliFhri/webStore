<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Region extends Model
{
    public $timestamps = false;

    public function parent() : BelongsTo
    {
        return $this->belongsTo(Region::class, 'parent_code', 'code');
    }

    public function childern()
    {
        return $this->hasMany(Region::class, 'parent_code', 'code');
    }

    public function schopeProvince($query)
    {
        return $query->where('type', 'province');
    }

    public function schopeRegencies($query)
    {
        return $query->where('type', 'regency');
    }

    public function schopeDistrict($query)
    {
        return $query->where('type', 'district');
    }

    public function shopeVillage($query)
    {
        return $query->where('type', 'village');
    }
}
