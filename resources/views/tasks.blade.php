
@extends('layouts.app')


@section('content')

    <!-- Bootstrap Boilerplate... -->
<div class ="container">
    <div class="panel-body">
        <!-- Display Validation Errors -->
    <!-- Komischer Code - gelöscht -->

    <!-- New Task Form -->
        <form action="/grocerylist/task" method="POST" class="form-horizontal">
        {{ csrf_field() }}

        <!-- Task Name -->
            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">Neuer Artikel</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="task-name" class="form-control">
                    <input type="text" name="name2" id="task-name2" class="form-control">
                </div>
            </div>

            <!-- Add Task Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Artikel hinzufügen
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Current Tasks -->
    @if (count($tasks) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Einkaufsliste
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                    <th>Artikel</th>
                    <th>&nbsp;</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <!-- Task Name -->
                            <td class="table-text">
                                <div>{{ $task->name }}</div>
                            </td>
                            <td class="table-text">
                                <div>{{ $task->name2 }}</div>
                            </td>



                            <!-- Delete Button -->
                            <td>
                                <form action="/grocerylist/task/{{ $task->id }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button>Löschen</button>
                                </form>
                            </td>
                        </tr>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection
