@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Add New City</h2>

        <form method="POST" action="/city">

            <!-- Add new city form -->
            <div class="form-group">
                <input type="text" name="name" id="name" class="form-control">
            </div>


            <div class="form-group">
                <button type="submit" class="btn btn-primary">Add City</button>
            </div>
            {{ csrf_field() }}
        </form>


    </div>
    <div class="container">

            <!-- All cities table -->
            <table class="table">
                <thead><tr>
                    <th colspan="2">Cities</th>
                </tr>
                </thead>
                <tbody>@foreach($cities as $city)
                    <tr>
                        <td>
                            {{$city->name}}
                        </td>
                    </tr>


                @endforeach</tbody>
            </table>

    </div>
@endsection