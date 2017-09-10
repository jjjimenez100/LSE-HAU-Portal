@extends('portal.portal-home')
@section('additionalcssfiles')
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
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header">
                <i class="fa fa-paper-plane" aria-hidden="true"></i> <strong>Send Announcements</strong>
            </h2>
        </div>
    </div>

        <div class="row">
            <div class="col-md-6">
                        <form role="form" class="form-horizontal" id="addFormGrp">
                            {{ csrf_field() }}

                            <div class="form-group" id="SubjectFormGrp">
                                <label for="subject" class="col-sm-2 control-label">
                                    Subject</label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" placeholder="Subject" id="subject" name="subject" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>

                            <div class="form-group" id="messageFormGrp">
                                <label for="message" class="col-sm-2 control-label">Message</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="7" placeholder="Type your message here.." id="message"></textarea>
                                </div>
                            </div>

                            <br>

                            <div class="form-group" id="recipientsFormGrp">
                                <label for="recipients" class="col-sm-2 control-label">Recipients</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="recipients" name="recipients">
                                        <option value="all">Everyone</option>
                                        <option value="heads">Officers and Admins</option>
                                        <option value="users">Users</option>
                                        <option value="officers">Officers</option>
                                        <option value="admins">Admins</option>
                                        <optgroup label="Registered members in event:">
                                            @foreach($events as $event)
                                                <option value="{{ $event->id }}">
                                                    {{ $event->eventName }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                            </div>

                            <br>

                            <div class="form-group" id="messageType">
                                <label for="messageType" class="col-sm-2 control-label">Send through:</label>
                                <div class="col-sm-10">
                                    <label class="checkbox-inline"><input type="checkbox"  id="email" name="email" checked><i class="fa fa-envelope" aria-hidden="true"></i> E-Mail</label>
                                    <label class="checkbox-inline"><input type="checkbox"  id="text" name="text"><i class="fa fa-mobile" aria-hidden="true" style="font-size: 130%;"></i> Text Message</label>
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="col-md-2"></div>
                                <div class="col-md-7">
                                    <button class="btn btn-primary" id="send" style="margin-right: 15px;">Send Message</button>
                                    <button class="btn btn-danger" type="reset">Reset Fields</button>
                                </div>
                            </div>

                        </form>

                        <br>
                    </div>

            <div class="col-md-6">
                <div class="jumbotron" style="vertical-align: middle;">
                    <h1><i class="fa fa-exclamation-circle text-danger" aria-hidden="true"></i> <span class="text-danger">Attention</span></h1>
                    <br>
                    <p>Please be wary of the messages you'll be sending to our members. Once the messages are queued, they cannot be cancelled anymore.
                    <br><br>If any errors occured, please contact the head admin as soon as possible.</p>
                </div>
            </div>
        </div>

    @include('partials.modals.success')
    @include('partials.modals.tryagain')
    @include('partials.modals.failed')
@endsection

@section('additionalScriptFiles')
    <script type="text/javascript" src="{{ asset('js/ajax.js') }}"></script>
    <script>
        $('#sendAnnouncements').addClass('active');
        //cache jquery selectors
        var subjectInput = $('#subject');
        var messageInput = $('#message');
        var recipientsChoice = $('#recipients');
        var emailChoice = $('#email');
        var textChoice = $('#text');
        var modalSuccess = $('#success');
        var modalFailed = $('#failed');
        var modalTryAgain = $('#tryAgain');
        var tryAgainText = $('#tryAgainText');
        var eChoice;
        var tChoice;
        $('#send').on('click', function(e){
            e.preventDefault();
            if(emailChoice.is(':checked') || textChoice.is(':checked')){
                sendAnnouncement();
            }
        });

        function getData(){
            eChoice = emailChoice.is(':checked');
            tChoice = textChoice.is(':checked');
            return{
              "subject" : subjectInput.val(),
                "message" : messageInput.val(),
                "recipients" : recipientsChoice.val(),
                "emailChoice" : eChoice,
                "textChoice" : tChoice
            };
        }
        function sendAnnouncement(){
            $.ajax({
               "type" : "post",
                "dataType" : "json",
                "url" : "{{ route('sendAnnouncements') }}",
                "data" : getData(),
                "success" : function(data){
                    if(eChoice && tChoice){
                        if(data.success.emailSuccess === "true" && data.success.smsSuccess === "true"){
                            modalSuccess.modal('show');
                        }

                        else{
                            modalTryAgain.modal('show');
                        }
                    }

                    else if(eChoice){
                        if(data.success.emailSuccess === "true"){
                            modalSuccess.modal('show');
                        }

                        else{
                            tryAgainText = "Something went wrong with our email server. Please try again.";
                            modalTryAgain.modal('show');
                        }
                    }

                    else if(tChoice){
                        if(data.success.smsSuccess === "true"){
                            modalSuccess.modal('show');
                        }

                        else{
                            modalTryAgain.modal('show');
                        }
                    }
                },
                "error" : function(data){
                    modalFailed.modal('show');
                }
            });
        }
    </script>
@endsection