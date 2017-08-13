@extends('layouts.app2')

@section('content')
    <section class="container-full" style=" background: repeating-linear-gradient(45deg,#DBDBDB,#DBDBDB 2px,#F0F0F0 2px,#F0F0F0 4px); text-align: center;">
        <div id="about-header" style="text-align: left; background: repeating-linear-gradient(45deg,#d4d4d4,#d4d4d4 2px,#e1e1e1 2px,#e1e1e1 4px); width: 100%; height: auto; padding: 20px 0 40px 0;">
            <div class="container">
                <h1 style="font-family: DKChalk !important; font-size: 72px;">Contact Us</h1>
                <h4><a href="home.html" style="color: #333;"><span class="glyphicon glyphicon-home"></span></a> / Contact </h4>
            </div>
        </div>
        <div id="about-body" style="padding: 20px 0 20px 0;">
            <div class="container">
                <div id="map" style="height: 400px; width: 100%; border: 10px solid #777; border-radius: 20px;"></div>
                    <script>
                    function initMap() {
                        var uluru = {lat: 15.133207, lng: 120.590039};
                        var map = new google.maps.Map(document.getElementById('map'), {
                            zoom: 17,
                            center: uluru
                        });
                        var marker = new google.maps.Marker({
                            position: uluru,
                            map: map
                        });
                    }
                </script>
                    <script async defer
                                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAT2yZLGw6sA_WjA4wOBCB8SgtjHlhqoHY&callback=initMap">
                </script>
                <div style="display:block; height: 5px;"></div>
                <div class="side-panel">
                    <h5>
                        <span style="font-size: 15px;"><strong>League of Students for Excellence</strong></span></br></br>
                        Holy Angel University<br/> One St. Santo Rosario St,</br>
                        Angeles City, Pampanga</br></br>
                        HAU Tel. (045) 887 5748<br/>
                        lsehauofficial@gmail.com<br/>
                        <a class="ref-link" style="color: #F39C12; text-decoration: underline;" href="http://hau.edu.ph/">hau.edu.ph</a>
                        <div style="height: 70px; display: block;"></div>
                        <img src="{{ asset('images/hau-campusmap-2016.jpg') }}" width="240" class="img-responsive center-block"/>
                        <div style="height: 20px; display: block;"></div>
                        <a class="ref-link" style="color:#F39C12;" href="{{ asset('images/hau-campusmap-2016.jpg') }}" download>Download Campus Map</a>
                    </h5>
                </div>

                <div class="contact-container">

                    <h4>Have <strong>comments</strong> or <strong>suggestions</strong>? Send us a <strong style="color: #F39C12;">message</strong>.</h4></br>
                    <div class="form-group">
                        <label for="contact-name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="contact-name" placeholder="Full Name" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="contact-email" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="contact-email" placeholder="Email" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="contact-mobile" class="col-sm-2 control-label">Contact Number</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="contact-mobile" placeholder="Mobile (+63) (Optional)" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="contact-comment" class="col-sm-2 control-label">Comments/ Suggestions: </label>
                        <div class="col-sm-10">
                            <textarea style="height: 300px;" class="form-control" id="contact-comment" placeholder="What do you think about LSE?"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-12" style="margin: 30px;">
                        <button type="submit" class="btn btn-primary" style="font-size: 16px; width: 220px; height: 40px;">Submit</button>
                    </div>

                </div>

            </div>

        </div>
        <div style="display:block; height: 100px;"></div>
    </section>
    @include('partials.Banner')
@endsection

@section('modal')
    @include('partials.LoginSignUpModal')
    <script>
        $('#CONTACT').addClass('active');
    </script>
@endsection