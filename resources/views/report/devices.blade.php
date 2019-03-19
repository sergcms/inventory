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
                    <th width=10%>@sortablelink('id', 'ID')</th>
                    <th width=10%>@sortablelink('inventory', 'Инв. №')</th>
                    <th width=30%>@sortablelink('device.device', 'Устройство')</th>
                    <th width=30%>@sortablelink('department.department', 'Отдел')</th>             
                    <th width=20%>@sortablelink('condition', 'Состояние')</th> 
                </tr>
                </thead>
                <tbody>
                @foreach ($devices as $device)
                    <tr>
                        <td>{{ $device->id }}</td>
                        <td>{{ $device->inventory }}</td>
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