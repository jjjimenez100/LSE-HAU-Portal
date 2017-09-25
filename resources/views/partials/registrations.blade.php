<div>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist" id="eventsList">
        @foreach($container as $event)
            @foreach(array_keys($event) as $eventName)
                <li role="presentation"><a href="#{{ str_replace(' ', '', $eventName) }}" aria-controls="{{ str_replace(' ', '', $eventName) }}" role="tab" data-toggle="tab"><i class="fa fa-calendar" aria-hidden="true"></i> {{ $eventName }}</a></li>
            @endforeach
        @endforeach
    </ul>


    <!-- Tab panes -->

    <div class="tab-content" id="tblContents">
        @foreach($container as $event)
            @foreach(array_keys($event) as $eventName)
                <div role="tabpanel" class="tab-pane fade in" id="{{ str_replace(' ', '', $eventName) }}">
                    <br>
                    <p class="text-danger"><strong>Remaining seats: {{ $seatCounts[$loop->parent->index] }}</strong></p>
                    <table class="table table-hover" id="{{ str_replace(' ', '', $eventName) }}">
                        <thead>
                            @foreach($columnNames as $columnName)
                                @if($columnName == "created_at" || $columnName == "updated_at"
                                || $columnName == "password" || $columnName == "remember_token")
                                    @continue
                                @elseif($loop->index == 1)<th>College</th>
                                @elseif($loop->index == 2)<th>Role</th>
                                @elseif($columnName == "contactNumber")
                                    <th>Mobile #</th>
                                @elseif($columnName == "created_at")
                                    <th>Created</th>
                                @elseif($columnName == "updated_at")
                                    <th>Updated</th>
                                @elseif($columnName == "name")
                                    <th>Name</th>
                                @elseif($columnName == "email")
                                    <th>Email Address</th>
                                @else
                                    <th>{{ $columnName }}</th>
                                @endif
                            @endforeach
                        </thead>

                        <tbody>
                        @foreach($event as $registeredUser)
                            @foreach($registeredUser as $user)
                            <tr>
                                @foreach($columnNames as $columnName)
                                    @if($columnName == "created_at" || $columnName == "updated_at"
                                    || $columnName == "password" || $columnName == "remember_token")
                                        @continue
                                    @elseif($columnName == "collegeID")
                                        <td> {{ $user->college->collegeDepartment }}</td>
                                    @elseif($columnName == "roleID")
                                        <td> {{ $user->role->role }}</td>
                                    @else
                                        <td> {{ $user->$columnName }}</td>
                                    @endif
                                @endforeach
                            </tr>
                            @endforeach
                        @endforeach
                                @foreach($columnNames as $columnName)
                                    @if($columnName == "created_at" || $columnName == "updated_at"
                                    || $columnName == "password" || $columnName == "remember_token")
                                        @continue
                                    @endif

                                @endforeach
                        </tbody>
                    </table>
                    {{--@foreach($event as $registeredUser)
                        @foreach($registeredUser as $user)
                            <td> {{ $user->$columnName }}</td>
                        @endforeach
                    @endforeach--}}
                </div>
            @endforeach
        @endforeach
    </div>


</div>