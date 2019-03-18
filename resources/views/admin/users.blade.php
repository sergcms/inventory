@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-between align-items-start">
        <h2>Пользователи</h2>
        <div>
            <a href="{{ route('user-create') }}" class="btn btn-info text-white ml-2">Добавить пользователя</a>
        </div>   
    </div>
    <div class="row">
        <table class="table table-hover table-responsive">
            <thead>
            <tr>
                <th width=10%>@sortablelink('id', 'ID')</th>
                <th width=30%>@sortablelink('name', 'Name')</th>
                <th width=30%>@sortablelink('email', 'Email')</th>
                <th width=10%>@sortablelink('role', 'Роль')</th>
                <th width=10%>Состояние</th>                
                @if (auth()->user()->role == 'admin')
                    <th width=10%>Controls</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->isblock == 0 ? '-' : 'blocked' }}</td>
                    @if (auth()->user()->role == 'admin')
                        <td>
                            <a href="{{ route('user-edit', [$user->id]) }}" class="btn-edit mr-2"><i class="fas fa-pen edit"></i></a>                       
                            <a href="{{ route('user-delete', [$user->id]) }}" class="btn-delete mr-2" onclick="return confirm('Вы уверены?')"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{ $users->appends(\Request::except('page'))->render() }}
</div>
@endsection