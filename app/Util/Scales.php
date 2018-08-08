<?php
namespace App\Util;

class Scales{
    const MUSICAL_PITCHES = ['A','A-Sharp','B','C','C-Sharp','D','D-Sharp','E','F','F-Sharp','G','G-Sharp'];
    // chromatic, major, minor, major pentatonic, minor pentatonic 
    public static function chromatic($root){
        $start =  array_search($root, self::MUSICAL_PITCHES);        

        $before = array_slice(self::MUSICAL_PITCHES, $start); 
        $after = array_slice(self::MUSICAL_PITCHES, 0, $start); 
        $pitches = array_merge($before,$after);
        return $pitches;
    }   
    public static function major($root){
		// T T ST T T T ST
        $start =  array_search($root, self::MUSICAL_PITCHES);        
        $pitches = array();

        array_push($pitches,self::MUSICAL_PITCHES[$start]);
        array_push($pitches,self::MUSICAL_PITCHES[($start+2)%12]);
        array_push($pitches,self::MUSICAL_PITCHES[($start+4)%12]);
		array_push($pitches,self::MUSICAL_PITCHES[($start+5)%12]);
		array_push($pitches,self::MUSICAL_PITCHES[($start+7)%12]);
		array_push($pitches,self::MUSICAL_PITCHES[($start+9)%12]);
		array_push($pitches,self::MUSICAL_PITCHES[($start+11)%12]);
        return $pitches;
    }
    public static function minor($root){
        // T ST T T ST T T
        $start =  array_search($root, self::MUSICAL_PITCHES);        
        $pitches = array();

        array_push($pitches,self::MUSICAL_PITCHES[$start]);
        array_push($pitches,self::MUSICAL_PITCHES[($start+2)%12]);
        array_push($pitches,self::MUSICAL_PITCHES[($start+3)%12]);
		array_push($pitches,self::MUSICAL_PITCHES[($start+5)%12]);
		array_push($pitches,self::MUSICAL_PITCHES[($start+7)%12]);
		array_push($pitches,self::MUSICAL_PITCHES[($start+8)%12]);
		array_push($pitches,self::MUSICAL_PITCHES[($start+10)%12]);
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