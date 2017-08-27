<table class="table table-hover" id="test">
        <thead>
        <tr>
            @foreach($columnNames as $columnName)
                @if($loop->index == 6 || $loop->index == 7) @continue
                @elseif($loop->index == 1)<th>College</th>
                @elseif($loop->index == 2)<th>Role</th>
                @else<th>{{ $columnName }}</th>
                @endif
            @endforeach
            <th>Actions</th>
        </tr>
        </thead>
        <tbody id="tableBody">
        @foreach($users as $user)
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
                <td>
                    <button type="button" class="btn btn-primary edit" data-toggle="modal" data-target="#add" id="update{{ $user->id }}">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"> Update</i>
                    </button>
                    <br><br>
                    <button type="button" class="btn btn-danger delete" data-toggle="modal" data-target="#delete" id="delete{{ $user->id }}">
                        <i class="fa fa-trash-o" aria-hidden="true"> Delete</i>
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

