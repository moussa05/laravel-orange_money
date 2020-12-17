<?php

use Illuminate\Support\Facades\Route;
URL::forceScheme('https');
Route::group(['namespace'  => 'Orange\Orange_Money\Http\Controllers'],function(){
    Route::get('orange','OrangeController@apiCall');
});
