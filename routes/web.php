<?php

/*DB::listen(function($query){
    echo "<pre>{{$query->sql}}</pre>";
});*/


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
    $event_type = request()->event_type;
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

    return view('select_event_types', compact('list', 'attribs', 'event_type'));
}]);

//rutas de Erick xD
Route::get('aceptar/{id}',['as'=>'aceptar','uses'=>'SolicitudController@aceptarSolicitud']);
Route::post('rechazar',['as'=>'rechazar','uses'=>'SolicitudController@rechazarSolicitud']);
Route::get('cancelar/{id}',['as'=>'cancelar',function($id){
    $solicitud = \App\Solicitud::findOrFail($id);
    $id_solicitante = $solicitud->solicitante_id;
    return view('motivo_rechazo',compact('id', 'id_solicitante'));
}]);

Route::get('solicitud/{id}/asignar_peticion', ['as' => 'assign_request', 'uses' => 'SolicitudController@assignRequest']);
Route::post('asignar_peticion', ['as' => 'save_request', 'uses' => 'SolicitudController@saveDriverVehicleRequest']);
Route::post('editar_peticion', ['as' => 'edit_request', 'uses' => 'SolicitudController@editDriverVehicleRequest']);
Route::get('buscar_solicitud', ['as' => 'search_request', function() {
    return view('search_request');
}]);

Route::post('busqueda_solicitud',['as'=>'searching_request', 'uses'=>'SolicitudController@busquedaSolicitud']);

Route::get('observacion/{id}',['as'=>'observacion.nueva', 'uses'=>'SolicitudController@nuevaObservacion']);
Route::get('show_observaciones/{id}',['as'=>'observacion.show', 'uses'=>'SolicitudController@muestraObservaciones']);
Route::post('observacion/{id}',['as'=>'observacion.store', 'uses'=>'SolicitudController@guardaObservacion']);

