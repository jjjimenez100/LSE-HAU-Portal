@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Manage Users</h4></div>

                    <div class="panel-body">
                        <div class="table-responsive">
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
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection