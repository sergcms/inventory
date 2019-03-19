@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ isset($id) ? 'Редактирование отдела' : 'Создание нового отдела' }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ isset($id) ? route('department-update', $id) : route('department-create')}}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="department" class="col-md-4 col-form-label text-md-right">{{ __('Отдел') }}</label>

                            <div class="col-md-6">
                                <input id="department" type="text" class="form-control{{ $errors->has('department') ? ' is-invalid' : '' }}" name="department" value="{{ $department->department ?? old('department') }}" required autofocus>

                                @if ($errors->has('department'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('department') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- / form-group -->

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Адрес') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ $department->address ?? old('address') }}" autofocus>

                                @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- / form-group -->

                        @if ((isset($id)) && (auth()->user()->role == 'admin'))
                            <div class="form-group row">
                                <label for="user" class="col-md-4 col-form-label text-md-right">{{ __('Ответственный') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" id="user" name="user">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{ $department->user_id == $user->id ? 'selected' : '' }} >{{ $user->name }}</option>    
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- / form-group -->
                        @endif
                                                                  
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary mr-5">{{ isset($id) ? __('Сохранить') : __('Создать') }}</button>
                                <a href="{{ route('department') }}" class="btn btn-secondary">Отмена</a> 
                            </div>
                        </div>
                        <!-- / form-group -->

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection