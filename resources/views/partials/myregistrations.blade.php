<table class="table table-hover" id="tblRegistrations">
    <thead>
    <tr>
        @foreach($columnNames as $columnName)
            @if($loop->index == 0 || $loop->index == 1 || $loop->index == 2 || $loop->index == 4  || $loop->index == 6|| $loop->index == 7)
                @continue
            @else
                <th>{{ $columnName }}</th>
            @endif
        @endforeach
        <th class="text-center">Actions</th>
    </tr>
    </thead>
    <tbody id="tableBody">
        @foreach($registrations as $registration)
            <tr>
                @foreach($columnNames as $columnName)
                    @if($loop->index == 0 || $loop->index == 1 || $loop->index == 2 || $loop->index == 4 || $loop->index == 6 || $loop->index == 7)
                        @continue
                    @else
                        <td>{{ $registration->event->$columnName }}</td>
                    @endif
                @endforeach
                <td><button class="btn btn-danger center-block cancel"  id="{{ $registration->id }}"><i class="fa fa-ban" aria-hidden="true"></i> Cancel</button></td>
            </tr>
        @endforeach
    </tbody>
</table>

