@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-between align-items-start">
        <h2>Отделы</h2>
        <a href="{{ route('department-create') }}" class="btn btn-info text-white">Создать отдел</a>
    </div>
    <div class="row">
        <table class="table table-hover table-responsive">
            <thead>
            <tr>
                <th width=10%>@sortablelink('id', 'ID')</th>
                <th width=20%>@sortablelink('department', 'Отдел')</th>             
                <th width=30%>@sortablelink('address', 'Адрес')</th>
                <th width=30%>@sortablelink('user.name', 'Ответственный')</th>             
                <th width=10%>Controls</th>
            </tr>
            </thead>
            <tbody>
            @if (isset($departments))
                @foreach ($departments as $oneDepartment)
                    <tr>
                        <td>{{ $oneDepartment->id }}</td>
                        <td>{{ $oneDepartment->department }}</td>
                        <td>{{ $oneDepartment->address ?? '-'}}</td>
                        <td>{{ $oneDepartment->user->name ?? auth()->user()->name }}</td>
                        <td>
                            <a href="{{ route('department-edit', [$oneDepartment->id]) }}" class="btn-edit mr-2"><i class="fas fa-pen edit"></i></a>                       
                            <a href="{{ route('department-delete', [$oneDepartment->id]) }}" class="btn-delete mr-2" onclick="return confirm('Вы уверены?')"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
    @if (isset($departments))
        {{ $departments->appends(\Request::except('page'))->render() }}
    @endif
</div>
@endsection