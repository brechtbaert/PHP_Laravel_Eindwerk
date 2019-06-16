@include('layouts/header')
<div class="container">
    <h1>{{$movieData[0]->titel}}</h1>
    <p>Kies een acteur:</p>
    <form class="text-center border border-light p-5" action="{{route('addActorMovie')}}" method="post">
        {{csrf_field()}}
        <select name="acteur" class="form-control mb-4">
        @foreach($actors as $actor)
                <option value="{{$actor->acteur_id}}">{{$actor->fname}} {{$actor->name}}</option>
        @endforeach
        </select>
            <!-- hiddem film_id -->
            <input type="hidden" name="film_id" value="{{$movieId}}">
            <br>
            <!-- Save button -->
            <button class="btn btn-info" type="submit">Save</button>
    </form>
</div>
<br>
@include('layouts/footer')
