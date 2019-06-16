@include('layouts/header')
<div class="container">

    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                <h4>{{$error}}</h4>
            </div>
        @endforeach
    @endif

    <form class="text-center border border-light p-5" action="{{route('updateDirector')}}" method="post">
        <!--Actor fname-->
        {{csrf_field()}}
        <label for="actorFname">Voornaam</label>
        <input type="text" id="directorFname" name="fname" value="{{$actorsData[0]->fname}}" class="form-control mb-4" placeholder="Fname">

        <!--Actor name-->
        <label for="directorName">Naam</label>
        <input type="text" id="directorName" name="name" value="{{$actorsData[0]->name}}"class="form-control mb-4" placeholder="Name">

        <!--hidden actorId-->
        <input type="hidden" name="directorId" value="{{$actorId}}">
        <br>
        <!--Save button-->
        <button class="btn btn-info btn-block" type="submit">Save</button>

    </form>
</div>
<br>
@include('layouts/footer')
