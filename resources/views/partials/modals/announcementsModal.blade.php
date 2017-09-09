<!-- Modal -->
<div class="modal fade" id="announcements" tabindex="-1" role="dialog" aria-labelledby="announcements">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Send announcement</h4>
            </div>
            <div class="modal-body">
                <form role="form" class="form-horizontal" method="POST"  id="announcementForm">
                    {{ csrf_field() }}
                    <div class="form-group" id="subjectFormGrp">
                        <label for="subject" class="col-sm-2 control-label">
                            Subject</label>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" placeholder="Subject" id="subject" name="subject" required/>
                                    <span class="help-block hidden" id="subjectError">
                                        <strong id="subjectErrorText">Event name should be at least 6 characters long.</strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" id="messageFormGrp">
                        <label for="message" class="col-sm-2 control-label">
                            Message</label>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-md-12">
                                    <textarea class="form-control" rows="5" id="message" placeholder="Type your message here.." required></textarea>
                                    <span class="help-block hidden" id="messageError">
                                        <strong id="messageErrorText">Event name should be at least 6 characters long.</strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">As Text Message</button>
                <button type="button" class="btn btn-success">As Email</button>

                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


//
<button class="btn btn-primary" style="float: right;" data-toggle="modal" data-target="#announcements">Announcements</button>