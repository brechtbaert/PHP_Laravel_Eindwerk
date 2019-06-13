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
                <th>Voornaam</th>
                <th>Naam</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($directors as $director)
                <tr>
                    <td>{{$director->fname}}</td>
                    <td>{{$director->name}}</td>
                    <td><a href="{{route("editDirector",['directorId' => $director->regisseur_id])}}">Edit</a>
                        |
                        <a href="{{route("deleteDirector",['directorId' => $director->regisseur_id])}}">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>

        <a href="{{route("newDirector")}}" class="btn btn-info">Voeg een nieuwe regisseur toe</a>
</div>
<br>
@include('layouts/footer')
