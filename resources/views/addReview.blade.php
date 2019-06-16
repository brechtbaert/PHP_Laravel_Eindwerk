@include('layouts/header')
<div class="container">
    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                <h4>{{$error}}</h4>
            </div>
        @endforeach
    @endif

    <form class="text-center border border-light p-5" action="{{route('newReview')}}" method="post">
        {{csrf_field()}}
            <h1>{{$movieData[0]->titel}}</h1>


            <label for="rating">Rating</label>
            <input type="text" id="rating" name="rating" class="form-control mb-4" placeholder="Geef een getal tussen 1 en 10">


            <label for="review">Review</label>
            <textarea name="review" id="review" class="form-control mb-4" cols="30" rows="10" placeholder="Typ hier jouw review"></textarea>

            <!-- hiddem film_id -->
            <input type="hidden" name="film_id" value="{{$movieId}}">
            <br>
            <!-- Save button -->
            <button class="btn btn-info btn-block" type="submit">Save</button>
            <br>


    </form>




</div>
@include('layouts/footer')
