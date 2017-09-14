<br>
<img src="{{ asset('images/lse-logo2.png') }}" style="width: 220px;, height: 220px;" class="center-block">

<li id="home">
    <a href="#"><strong><i class="fa fa-home" style="font-size: 125%; padding-right: 5%;"></i> Portal Home Page</strong></a>
</li>

<li id="membersManagement">
    <a href="{{ route('users.index') }}"><strong><i class="fa fa-users" aria-hidden="true" style="font-size: 125%; padding-right: 5%;"></i> Members Management</strong></a>
</li>

<li id="viewRegistrations">
    <a href="{{ route('registrations') }}"><strong><i class="fa fa-list-ol" aria-hidden="true" style="font-size: 125%; padding-right: 5%;"></i> View Event Registrations</strong></a>
</li>
<li id="eventsManagement">
    <a href="{{ route('events.index') }}"><strong><i class="fa fa-calendar" aria-hidden="true" style="font-size: 125%; padding-right: 5%;"></i> Events Management</strong></a>
</li>
<li id="sendAnnouncements">
    <a href="{{ route('announcements') }}"><strong><i class="fa fa-paper-plane" aria-hidden="true" style="font-size: 125%; padding-right: 5%;"></i> Send Announcements</strong></a>
</li>

<li id="conferencingRooms">
    <a href="#"><strong><i class="fa fa-video-camera" aria-hidden="true" style="font-size: 125%; padding-right: 5%;"></i> Conferencing Rooms</strong></a>
</li>

<li id="logout">
    <a href="#"><strong><i class="fa fa-fw fa-power-off" style="font-size: 125%; padding-right: 5%;"></i> Log Out</strong></a>
</li>