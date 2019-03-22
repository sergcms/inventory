@extends('layouts.app')

@section('content')
<div class="container">
    <script>
        lightgallery.init({
            enableZoom: false,
            overlayOpacity: .25,        
            fadeImage: false,
        });
    </script>
    <div class="row justify-content-between align-items-start">
        <h2>{{ $device->device->device }}</h2>
    </div>
    <div class="row mt-3 flex-column">
        @if ($device->photo != '')               
            <a rel="lightgallery" title="{{ $device->device->device }} - {{ $device->model }}" href="{{ $device->photo }}"><img src="{{ $device->photo }}" alt="" class="device-img"></a>         
        @endif             
        <ul class="device-characteristics mt-3">
            <li>Инв. №: <span>{{ $device->inventory }}</span></li>
            <li>Устройство: <span>{{ $device->device->device }}</span></li>
            <li>Местонахождение: <span>{{ $device->department->department }}</span></li>             
            <li>Состояние: <span>{{ $device->condition }}</span></li>                
            <li>Модель: <span>{{ $device->model }}</span></li>
            @if ($device->characteristic != '')
                <li>Характеристики: <span>{{ $device->characteristic }}</span></li>             
            @endif 
            @if ($device->movement != '')
                <li>Перемещение: <span>{{ $device->movement }}</span></li> 
            @endif            
            @if ($device->comment != '')
                <li>Коментарий: <span>{{ $device->comment }}</span></li> 
            @endif 
        </ul>
    </div>
</div>
@endsection