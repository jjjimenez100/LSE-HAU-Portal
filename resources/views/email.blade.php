@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Send Email</h4></div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('confirmedEmail') }}">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="subject" class="col-md-4 control-label">Subject</label>

                                <div class="col-md-6">
                                    <input id="subj" type="text" class="form-control" name="subject">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="emailContent" class="col-md-4 control-label">Message</label>

                                <div class="col-md-6">
                                    <textarea rows="5" cols="30" name="emailContent">

                                    </textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="emailInputs" class="col-md-4 control-label">E-Mail Addresses</label>

                                <div class="col-md-6">
                                    <textarea rows="5" cols="30" name="emailInputs">

                                    </textarea>
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


