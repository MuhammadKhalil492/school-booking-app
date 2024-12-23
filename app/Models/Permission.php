<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as OriginalPermission;
use App\Models\Role;

class Permission extends OriginalPermission
{

    protected $fillable = ['name', 'guard_name', 'group', 'parent_id', 'updated_at', 'created_at'];

    /**
     * @param $query
     * @param bool $status
     *
     * @return mixed
     */
    public function scopeOnlyParent($query)
    {
        return $query->where('parent_id', '0');
    }
}
