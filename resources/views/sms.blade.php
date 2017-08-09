@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Send SMS</h4></div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('confirmedSms') }}">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="message" class="col-md-4 control-label">Message</label>

                                <div class="col-md-6">
                                    <textarea rows="5" cols="30" name="message">

                                    </textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="phoneNumbers" class="col-md-4 control-label">Phone Numbers</label>

                                <div class="col-md-6">
                                    <textarea rows="5" cols="30" name="phoneNumbers">

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


