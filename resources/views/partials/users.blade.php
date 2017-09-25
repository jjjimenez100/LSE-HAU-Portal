<table class="table table-hover" id="tblUsers">
        <thead>
        <tr>
            @foreach($columnNames as $columnName)
                @if($loop->index == 6 || $loop->index == 7) @continue
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
            <th>Actions</th>
        </tr>
        </thead>
        <tbody id="tableBody">
        @foreach($users as $user)
            @if(Auth::user()->role->role == "Officer")
                @if($user->role->role == "User" || Auth::user()->email == $user->email)
                    <tr id="{{ $user->id }}">
                        @foreach($columnNames as $columnName)
                            @if($columnName == "password" || $columnName == "remember_token")
                                @continue
                            @elseif($columnName == "collegeID")
                                <td>{{ $colleges[($user->$columnName)-1]['collegeDepartment'] }}</td>
                            @elseif($columnName == "roleID")
                                <td>{{ $roles[($user->$columnName)-1]['role'] }}</td>
                            @else
                                <td>{{ $user->$columnName }}</td>
                            @endif
                        @endforeach
                        <td class="text-nowrap">
                            <button type="button" class="btn btn-primary edit" data-toggle="modal" data-target="#add" id="update{{ $user->id }}">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </button>
                            @if(Auth::user()->email != $user->email)
                                <button type="button" class="btn btn-danger delete" data-toggle="modal" data-target="#delete" id="delete{{ $user->id }}">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </button>
                            @endif
                            @if(Auth::user()->role->role != "Officer" && Auth::user()->email == $user->email)
                                <button type="button" class="btn btn-default resetPass" data-toggle="modal" data-target="#confirmation" id="resets{{ $user->id }}">
                                    <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                                </button>
                            @endif
                        </td>
                    </tr>
                    @endif
                @else
                    <tr id="{{ $user->id }}">
                        @foreach($columnNames as $columnName)
                            @if($columnName == "password" || $columnName == "remember_token")
                                @continue
                            @elseif($columnName == "collegeID")
                                <td>{{ $colleges[($user->$columnName)-1]['collegeDepartment'] }}</td>
                            @elseif($columnName == "roleID")
                                <td>{{ $roles[($user->$columnName)-1]['role'] }}</td>
                            @else
                                <td>{{ $user->$columnName }}</td>
                            @endif
                        @endforeach
                        <td class="text-nowrap">
                            <button type="button" class="btn btn-primary edit" data-toggle="modal" data-target="#add" id="update{{ $user->id }}">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </button>
                            @if(Auth::user()->email != $user->email)
                                <button type="button" class="btn btn-danger delete" data-toggle="modal" data-target="#delete" id="delete{{ $user->id }}">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </button>
                            @endif
                            <button type="button" class="btn btn-default resetPass" data-toggle="modal" data-target="#confirmation" id="resets{{ $user->id }}">
                                <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>
                @endif
        @endforeach
        </tbody>
    </table>

