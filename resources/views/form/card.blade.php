@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ isset($id) ? 'Редактирование описания устройства' : 'Добавление описания устройства' }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ isset($id) ? route('card-update', $id) : route('card-create')}}" enctype="multipart/form-data">
                        @csrf
                     
                        <div class="form-group row">
                            <label for="photo" class="col-md-4 col-form-label text-md-right">Фото</label>
                            
                            <div class="col-md-6">
                                <input type="file" class="form-control-file{{ $errors->has('photo') ? ' is-invalid' : '' }}" id="photo" name="photo">
                                
                                @if ($errors->has('photo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- / form-group  -->

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

                        <div class="form-group row">
                            <label for="model" class="col-md-4 col-form-label text-md-right">Модель</label>

                            <div class="col-md-6">
                                <input id="model" type="text" class="form-control{{ $errors->has('model') ? ' is-invalid' : '' }}" name="model" value="{{ $device->model ?? old('model') }}" required autofocus>

                                @if ($errors->has('model'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('model') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- / form-group -->

                        <div class="form-group row">
                            <label for="device" class="col-md-4 col-form-label text-md-right">Устройство</label>
    
                            <div class="col-md-6">
                                <select class="form-control" id="device" name="device">
                                    @foreach ($devices as $oneDevice)
                                        @if (isset($device->device_id))
                                            @if ($device->device_id == $oneDevice->id)
                                                <option value="{{ $oneDevice->id }}" selected>{{ $oneDevice->device }}</option>    
                                            @else 
                                                <option value="{{ $oneDevice->id }}">{{ $oneDevice->device }}</option>    
                                            @endif
                                        @else                                 
                                            <option value="{{ $oneDevice->id }}">{{ $oneDevice->device }}</option>    
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- / form-group -->

                        <div class="form-group row">
                            <label for="department" class="col-md-4 col-form-label text-md-right">Отдел</label>
    
                            <div class="col-md-6">
                                <select class="form-control" id="department" name="department">
                                    @foreach ($departments as $oneDepartment)
                                        @if (isset($device->department_id))
                                            @if ($device->department_id == $oneDepartment->id)
                                                <option value="{{ $oneDepartment->id }}" selected>{{ $oneDepartment->department }}</option> 
                                            @else
                                                <option value="{{ $oneDepartment->id }}">{{ $oneDepartment->department }}</option> 
                                            @endif   
                                        @else                                 
                                            <option value="{{ $oneDepartment->id }}">{{ $oneDepartment->department }}</option> 
                                        @endif                                           
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- / form-group -->
                        
                        <div class="form-group row">
                            <label for="characteristic" class="col-md-4 col-form-label text-md-right">Характеристики</label>

                            <div class="col-md-6">
                                <input id="characteristic" type="text" class="form-control{{ $errors->has('characteristic') ? ' is-invalid' : '' }}" name="characteristic" value="{{ $device->characteristic ?? old('characteristic') }}" required autofocus>

                                @if ($errors->has('characteristic'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('characteristic') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- / form-group -->

                        <div class="form-group row">
                            <label for="condition" class="col-md-4 col-form-label text-md-right">Состояние</label>
    
                            <div class="col-md-6">
                                <select class="form-control" id="condition" name="condition">
                                    @foreach ($status as $item)
                                        @if (isset($device->condition))
                                            <option value="{{ $item }}" {{ $device->condition == $item ? 'selected' : '' }} >{{ $item }}</option>    
                                        @else
                                            <option value="{{ $item }}">{{ $item }}</option>    
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- / form-group -->
                        
                        <div class="form-group row">
                            <label for="movement" class="col-md-4 col-form-label text-md-right">Перемещения</label>
                            <div class="col-md-6">
                                <textarea name="movement" class="form-control{{ $errors->has('movement') ? ' is-invalid' : '' }}" id="movement" rows="5">{{ $device->movement ?? old('movement') }}</textarea>	
                            
                                @if ($errors->has('movement'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('movement') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- / form-group  -->
                        
                        <div class="form-group row">
                            <label for="comment" class="col-md-4 col-form-label text-md-right">Комментарий</label>
                            <div class="col-md-6">
                                <textarea name="comment" class="form-control{{ $errors->has('comment') ? ' is-invalid' : '' }}" id="comment" rows="5">{{ $device->comment ?? old('comment') }}</textarea>	
                            
                                @if ($errors->has('comment'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- / form-group  -->
                                                                
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary mr-5">{{ isset($id) ? __('Сохранить') : __('Создать') }}</button>
                                <a href="{{ route('card') }}" class="btn btn-secondary">Отмена</a> 
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