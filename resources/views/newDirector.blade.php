@include('layouts/header')
<div class="container">

    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                <h4>{{$error}}</h4>
            </div>
    @endforeach
@endif
<!-- Begin form -->
    <form class="text-center border border-light p-5" action="{{route('addNewDirector')}}" method="post">
    {{csrf_field()}}

        <!-- Voornaam -->
        <input type="text" id="directorFname" name="fname"  class="form-control mb-4" placeholder="Voornaam">
        <br>
        <!-- Naam -->
        <input type="text" id="directorName" name="name" class="form-control mb-4" placeholder="Achternaam">
        <br>
        <!-- Save button -->
        <button class="btn btn-info btn-block" type="submit">Save</button>
        <br>


    </form>
    <!-- End form -->
</div>
@include('layouts/footer')
