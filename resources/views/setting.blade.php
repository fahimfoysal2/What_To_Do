@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="card bg-{{$theme_name ?? 'light'}}">
                    <div class="card-header bg-light">{{ __('Settings') }}</div>

                    <div class="card-body bg-{{$theme_name ?? 'light'}} text-success">

                        <form method="POST" action="{{ route('setting.save') }}">
                            @csrf
                            @foreach(config('enums.settings') as $setting_name => $setting_data)
                                <div class="form-group row">
                                    <label for="end_time"
                                           class="col-md-4 col-form-label text-md-right">{{$setting_name}}</label>

                                    <div class="col-md-6">
                                        <select name="{{$setting_name}}" class="form-control" id="theme">
                                            @foreach($setting_data as $key=>$value)
                                                <option value={{$key}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endforeach

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update Setting') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
