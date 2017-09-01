<table class="table table-hover" id="tblEvents">
    <thead>
    <tr>
        @foreach($columnNames as $columnName)
            <th>{{ $columnName }}</th>
        @endforeach
        <th>Actions</th>
    </tr>
    </thead>
    <tbody id="tableBody">
    @foreach($events as $event)
        <tr id="{{ $event->id }}">
            @foreach($columnNames as $columnName)
                    <td>{{ $event->$columnName }}</td>
            @endforeach
            <td class="text-nowrap">
                <button type="button" class="btn btn-primary edit" data-toggle="modal" data-target="#add" id="update{{ $event->id }}">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"> Update</i>
                </button>
                <button type="button" class="btn btn-danger delete" data-toggle="modal" data-target="#delete" id="delete{{ $event->id }}">
                    <i class="fa fa-trash-o" aria-hidden="true"> Delete</i>
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

