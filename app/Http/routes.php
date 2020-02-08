<?php
Route::group([], function () {
    Route::match(['get', 'post'], '/', ['uses'=> 'IndexController@execute', 'as'=>'home']);
    Route::get('/page/{alias}', ['uses'=> 'PageController@execute', 'as'=> 'page']);

    Route::auth();
});
// маршруты администратора
Route::group(['prefix'=>'admin', 'middleware'=> 'auth'], function () {

    //admin
    Route::get('/', function () {

        if(view()->exists('admin.index')) {
            $data = ['title' => 'Панель администратора'];

            return view('admin.index', $data);
        }

    });

    //admin/pages
    Route::group(['prefix'=> 'pages'], function (){

        //admin/pages
        Route::get('/', ['uses'=>'PagesController@execute', 'as'=> 'pages']);
        //admin/pages/add
        Route::match(['get', 'post'], '/add', ['uses'=> 'PagesAddController@execute', 'as'=>'pagesAdd']);
        //admin/edit/{id}
        Route::match(['get', 'post', 'delete'], '/edit/{page}', ['uses'=> 'PagesEditController@execute', 'as'=> 'pagesEdit']);

    });

    Route::group(['prefix'=> 'portfolios'], function (){

        //admin/portfolios
        Route::get('/', ['uses'=>'PortfoliosController@execute', 'as'=> 'portfolio']);
        //admin/portfolios/add
        Route::match(['get', 'post'], '/add', ['uses'=> 'PortfoliosAddController@execute', 'as'=>'portfoliosAdd']);
        //admin/edit/{id}
        Route::match(['get', 'post', 'delete'], '/edit/{portfolios}', ['uses'=> 'PortfoliosEditController@execute', 'as'=> 'portfoliosEdit']);

    });

    Route::group(['prefix'=> 'services'], function (){

        //admin/services
        Route::get('/', ['uses'=>'ServicesController@execute', 'as'=> 'services']);
        //admin/services/add
        Route::match(['get', 'post'], '/add', ['uses'=> 'ServicesAddController@execute', 'as'=>'servicesAdd']);
        //admin/edit/{id}
        Route::match(['get', 'post', 'delete'], '/edit/{services}', ['uses'=> 'ServicesEditController@execute', 'as'=> 'servicesEdit']);

    });
});
Route::auth();

Route::get('/home', 'HomeController@index');
