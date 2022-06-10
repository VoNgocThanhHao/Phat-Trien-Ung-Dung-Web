<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToolsModel extends Model
{
    public function getJson($data, $list = []){
        $tmp = array();
        $data = (array)$data;
        foreach ($list as $key){
            $tmp[$key] = $data[$key];
        }
        return json_encode($tmp);
    }

    public static function status($message, $code)
    {
        return json_encode((object)["status" => $code, "message" => $message]);
    }
}
