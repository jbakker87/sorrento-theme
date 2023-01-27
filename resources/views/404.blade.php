@extends('layouts.app')

@section('content')
  <div class="container | my-5 my-md-7">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="bg-white p-3 p-md-4 text-center">
                <h1 aria-label="404" class="display-1">
                    4<div class="not-found-icon">@include('partials.icons.hat-chef')</div>4
                </h1>
                <p class="h2 font-weight-normal"><span class="font-weight-bold">Oeps</span>, hier gaat wat fout!
                </p>
                <p class="mb-2">
                    De pagina die u zocht is helaas niet gevonden.
                </p>
                <p>
                    Mogelijk bestaat de pagina niet meer of is er iets mis gegaan bij het intypen van de URL.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
