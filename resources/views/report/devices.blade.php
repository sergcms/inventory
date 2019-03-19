@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-between align-items-start">
        <h2>По {{ $isdevice ? 'устройству' : 'отделу' }}  <strong>{{ $name }}</strong> найдено - {{ $count }} записи(ей)!</h2>          
    </div>
    <div class="row mt-5">
        @if ($devices->isNotEmpty())
            <table class="table table-hover table-responsive">
                <thead>
                <tr>
                    <th width=10%>ID</th>
                    <th width=10%>Инв. №</th>
                    <th width=30%>Устройство</th>
                    <th width=30%>Отдел</th>             
                    <th width=20%>Состояние</th> 
                </tr>
                </thead>
                <tbody>
                @foreach ($devices as $device)
                    <tr>
                        <td>{{ $device->id }}</td>
                        <td><a href="{{ route('info', [$device->id]) }}"> {{ $device->inventory }} </a></td>
                        <td>{{ $device->device->device }}</td>
                        <td>{{ $device->department->department }}</td>
                        <td>{{ $device->condition }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
        
    </div>
    @if ($devices->isNotEmpty())
        {{ $devices->appends(\Request::except('page'))->render() }}
    @endif
</div>
@endsection