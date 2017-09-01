<div class="modal fade" tabindex="-1" role="dialog" id="add">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    <i class="fa fa-calendar-o" aria-hidden="true"></i>
                    Events Information</h4>
            </div>
            <div class="modal-body">
                <form role="form" class="form-horizontal" method="POST" action="{{ route('register') }}" id="addFormGrp">
                    {{ csrf_field() }}

                    <div class="form-group" id="eventNameFormGrp">
                        <label for="eventName" class="col-sm-2 control-label">
                            Event Name</label>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" placeholder="Event Name" id="eventName" name="eventName" required/>
                                    <span class="help-block hidden" id="eventNameError">
                                <strong id="eventNameErrorText">Event name should be at least 6 characters long.</strong>
                            </span>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group" id="seatCountFormGrp">
                        <label for="contactNumber" class="col-sm-2 control-label">Seat Count</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="seatCount" name="seatCount" required/>
                            <span class="help-block hidden" id="seatCountError">
                        <strong id="seatCountErrorText">Seat Count should be a positive number.</strong>
                    </span>
                        </div>
                    </div>

                    <div class="form-group" id="eventDateFormGrp">
                        <label for="password" class="col-sm-2 control-label">Event Date</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="eventDate" placeholder="Event Date" name="eventDate" required/>
                            <span class="help-block hidden" id="eventDateError">
                        <strong id="eventDateErrorText">One cannot simply go back to the past.</strong>
                    </span>
                        </div>
                    </div>

                    <div class="form-group" id="eventPosterFormGrp">
                        <label for="password" class="col-sm-2 control-label">Event Poster</label>
                        <div class="col-sm-10">
                            <label class="btn btn-default" id="fileLabel">
                                Choose file to upload <input type="file" class="hidden" id="eventPoster" name="eventPoster" required/>
                            </label><br><br>
                            <img src="" id="posterPreview">
                            <p id="fileName"></p>
                            <span class="help-block" id="eventPosterError" style="color: red;">
                            <strong id="eventPosterErrorText">Do not choose and upload any file if you wish to keep the old one.</strong>
                            </span>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="triggerAdd" disabled>
                    <i class="fa fa-calendar-check-o" aria-hidden="true"></i> Add</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i> Close</button>
            </div>
        </div>
    </div>
</div>