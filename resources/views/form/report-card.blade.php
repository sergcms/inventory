@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ 'Введите инвентарный номер' }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('report-info')}}" enctype="multipart/form-data">
                        @csrf
                     
                        <div class="form-group row">
                            <label for="inventory" class="col-md-4 col-form-label text-md-right">Инвентарный №</label>

                            <div class="col-md-6">
                                <input id="inventory" type="text" class="form-control{{ $errors->has('inventory') ? ' is-invalid' : '' }}" name="inventory" value="{{ $device->inventory ?? old('inventory') }}" required autofocus>

                                @if ($errors->has('inventory'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('inventory') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- / form-group -->

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary mr-5">{{ __('Поиск') }}</button>
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