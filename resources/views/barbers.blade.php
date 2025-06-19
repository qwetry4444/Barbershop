
@extends('layout')
@section('content')
    <div class="container d-flex flex-column justify-content-center">
        <form method="post" action="" class="col d-flex flex-column justify-content-center ">
            <h2 class="mb-4">Список барберов</h2>
            <table class="table table-bordered table-hover align-middle">
                <thead>
                    <th scope="col">Имя</th>
                    <th scope="col">Фамилия</th>
                    <th scope="col">Номер телефона</th>
                    <th scope="col">Стаж</th>
                </thead>
                <tbody>
                @foreach($barbers as $barber)
                    @php
                        $nearestVisits = $barber->nearestVisits();
                    @endphp
                    <tr>
                        <td>{{$barber->name}}</td>
                        <td>{{$barber->last_name}}</td>
                        <td>{{$barber->phone_number}}</td>
                        <td>{{now()->diff($barber->start_work_at)->format('%y лет, %m мес')}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $barbers->links() }}
        </form>
    </div>
@endsection
