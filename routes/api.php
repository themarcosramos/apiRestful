<?php

$this->group(['prefix' => 'v1'], function() {
    
    $this->post('/auth', 'Auth\\AuthApiController@authenticate');
    $this->post('/auth-refresh', 'Auth\\AuthApiController@refreshJWTToken');
    
    $this->group(['middleware' => 'jwt.auth'], function() {
        Route::get('/products/search', 'Api\\V1\\ProductController@search');
        Route::resource('products', 'Api\\V1\\ProductController', ['except' => ['create', 'edit']]);
    });

});



