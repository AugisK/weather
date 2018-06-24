<div class="container data">
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