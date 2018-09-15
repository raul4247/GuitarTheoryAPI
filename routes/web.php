<?php

namespace App\Providers;
use App\Facades\ScalesGen;
use Illuminate\Support\Facades;

$router->get('/', function () use ($router){
    return "Guitar Theory API v0.1 working!";
});

$router->get('CurrentVersion/', function () use ($router){
    return "v0.1";
});

$router->get('Scale/Chromatic/{accidental}',  ['uses' => 'ScalesController@getChromaticScale']);

$router->get('Scale/Major/{root}',  ['uses' => 'ScalesController@getMajorScale']);
$router->get('Scale/Minor/{root}',  ['uses' => 'ScalesController@getMinorScale']);