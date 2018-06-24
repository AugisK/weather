@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-lg-6 col-lg-offset-3">

            <form method="POST" action="/city">

                <!-- Add new city form -->
                <div class="row form-group">
                    <div class="input-group">
                        <input type="text" name="name" id="name" class="form-control" placeholder="City">
                        <button type="submit" class="input-group-addon success"><span class="glyphicon glyphicon-ok"></span></button>
                    </div>
                </div>

                {{ csrf_field() }}
            </form>
        </div>

    </div>

    <div class="container">
        {{--<div class="col-lg-12">--}}

            <!-- All cities table -->
        <ul class="row nav nav-tabs">
            @foreach ($weathers as $key=>$data)
                <li class="{{ $key==0 ? 'active' : ''}}"><a data-toggle="tab" href="#{{$data->name}}">{{$data->name}}</a></li>
            @endforeach
        </ul>
        <div class="row tab-content">

            @foreach ($weathers as $key=>$data)
                <div id="{{$data->name}}" class="tab-pane {{ $key==0 ? 'active' : ''}}">
                    <p>
                        Temperatūra: {{$data->main->temp}} C
                    </p>
                    <p>
                        Slėgis: {{$data->main->pressure}} mm Hg
                    </p>
                    <p>
                        Drėgnumas: {{$data->main->humidity}} %
                    </p>
                    <p>
                        Vėjo greitis: {{$data->wind->speed}} m/s
                    </p>
                    @foreach($data->weather as $weather)
                        <p>
                            Oras: {{$weather->main}}
                        </p>
                        <p>
                            Aprašymas: {{$weather->description}}
                        </p>
                    @endforeach
                </div>
            @endforeach

        </div>
        </div>
    {{--</div>--}}
@endsection