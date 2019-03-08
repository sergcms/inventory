@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-between align-items-start">
    <h2>По {{ $isdevice ? 'устройству' : 'отделу' }}  <strong>{{ $name }}</strong> найдено - {{ $count }} записи(ей)!</h2>          
    </div>
    <div class="row justify-content-center mt-5">
        <table class="table table-hover">
            <thead>
            <tr>
                <th width=10%>ID</th>
                <th width=10%>Инв. №</th>
                <th width=25%>Устройство</th>
                <th width=35%>Отдел</th>             
                <th width=20%>Состояние</th>                
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
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection