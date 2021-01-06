@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-{{$theme_name ?? 'light'}}">
                    <div class="card-header bg-light">{{ __('Settings') }}</div>

                    <div class="card-body bg-{{$theme_name ?? 'light'}} text-success">


                        <form method="POST" action="{{ route('setting.save') }}">

                            @csrf

                            <div class="form-group row">
                                <label for="end_time"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Theme') }}</label>

                                <div class="col-md-6">
                                    <select name="theme_id" class="form-control" id="theme">
                                        {{--            @foreach(config('enums.enums.settings.theme_name') as $x=>$y)--}}
                                        <option value="1">{{config('enums.settings.theme_name.1')}}</option>
                                        <option value="2">{{config('enums.settings.theme_name.2')}}</option>
                                        {{--            @endforeach--}}
                                    </select>
                                </div>
                            </div>

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
