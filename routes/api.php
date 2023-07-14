<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Oyunlar
    Route::apiResource('oyunlars', 'OyunlarApiController');

    // Bonustime
    Route::apiResource('bonustimes', 'BonustimeApiController');

    // Bonusekleme
    Route::apiResource('bonuseklemes', 'BonuseklemeApiController');
});
