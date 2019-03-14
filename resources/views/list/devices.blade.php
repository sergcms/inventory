@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-between align-items-start">
        <h2>Список устройств</h2>
        <a href="{{ route('device-create') }}" class="btn btn-info text-white">Добавить устройство</a>
    </div>
    <div class="row">
        <table class="table table-hover table-responsive">
            <thead>
            <tr>
                <th width=10%>ID</th>
                <th width=70%>Устройство</th>             
                <th width=20%>Controls</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($devices as $oneDevice)
                <tr>
                    <td>{{ $oneDevice->id }}</td>
                    <td>{{ $oneDevice->device }}</td>
                    <td>
                        <a href="{{ route('device-edit', [$oneDevice->id]) }}" class="btn-edit mr-2"><i class="fas fa-pen edit"></i></a>                       
                        <a href="{{ route('device-delete', [$oneDevice->id]) }}" class="btn-delete mr-2" onclick="return confirm('Вы уверены?')"><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
