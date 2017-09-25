@extends('layouts.app2')
@section('additionalFiles')
    <script>
        $(document).ready(function(){

            $(".filter-button").click(function(){
                var value = $(this).attr('data-filter');

                if(value == "all")
                {
                    //$('.filter').removeClass('hidden');
                    $('.filter').show('1000');
                }
                else
                {
                    //            $('.filter[filter-item="'+value+'"]').removeClass('hidden');
                    //            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
                    $(".filter").not('.'+value).hide('3000');
                    $('.filter').filter('.'+value).show('3000');

                }
            });

            if ($(".filter-button").removeClass("active")) {
                $(this).removeClass("active");
            }
            $(this).addClass("active");

        });
    </script>
@endsection
@section('content')
    <section class="container-full" style=" background: repeating-linear-gradient(45deg,#DBDBDB,#DBDBDB 2px,#F0F0F0 2px,#F0F0F0 4px); text-align: center;">

        <div class="gallery col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background: repeating-linear-gradient(45deg,#d4d4d4,#d4d4d4 2px,#e1e1e1 2px,#e1e1e1 4px); width: 100%; height: auto; padding: 20px 0 20px 0;">
            <div class="container">
                <h1 style="font-family: DKChalk !important; font-size: 72px; margin-bottom: 40px">Our Gallery</h1>
            </div>
            <div class="button-nav" align="center">
                <span class="glyphicon glyphicon-tags" aria-hidden="true"></span><h4 style="display: inline;"> Tags</h4>
                <button class="btn btn-default filter-button" data-filter="all">All Photos</button>
                <button class="btn btn-default filter-button" data-filter="Lipad">Lipad Album</button>
                <button class="btn btn-default filter-button" data-filter="Officers">LSE Officers</button>
            </div>
        </div>

        <div class="container" style="padding: 30px;">
            <div class="row">
                @for ($i = 1; $i <= 30; $i++)
                    @if($i == 9 || $i == 1 || $i == 3  || $i == 2)
                        @continue
                    @endif
                    <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter Lipad">
                        <img src="{{ asset('images/gallery/lipad/Lipad ('.$i.').jpg') }}" class="img-responsive" height="400" width="400">
                    </div>
                @endfor
                    <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter Lipad">
                        <img src="{{ asset('images/gallery/lipad/Lipad (1).jpg') }}" class="img-responsive" height="400" width="400">
                    </div>
                    @for ($i = 1; $i <= 28; $i++)
                        <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter Officers">
                            <img src="{{ asset('images/gallery/officers/Officers ('.$i.').jpg') }}" class="img-responsive" height="400" width="400">
                        </div>
                    @endfor

            </div>

        </div>
    </section>
@endsection

@section('modal')
    @include('partials.modals.success')
    @include('partials.modals.tryagain')
    @include('partials.LoginSignUpModal')
@endsection