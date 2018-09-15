<?php
namespace App\Util;

class Scales{
    const PITCHES_SHARP = ['A','A-Sharp','B','C','C-Sharp','D','D-Sharp','E','F','F-Sharp','G','G-Sharp'];
    const PITCHES_FLAT  = ['A','B-Flat' ,'B','C','D-Flat' ,'D','E-Flat' ,'E','F','G-Flat' ,'G','A-Flat'];
    
    // chromatic, major, minor, major pentatonic, minor pentatonic 

    public static function chromatic($accidental){
        if($accidental=='Sharp'){
            $start =  array_search($accidental, self::PITCHES_SHARP);        
            $before = array_slice(self::PITCHES_SHARP, $start); 
            $after = array_slice(self::PITCHES_SHARP, 0, $start); 
        }
        else if($accidental=='Flat'){
            $start =  array_search($accidental, self::PITCHES_FLAT);        
            $before = array_slice(self::PITCHES_FLAT, $start); 
            $after = array_slice(self::PITCHES_FLAT, 0, $start); 
        }

        $pitches = array_merge($before,$after);
        return $pitches;
    }   

    private static function findNoRepeatedPitch($arr, $pos){
        foreach($arr as $pitch){
            $repeat = false;
            if(self::PITCHES_SHARP[$pos]{0} == $pitch{0})
                $repeat = true;
        }
        if($repeat)
            return self::PITCHES_FLAT[$pos];
        else
            return self::PITCHES_SHARP[$pos];
    }

    public static function major($root){
		// T T ST T T T ST
        $pitches = array();
        $start =  array_search($root, self::PITCHES_SHARP);      
        if(strlen($start)==0){
            $start =  array_search($root, self::PITCHES_FLAT);      
            array_push($pitches,self::PITCHES_FLAT[$start]);
        }
        else
            array_push($pitches,self::PITCHES_SHARP[$start]);

        array_push($pitches, self::findNoRepeatedPitch($pitches, ($start+2)%12));
        array_push($pitches, self::findNoRepeatedPitch($pitches, ($start+4)%12));
		array_push($pitches, self::findNoRepeatedPitch($pitches, ($start+5)%12));
		array_push($pitches, self::findNoRepeatedPitch($pitches, ($start+7)%12));
		array_push($pitches, self::findNoRepeatedPitch($pitches, ($start+9)%12));
		array_push($pitches, self::findNoRepeatedPitch($pitches, ($start+11)%12));
        return $pitches;
    }

    public static function minor($root){
        // T ST T T ST T T
        $pitches = array();
        $start =  array_search($root, self::PITCHES_SHARP);      
        if(strlen($start)==0){
            $start =  array_search($root, self::PITCHES_FLAT);      
            array_push($pitches,self::PITCHES_FLAT[$start]);
        }
        else
            array_push($pitches,self::PITCHES_SHARP[$start]);

        array_push($pitches, self::findNoRepeatedPitch($pitches, ($start+2)%12));
        array_push($pitches, self::findNoRepeatedPitch($pitches, ($start+3)%12));
		array_push($pitches, self::findNoRepeatedPitch($pitches, ($start+5)%12));
		array_push($pitches, self::findNoRepeatedPitch($pitches, ($start+7)%12));
		array_push($pitches, self::findNoRepeatedPitch($pitches, ($start+8)%12));
		array_push($pitches, self::findNoRepeatedPitch($pitches, ($start+10)%12));
        return $pitches;
    }

    public static function majorPentatonic($root){
        // Pentatonic major is the same as regular major, but without degrees 4 and 7
        $regMajor = self::major($root);
        unset($regMajor[3]);
        unset($regMajor[6]);
        $pitches = array_values($regMajor);
        return $pitches;
    }
    
    public static function minorPentatonic($root){
        // Pentatonic minor is the same as regular minor, but without degrees 2 and 6
        $regMinor = self::minor($root);
        unset($regMinor[1]);
        unset($regMinor[5]);
        $pitches = array_values($regMinor);
        return $pitches;
    }
}