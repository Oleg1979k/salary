@extends('layout.app')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Список сотрудников организации</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('employee.create') }}"> Добавить нового сотрудника</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>ФИО</th>
            <th>Возраст</th>
            <th>Количество детей</th>
            <th>Наличие автомобиля</th>
            <th>Оклад</th>
            <th>Зарплата</th>
        </tr>
        @foreach ($employees as $employee)
            <tr>
                <td>{{ $employee->fio }}</td>
                <td>{{ $employee->age }}</td>
                <td>{{ $employee->count_child }}</td>
                <td>{{ $employee->car }}</td>
                <td>{{ $employee->salary }}</td>
                <td>{{ $employee->to_receive }}</td>
            </tr>
        @endforeach
    </table>

@endsection

