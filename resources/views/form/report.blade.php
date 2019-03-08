@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $isdevice ? 'Поиск по устройству!' : 'Поиск по отделу!' }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ $isdevice ? route('report-device') : route('report-department')}}" enctype="multipart/form-data">
                        @csrf
                    
                        <div class="form-group row">
                            <label for="search" class="col-md-4 col-form-label text-md-right">{{ $isdevice ? 'Выберите устройство' : 'Выберите отдел' }}</label>
    
                            <div class="col-md-6">
                                <select class="form-control" id="search" name="search">
                                    @foreach ($list as $item)
                                        <option value="{{ $item->id }}">{{ $isdevice ? $item->device : $item->department}}</option>    
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- / form-group -->

                        <input type="hidden" value="{{ $isdevice }}" name="isdevice" id="isdevice">
                                                                   
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary mr-5">Поиск</button>
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