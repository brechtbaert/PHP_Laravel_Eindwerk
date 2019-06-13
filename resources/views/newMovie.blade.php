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
    <form class="text-center border border-light p-5" action="{{route('addNewMovie')}}" method="post">
    {{csrf_field()}}

    <!-- Titel -->
        <input type="text" id="movieTitle" name="titel"  class="form-control mb-4" placeholder="Titel">
        <br>
        <!-- Jaar -->
        <input type="text" id="movieJaar" name="jaar" class="form-control mb-4" placeholder="2019">
        <br>
        <!-- Sign in button -->
        <button class="btn btn-info btn-block" type="submit">Save</button>
        <br>


    </form>
    <!-- End form -->
</div>
@include('layouts/footer')
