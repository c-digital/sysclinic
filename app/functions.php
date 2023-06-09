<?php

function can($permission_id) {
    $result = DB::table('role_has_permissions')
        ->where('role_id', auth()->user()->roles[0]->id)
        ->where('permission_id', $permission_id)
        ->count();

    return $result;
}

function randomColor(){
    $str = "#";
    
    for($i = 0 ; $i < 6 ; $i++){
        $randNum = rand(0, 15);
        
        switch ($randNum) {
            case 10: $randNum = "A"; 
            break;

            case 11: $randNum = "B"; 
                break;
            
            case 12: $randNum = "C"; 
                break;
            
            case 13: $randNum = "D"; 
                break;
        
            case 14: $randNum = "E"; 
                break;
            
            case 15: $randNum = "F"; 
            break; 
        }

        $str .= $randNum;
    }

    return $str;
}
