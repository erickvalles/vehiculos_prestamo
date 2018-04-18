<?php


Route::get('/', ['as' => 'index', function () {
    return view('index');
}]);


Route::get('terminos_condiciones', ['as' => 'terminos', function () {
    return view('terms_and_Conditions');
}]);

Route::resource('categoria', 'CategoryController');
Route::resource('contacto', 'ContactController');
Route::resource('dependencia', 'DependenceController');
Route::resource('conductor', 'DriverController');
Route::resource('tipo_evento', 'EventTypeController');
Route::resource('licencia', 'LicenceController');
Route::resource('solicitud', 'SolicitudController');
Route::resource('usuario', 'UserController');
Route::get('jefes',['as'=>'jefes.index','uses'=>'UserController@muestra_jefes']);
Route::get('solicitantes',['as'=>'solicitantes.index','uses'=>'UserController@muestraSolicitantes']);
Route::resource('vehiculo', 'VehicleController');
Route::resource('role', 'RoleController');
Auth::routes();

Route::get('completa_solicitud',['as'=>'autocompletar','uses'=>'DriverController@autocompletar']);
Route::get('terminos', ['as'=>'terminos', function(){
    return view('terms_and_Conditions');
}]);
Route::get('/home', 'HomeController@index')->name('home');

Route::post('select_event_type', ['as' => 'select_event', function () {
    if(request()->category != '') {
        $list = ['' => '- Seleccione una opción -'] + DB::table('event_types')
            ->where('categories_id','=',request()->category)
            ->get()->pluck('nombre','id')->toArray() +
            ['otro' => 'Otro'];
        $attribs = ['onchange' => 'generaInput();', 'id' => 'tipo_evento'];
    } else {
        $list = null;
        $attribs = null;
    }

    return view('select_event_types', compact('list', 'attribs'));
}]);



















//rutas de Erick xD
Route::get('aceptar/{id}',['as'=>'aceptar','uses'=>'SolicitudController@aceptarSolicitud'])->where('id',"[0-9+]");
Route::get('rechazar/{id}',['as'=>'rechazar','uses'=>'SolicitudController@rechazarSolicitud'])->where('id',"[0-9+]");
