<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    //
    protected $table = 'requests';

    protected $fillable= [
        'nombre_evento',
        'estatus',
        'fecha_solicitud',
        'fecha_respuesta',
        'fecha_evento',
        'event_types_id',
        'driver_id',
        'solicitante_id',
        'vehicles_id',
        'jefe_id',
        'escala',
        'domicilio',
        'personas',
        'distancia',
        'fecha_regreso',
        'vehiculo_propio',
        'solicita_conductor',
        'observaciones'
    ];

    public $timestamps = false;

    public function user() {
        return $this->belongsTo(User::class,'solicitante_id','id');
    }

    public function jefe() {
        return $this->belongsTo(User::class,'jefe_id','id');
    }

    public function driver() {
        return $this->hasOne(Driver::class,'id','driver_id');
    }

    public function vehicle() {
        return $this->hasOne(Vehicle::class, 'id','vehicles_id');
    }

    public function eventType() {
        return $this->hasOne(Event_Type::class, 'id','event_types_id');
    }

   /* public function setFechaSolicitudAttribute($value) {
       // dd($value);
        $this->attributes['fecha_solicitud'] = Carbon::parse(strtotime($value.':00'));
    }

    public function setFechaEventoAttribute($value) {
        $this->attributes['fecha_evento'] = Carbon::parse(strtotime($value.':00'));
    }*/

    public function setFechaRespuestaAttribute($value) {
        $this->attributes['fecha_respuesta'] = Carbon::parse(strtotime($value.':00'));
    }

   /* public function setFechaRegresoAttribute($value) {
        $this->attributes['fecha_regreso'] = Carbon::parse(strtotime($value.':00'));
    }*/

    public static function status($status) {
        switch ($status){
            case 1:
                return "No se ha aprobado";
                break;
            case 2:
                return "Aprobado por el jefe inmediato";
                break;
            case 3:
                return "Aprobado por la Secretaría Administrativa";
                break;
            case 4:
                return "Aprobado por el Coordinador de Servicios Generales";
                break;
            case 5:
                return "Rechazada por alguna instancia";
                break;
            default:
                return "No se ha aprobado";
                break;
        }
    }

    public static function vehiculoPropio($dispone) {
        if ($dispone === null) {
            return "No puede hacer uso de su vehículo y no se ha asignado un vehículo.";
        } else {
            return "Sí puede usar su vehículo";
        }
    }

    public static function SolicitaConductor($conductor) {
        if ($conductor!==null) {
            return "Se requiere conductor por parte de la institución";
        } else {
            return $conductor;
        }
    }

    public function observacionesRel(){
        return $this->hasMany(Observacion::class,'requests_id','id');
    }

    public function solicitante(){
        return $this->belongsTo(User::class,'solicitante_id','id');
    }

    public function jefeAutoriza(){
        return $this->belongsTo(User::class,'jefe_id','id');
    }

}
