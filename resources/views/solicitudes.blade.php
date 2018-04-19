@extends('layout')

@section('title', $title)

@section('content')
    <link rel="stylesheet" href="css/tabla.css">
    <br><br>
    <div class="limit">
        <br/>
        <h1 class="center-text">{{ $title }}</h1>
        <br/>
        @if (session('alert'))
            <div id="message" class="alert alert-success">
                <a href="#" onclick="fadeMessage()" class="close" title="close">×</a>
                {{ session('alert') }}
            </div>
        @endif
        <table class="table-fill">
            <thead>
            <tr>
                <th>Solicitante</th>
                <th>Funcionario</th>
                <th>Conductor</th>
                <th>Estado</th>
                <th>Disponibilidad de Vehículo</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody class="table-hover">
            @forelse($solicitudes as $solicitud)

            <tr>
                <td>{{$solicitud->nombre_evento}}</td>
                <td>{{$solicitud->jefe->nombre.' '.$solicitud->jefe->apaterno.' '.$solicitud->jefe->amaterno}} ({{$solicitud->jefe->cargo}})</td>
                <td>
                    @if($solicitud->solicita_conductor !== null)
                        {{\App\Solicitud::SolicitaConductor($solicitud->solicita_conductor)}}
                    @else
                        {{$solicitud->driver->nombre.' '.$solicitud->driver->apaterno.' '.$solicitud->driver->amaterno}} ({{$solicitud->driver->dependencia->nombre}})
                    @endif
                </td>
                <td>{{\App\Solicitud::status($solicitud->estatus)}}</td>
                <td>{{\App\Solicitud::vehiculoPropio($solicitud->vehiculo_propio)}}</td>
                @if(auth()->user()->hasRoles(['admin']) ||auth()->user()->hasRoles(['coord_servicios_generales']) )
                <td>
                    <form id="delete_form_{{ $solicitud->id }}" action="{{ route('solicitud.destroy' , $solicitud->id)}}" method="POST">
                        <a href='{{ route('solicitud.show', $solicitud->id) }}'>
                            <button type="button" class="btn btn-info">Detalles</button>
                        </a>
                        <a href='{{route('solicitud.edit', $solicitud->id)}}'>
                            <button type="button" class="btn btn-success">Editar</button>
                        </a>
                        <input name="_method" type="hidden" value="DELETE">
                        {{ csrf_field() }}
                        <a href='' onclick="deleteElement(
                                '¿Está seguro de querer eliminar a la solicitud {{$solicitud->nombre_evento}}?',
                                'delete_form_{{ $solicitud->id }}', event);
                                ">
                            <button type="button" class="btn btn-danger">Eliminar</button>
                            @if(auth()->user()->hasRoles(['coord_servicios_generales']))
                            <a href="{{route('assign_request',$solicitud->id) }}" class="btn btn-default">Asignar peticiones  </a>
                                @endif
                        </a>
                    </form>
                </td>
                @elseif(auth()->user()->hasRoles(['jefe']))
                <td>
                    <a href="{{route('aceptar',$solicitud->id)}}">
                        <button type="button" class="btn btn-success">Aceptar</button>
                    </a>
                    <a href="{{route('rechazar',$solicitud->id)}}">
                        <button type="button" class="btn btn-danger">Rechazar</button>
                    </a>
                </td>
                @elseif(auth()->user()->hasRoles(['solicitante']))
                    <td>
                        <a href="">
                            <button type="button" class="btn btn-warning">Editar</button>
                        </a>

                    </td>
                @endif
            </tr>
            @empty
                <tr>
                    <td colspan="6">No hay solicitudes</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div><br>
@stop