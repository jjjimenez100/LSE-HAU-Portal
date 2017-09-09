@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Send Announcements</h4></div>

                    <div class="panel-body">
                        <form role="form" class="form-horizontal" id="addFormGrp">
                            {{ csrf_field() }}

                            <div class="form-group" id="SubjectFormGrp">
                                <label for="subject" class="col-sm-2 control-label">
                                    Subject</label>
                                <div class="col-sm-5">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" placeholder="Subject" id="subject" name="subject" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group" id="messageFormGrp">
                                <label for="message" class="col-sm-2 control-label">Message</label>
                                <div class="col-sm-5">
                                    <textarea class="form-control" rows="5" placeholder="Type your message here.." id="message"></textarea>
                                </div>
                            </div>

                            <div class="form-group" id="recipientsFormGrp">
                                <label for="recipients" class="col-sm-2 control-label">Recipients</label>
                                <div class="col-sm-5">
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

                            <div class="form-group" id="messageType">
                                <label for="messageType" class="col-sm-2 control-label">Send through:</label>
                                <div class="col-sm-5">
                                    <label class="checkbox-inline"><input type="checkbox"  id="email" name="email" checked>E-Mail</label>
                                    <label class="checkbox-inline"><input type="checkbox"  id="text" name="text">Text Message</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-5">
                                    <button class="btn btn-primary" id="send">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
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