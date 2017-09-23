<section class="container-fluid">
    <div class="row">
        <div class="box-1 col-md-6">
            <div class="page-headline">
                <h2 style="text-align: right; font-weight: bold;">
                    Stay <span style="color:#F39C12">Updated</span> with LSE.
                </h2>
                <h4 class="hidden-xxs">
                    Like us on Facebook, Follow us on Twitter, and Google +.<br/>
                </h4>
                <a href="https://www.facebook.com/lsehauofficial/"><i class="fa fa-facebook-square" style="font-size:48px;color:white; padding: 10px;"></i></a>
                <a href="https://twitter.com/LSEHAUofficial"><i class="fa fa-twitter-square" style="font-size:48px;color:white; padding: 10px;"></i></a>
                <a href="#"><i class="fa fa-google-plus-square" style="font-size:48px;color:white; padding: 10px;"></i></a>
            </div>
            <div class="box-footer-1"></div>
        </div>

        <div class="box-2 col-md-6">
            <div class="page-headline">
                <h2 style="text-align: left;font-weight: bold;">
                    <span style="color:#F39C12">Log In</span> or <span style="color:#F39C12">Sign Up</span> Now.
                </h2>
                <h4 class="hidden-xxs">
                    Take a seat with us and together, we'll pass this semester!
                </h4>
                @if(!Auth::check())
                    <button type="button" class="btn btn-transparent login" data-toggle="modal" data-target="#myModal">Login</button>
                    <button type="button" class="btn btn-transparent register" data-toggle="modal" data-target="#myModal">Sign Up</button>
                @else
                    @if(Auth::user()->role->role != "User")
                        <a href="{{ route('users.index') }}" style="color: white;" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span> Back to Portal</a>
                    @else
                        <a href="{{ route('profile') }}" style="color: white;" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span> Back to Portal</a>
                    @endif
                @endif
            </div>
            <div class="box-footer-2"></div>
        </div>
    </div>
</section>
<div class="box-footer-end" style="height: 65px;"></div>