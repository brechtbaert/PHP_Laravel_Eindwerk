@include('layouts/header')

<div class="container">

    @if(session('message'))
        <div class="alert alert-info" role="alert">
            <h4>{{session('message')}}</h4>
        </div>
    @endif
    <table class="table table-responsive">
        <thead class="thead-dark">
        <tr>
            <th>Titel</th>
            <th>Jaar</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>

        @foreach($movies as $movie)
            <tr>
                <td>{{$movie->titel}}</td>
                <td>{{$movie->jaar}}</td>
                <td><a href="{{route("editMovie",['filmId' => $movie->film_id])}}">Edit</a>
                    |
                    <a href="{{route("deleteMovie",['filmId' => $movie->film_id])}}">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>
</div>

@include('layouts/footer')
