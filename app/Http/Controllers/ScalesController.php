<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades;
use Illuminate\Http\Request;
use App\Util\Scales;

class ScalesController extends Controller{
    public function getScale($type, $root){
        $data = (object) array('root' => $root, 'type' => $type, 'pitches' => []);
        switch ($type){
            case "Chromatic":
                $data->pitches = Scales::chromatic($root);
                break;
            case "Major":
                $data->pitches = Scales::major($root);
                break;
            case "Minor":
                $data->pitches = Scales::minor($root);
                break;
            case "Major-Pentatonic":
                $data->pitches = Scales::majorPentatonic($root);
                break;
            case "Minor-Pentatonic":
                $data->pitches = Scales::minorPentatonic($root);
                break;
            default:
                return response()->json("NOT FOUND",200);
                break;
        }
        return response()->json($data, 200);
    }
}