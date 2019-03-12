@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-between align-items-start">
        <h2>По {{ $isdevice ? 'устройству' : 'отделу' }}  <strong>{{ $name }}</strong> найдено - {{ $count }} записи(ей)!</h2>          
    </div>
    <div class="row justify-content-center mt-5">
        @if ($devices->isNotEmpty())
            <table class="table table-hover table-responsive">
                <thead>
                <tr>
                    <th width=10%>ID</th>
                    <th width=15%>Инв. №</th>
                    <th width=25%>Устройство</th>
                    <th width=30%>Отдел</th>             
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
        @endif
        
    </div>
</div>
@endsection