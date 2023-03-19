<?php

function can($permission_id) {
    $result = DB::table('role_has_permissions')
        ->where('role_id', auth()->user()->roles[0]->id)
        ->where('permission_id', $permission_id)
        ->count();

    return $result;
}
