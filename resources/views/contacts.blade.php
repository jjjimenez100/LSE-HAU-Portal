@extends('layouts.app2')

@section('additionalFiles')
    <style>
        .loadingDiv {
            display:    none;
            position:   fixed;
            z-index:    1000;
            top:        0;
            left:       0;
            height:     100%;
            width:      100%;
            background: rgba( 255, 255, 255, .8 )
            url('https://www.thestudio.com/wp-content/themes/thestudio/images/lightbox/filters-load.gif')
            50% 50%
            no-repeat;
        }

        body.loading {
            overflow: hidden;
        }

        body.loading .loadingDiv {
            display: block;
        }
    </style>
@endsection
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
                <div id="map" style="height: 400px; width: 100%; border: 10px solid #C95538; border-radius: 20px;"></div>
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
                <div class="side-panel" style="background: #F5B041; color: white;">
                    <h5>
                        <span style="font-size: 15px;"><strong>League of Students for Excellence</strong></span></br></br>
                        Holy Angel University<br/> One St. Santo Rosario St,</br>
                        Angeles City, Pampanga</br></br>
                        HAU Tel. (045) 887 5748<br/>
                        lsehauofficial@gmail.com<br/>
                        <a class="ref-link" style="color: white; text-decoration: underline;" href="http://hau.edu.ph/">hau.edu.ph</a>
                        <div style="height: 70px; display: block;"></div>
                        <img src="{{ asset('images/hau-campusmap-2016.jpg') }}" width="240" class="img-responsive center-block"/>
                        <div style="height: 20px; display: block;"></div>
                        <a class="ref-link" style="color: #FEF9E7; text-decoration: underline;" href="{{ asset('images/hau-campusmap-2016.jpg') }}" download>Download Campus Map</a>
                    </h5>
                </div>
                <form role="form" method="POST" action="http://formspree.io/lsehauofficial@gmail.com" id="contactForm">
                    <div class="contact-container" style="background: #F9E79F;">

                            <h4>Have <strong>comments</strong> or <strong>suggestions</strong>? Send us a <strong style="color: #F39C12;">message</strong>.</h4></br>
                            <div class="form-group" id="nameFormGrp">
                                <label for="contact-name" class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control" id="contact-name" placeholder="Full Name" />
                                    <span class="help-block hidden" id="nameError">
                                         <strong id="nameErrorText">Please input a name.</strong>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group" id="emailFormGrp">
                                <label for="contact-email" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" name="_replyto" class="form-control" id="contact-email" placeholder="Email" />
                                    <span class="help-block hidden" id="emailError">
                                        <strong id="emailErrorText">Emails should at least contain both @ and . symbols.</strong>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group" id="contactNumberFormGrp">
                                <label for="contact-mobile" class="col-sm-2 control-label">Contact Number</label>
                                <div class="col-sm-10">
                                    <input type="text" name="contactNumber" class="form-control" id="contact-mobile" placeholder="Mobile (+63) (Optional)" />
                                    <span class="help-block hidden" id="contactError">
                                        <strong id="contactNumberErrorText"></strong>
                                    </span>
                                </div>
                            </div><br>
                            <div class="form-group" id="commentFormGroup">
                                <label for="contact-comment" class="col-sm-2 control-label">Comments/ Suggestions: </label>
                                <div class="col-sm-10">
                                    <textarea style="height: 300px;" class="form-control" id="contact-comment" name="comment" placeholder="What do you think about LSE?"></textarea>
                                    <span class="help-block hidden" id="commentError">
                                        <strong id="commentErrorText">Please put a message.</strong>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-12" style="margin: 30px;">
                                <button type="submit" class="btn btn-primary" style="font-size: 16px; width: 220px; height: 40px;" id="btnSave" value="Send">Submit</button>
                            </div>

                    </div>
                </form>
            </div>

        </div>
        <div style="display:block; height: 100px;"></div>
    </section>
    @include('partials.Banner')
    <div class="loadingDiv"><!-- Place at bottom of page --></div>
@endsection

@section('modal')
    @include('partials.modals.success')
    @include('partials.modals.tryagain')
    @include('partials.LoginSignUpModal')
    <script type="text/javascript" src="{{ asset('js/validations.js') }}"></script>
    <script>
        var commentInput = $('#contact-comment');
        var commentGroup = $('#commentFormGroup');
        var commentError = $('#commentError');
        var comError = true;

        var inputEmail = $('input[name="_replyto"]');
        var btnSave = $('#btnSave');

        btnSave.addClass('disabled');
        btnSave.prop('disabled', true);

        inputContactNumber.on('input', validateContactNumber);
        inputName.on('input', validateName);
        inputEmail.on('input', validateEmail);
        commentInput.on('input', validateComment);

        $body = $("body");

        $(document).on({
            ajaxStart: function() { $body.addClass("loading");    },
            ajaxStop: function() { $body.removeClass("loading"); }
        });
        $('#CONTACT').addClass('active');

        var success = $('#success');
        var tryAgain = $('#tryAgain');
        var form = $('#contactForm');

        form.submit(function(e){
            e.preventDefault();
            $.ajax({
               "url" :  "http://formspree.io/lsehauofficial@gmail.com",
                "method" : "POST",
                "data" : $(this).serialize(),
                "dataType" : "json",
                "success" : function(data){
                   success.modal('show');
                },
                "error" : function(data){
                    tryAgain.modal('show');
                }
            });
        });

        function validateComment(){
            var comment = commentInput.val().replace(/^\s+/, "").replace(/\s+$/, "").replace(/\s+/, " ");

            if(comment === ""){
                commentGroup.removeClass('has-success');
                commentGroup.addClass('has-error');
                commentError.removeClass('hidden');
                comError = true;
            }

            else{
                commentGroup.removeClass('has-error');
                commentError.addClass('hidden');
                commentGroup.addClass('has-success');
                comError = false;
            }
            isValid();
        }
        function isValid(){
            if(emailError === false
                && emailError === false
                && contactError === false
                && comError === false
                && nameError == false){
                btnSave.removeClass('disabled');
                btnSave.prop('disabled', false);
            }
            else{
                btnSave.addClass('disabled');
                btnSave.prop('disabled', true);
            }
        }
    </script>
@endsection