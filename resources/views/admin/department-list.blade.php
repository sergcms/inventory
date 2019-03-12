@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-between align-items-start">
        <h2>Отделы</h2>
        <a href="{{ route('department-create') }}" class="btn btn-info text-white">Создать отдел</a>
    </div>
    <div class="row justify-content-center">
        <table class="table table-hover table-responsive">
            <thead>
            <tr>
                {{-- <th width=10%>ID</th> --}}
                <th width=20%>Отдел</th>             
                <th width=40%>Адрес</th>
                <th width=30%>Ответственный</th>             
                <th width=10%>Controls</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($departments as $oneDepartment)
                <tr>
                    {{-- <td>{{ $oneDepartment->department_id }}</td> --}}
                    <td>{{ $oneDepartment->department }}</td>
                    <td>{{ $oneDepartment->address ?? '-'}}</td>
                    <td>{{ $oneDepartment->name ?? auth()->user()->name }}</td>
                    <td>
                        <a href="{{ route('department-edit', [$oneDepartment->id]) }}" class="btn-edit mr-2"><i class="fas fa-pen edit"></i></a>                       
                        <a href="{{ route('department-delete', [$oneDepartment->id]) }}" class="btn-delete mr-2" onclick="return confirm('Вы уверены?')"><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection