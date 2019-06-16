@include('layouts/header')
<div class="container">
    @if(session('message'))
        <div class="alert alert-info" role="alert">
            <h4>{{session('message')}}</h4>
        </div>
    @endif
    <h1>{{$movieData[0]->titel}}</h1>
    <p>Deze film werd uitgebracht in {{$movieData[0]->jaar}}</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad adipisci dicta dolorem earum eos est facilis maxime nostrum voluptatum! Eius enim inventore omnis porro rem. At facere non odit quibusdam!</p>

    <h2>Reviews</h2>
    @if($movieReviews->isEmpty())
        <p>Er zijn nog geen reviews voor deze film. Schrijf als eerste een review.</p>
    @else
        <p>Geschreven door {{$movieReviews[0]->name}} :</p>
        <br>
        <p>{{$movieReviews[0]->rating}} op 10</p>
        <br>
        <p>{{$movieReviews[0]->review}}</p>
        <br>
    @endif
    <br>
    <button class="btn btn-info" type="button" onclick="window.location='{{route("addReview",['film_id'=>$movieId])}}'">Schrijf een review</button>
    <br><br>
    <button class="btn-info btn" type="button" onclick="window.location='{{route("showAddActorToMovie",['film_id'=>$movieId])}}'">Voeg een acteur toe</button>

</div>
<br>
@include('layouts/footer')
