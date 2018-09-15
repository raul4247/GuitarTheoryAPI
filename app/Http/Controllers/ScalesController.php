<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades;
use Illuminate\Http\Request;
use App\Util\Scales;

class ScalesController extends Controller{
    public function getChromaticScale($accidental){
        if($accidental!='Sharp' && $accidental!='Flat')
            return response()->json((object)array('error'=>"Not Found"),200);

        $data = (object) array('type' => 'Chromatic','accidental' => $accidental , 'pitches' => []);
        $data->pitches = Scales::chromatic($accidental);
        return response()->json($data, 200);
    }

    public function getMajorScale($root){
        if(!in_array($root, Scales::PITCHES_SHARP) && !in_array($root, Scales::PITCHES_FLAT))
            return response()->json((object)array('error'=>"Not Found"),200);

        $data = (object) array('root' => $root, 'type' => 'Major', 'pitches' => []);
        $data->pitches = Scales::major($root);
        return response()->json($data,200);
    }

    public function getMinorScale($root){
        if(!in_array($root, Scales::PITCHES_SHARP) && !in_array($root, Scales::PITCHES_FLAT))
            return response()->json((object)array('error'=>"Not Found"),200);

        $data = (object) array('root' => $root, 'type' => 'Minor', 'pitches' => []);
        $data->pitches = Scales::minor($root);
        return response()->json($data,200);
    }
    public function getPentatonicMajorScale($root){
        if(!in_array($root, Scales::PITCHES_SHARP) && !in_array($root, Scales::PITCHES_FLAT))
            return response()->json((object)array('error'=>"Not Found"),200);

        $data = (object) array('root' => $root, 'type' => 'Major Pentatonic', 'pitches' => []);
        $data->pitches = Scales::majorPentatonic($root);
        return response()->json($data,200);
    }
    public function getPentatonicMinorScale($root){
        if(!in_array($root, Scales::PITCHES_SHARP) && !in_array($root, Scales::PITCHES_FLAT))
            return response()->json((object)array('error'=>"Not Found"),200);

        $data = (object) array('root' => $root, 'type' => 'Minor Pentatonic', 'pitches' => []);
        $data->pitches = Scales::minorPentatonic($root);
        return response()->json($data,200);
    }
}