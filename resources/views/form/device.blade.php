@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ isset($id) ? 'Редактирование устройства' : 'Создание нового устройства' }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ isset($id) ? route('device-update', $id) : route('device-create')}}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="device" class="col-md-4 col-form-label text-md-right">{{ __('Устройство') }}</label>

                            <div class="col-md-6">
                                <input id="device" type="text" class="form-control{{ $errors->has('device') ? ' is-invalid' : '' }}" name="device" value="{{ $device->device ?? old('device') }}" required autofocus>

                                @if ($errors->has('device'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('device') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- / form-group -->
                                          
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary mr-5">{{ isset($id) ? __('Сохранить') : __('Создать') }}</button>
                                <a href="{{ route('device') }}" class="btn btn-secondary">Отмена</a> 
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