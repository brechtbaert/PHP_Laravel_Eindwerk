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
        @foreach($actors as $actor)
            <tr>
                <td>{{$actor->fname}}</td>
                <td>{{$actor->name}}</td>
                <td><a href="{{route("editActor",['actorId' => $actor->acteur_id])}}">Edit</a>
                    |
                    <a href="{{route("deleteActor",['actorId' => $actor->acteur_id])}}">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>

    <a href="{{route("newActor")}}" class="btn btn-info">Voeg een nieuwe acteur toe</a>
</div>
<br>
@include('layouts/footer')
