@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-between align-items-start">
        <h2>Устройства</h2>
        <div>
            <a href="{{ route('device-create') }}" class="btn btn-info text-white ml-2">Добавить устройство</a>
            <a href="{{ route('device') }}" class="btn btn-info text-white ml-2">Список устройств</a>
            <a href="{{ route('card-create') }}" class="btn btn-info text-white ml-2">Добавить характеристики</a>
        </div>   
    </div>
    <div class="row">
        <table class="table table-hover table-responsive" id="cards">
            <thead>
            <tr>
                <th width=10%>@sortablelink('id', 'ID')</th>
                <th width=10%>@sortablelink('inventory', 'Инв. №')</th>
                <th width=25%>@sortablelink('device.device', 'Устройство')</th>
                <th width=25%>@sortablelink('department.department', 'Отдел')</th>             
                <th width=20%>@sortablelink('condition', 'Состояние')</th>                
                <th width=10%>Controls</th>
            </tr>
            </thead>
            <tbody>
            @if (isset($devices)) 
                @foreach ($devices as $device)
                    <tr>
                        <td>{{ $device->id }}</td>
                        <td><a href="{{ route('info', [$device->id]) }}"> {{ $device->inventory }} </a></td>
                        <td>{{ $device->device->device }}</td>
                        <td>{{ $device->department->department }}</td>
                        <td>{{ $device->condition }}</td>
                        <td>
                            <a href="{{ route('card-edit', [$device->id]) }}" class="btn-edit mr-2"><i class="fas fa-pen edit"></i></a>                       
                            <a href="{{ route('card-delete', [$device->id]) }}" class="btn-delete mr-2" onclick="return confirm('Вы уверены?')"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
        {{-- <div class="alert alert-dark w-100" role="alert">
            Количество записей: <strong class="text-danger">{{ $devices->count() }}</strong>
        </div> --}}
        @if (isset($devices))
            {{ $devices->appends(\Request::except('page'))->render() }}
        @endif
    </div>
</div>
@endsection