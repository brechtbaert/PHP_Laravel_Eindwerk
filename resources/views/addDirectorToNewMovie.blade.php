@include('layouts/header')
<div class="container">
    @if(session('message'))
        <div class="alert alert-info" role="alert">
            <h4>{{session('message')}}</h4>
        </div>
    @endif
    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                <h4>{{$error}}</h4>
            </div>
    @endforeach
@endif

<!-- Begin form -->
    <form class="text-center border border-light p-5" action="{{route('addDirectorToNewMovie')}}" method="post">
    {{csrf_field()}}

        <h1>{{$title}} {{$year}}</h1>

        <!-- Director -->
        <label for="regisseur">Regisseur</label>
        <select name="regisseur" class="form-control mb-4">
            @foreach($directors as $director)
                <option value="{{$director->regisseur_id}}">{{$director->fname}} {{$director->name}}</option>
            @endforeach

        </select>
        <br>
        <!-- hiddem film_id -->
        <input type="hidden" name="film_id" value="{{$movieData[0]->film_id}}">
        <br>
        <!-- Save button -->
        <button class="btn btn-info btn-block" type="submit">Save</button>
        <br>


    </form>
    <!-- End form -->
</div>
@include('layouts/footer')
