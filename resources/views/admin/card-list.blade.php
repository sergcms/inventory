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
    <div class="row justify-content-center">
        <table class="table table-hover table-responsive">
            <thead>
            <tr>
                <th width=10%>ID</th>
                <th width=10%>Инв. №</th>
                <th width=25%>Устройство</th>
                <th width=25%>Отдел</th>             
                <th width=20%>Состояние</th>                
                <th width=10%>Controls</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($devices as $device)
                <tr>
                    <td>{{ $device->cards_id }}</td>
                    <td>{{ $device->inventory }}</td>
                    <td>{{ $device->device }}</td>
                    <td>{{ $device->department }}</td>
                    <td>{{ $device->condition }}</td>
                    <td>
                        <a href="{{ route('card-edit', [$device->cards_id]) }}" class="btn-edit mr-2"><i class="fas fa-pen edit"></i></a>                       
                        <a href="{{ route('card-delete', [$device->cards_id]) }}" class="btn-delete mr-2" onclick="return confirm('Вы уверены?')"><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection