@include('layouts/header')
<div class="container">

    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                <h4>{{$error}}</h4>
            </div>
    @endforeach
@endif

    <form class="text-center border border-light p-5" action="{{route('updateMovie')}}" method="post">
    {{csrf_field()}}
    <!-- Title -->
        <label for="movieTitle">Titel</label>
        <input type="text" id="movieTitle" name="titel" value="{{$movieData[0]->titel}}" class="form-control mb-4" placeholder="Titel">

        <!-- Year -->
        <label for="movieJaar">Jaar</label>
        <input type="text" id="movieJaar" name="jaar" value="{{$movieData[0]->jaar}}" class="form-control mb-4" placeholder="2019">

        <!-- Director -->
        <label for="movieRegisseur_id">Regisseur</label>
        <select name="movieRegisseur_id" class="form-control mb-4">
            @foreach($directors as $director)
                @if($director->regisseur_id == $movieData[0]->regisseur_id)
                    <option selected value="{{$director->regisseur_id}}">{{$director->fname}} {{$director->name}}</option>
                @else
                    <option value="{{$director->regisseur_id}}">{{$director->fname}} {{$director->name}}</option>
                @endif
            @endforeach

        </select>

        <!-- hiddem film_id -->
        <input type="hidden" name="film_id" value="{{$movieId}}">
        <br>
        <!-- Save button -->
        <button class="btn btn-info btn-block" type="submit">Save</button>


    </form>

</div>
<br>
@include('layouts/footer')
