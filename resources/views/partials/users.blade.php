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
        <tbody>
        @foreach($users as $user)
            <tr id="{{ $user->id }}">
                @foreach($columnNames as $columnName)
                    @if($loop->index == 6 || $loop->index == 7)
                        @continue
                    @elseif($loop->index == 1)
                        <td>{{ $colleges[($user->$columnName)-1]['collegeDepartment'] }}</td>
                    @elseif($loop->index == 2)
                        <td>{{ $roles[($user->$columnName)-1]['role'] }}</td>
                    @else
                        <td>{{ $user->$columnName }}</td>
                    @endif
                @endforeach
                <td>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit">
                        <i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 120%;"></i>
                    </button>

                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete">
                        <i class="fa fa-trash-o" aria-hidden="true" style="font-size: 120%"></i>
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

