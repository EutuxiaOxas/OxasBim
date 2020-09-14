@extends('layouts.app')

@section('content')
<style type="text/css">
  .banner_principal{
    height: 60vh;
    background-size: cover;
    background-repeat: no-repeat;
    color: #fff;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }    
</style>

<section class="banner_principal" style="background: url({{asset('storage/'. $principal->image)}})">
    <h1>{{$principal->title}}</h1>
    <p>{{$principal->description}}</p>
</section>

<section class="container ">
    @php $contador = 1 @endphp
    @foreach($secciones as $seccion)
        @if($contador % 2 == 0)
        <div class="row banners_content py-5">
            <div class="banner_body col-6">
                <h2>{{$seccion->title}}</h2>
                <p>{{$seccion->description}}</p>
            </div>
            <div class="banner_img col-6 img-fluid">
                <img src="{{asset('storage/'.$seccion->image)}}" style="width: 100%; height: 70%; object-fit: cover;">
            </div>
        </div>
        @else
            <div class="row banners_content py-5">
                <div class="banner_img col-6 img-fluid">
                    <img src="{{asset('storage/'.$seccion->image)}}" style="width: 100%; height: 70%; object-fit: cover;">
                </div>
                <div class="banner_body col-6">
                    <h2>{{$seccion->title}}</h2>
                    <p>{{$seccion->description}}</p>
                </div>
            </div>
        @endif
        @php $contador++ @endphp
    @endforeach
</section>
@endsection
