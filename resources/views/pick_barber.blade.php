@extends('layout')
@section('content')
    <div class="container d-flex flex-column">
        <form method="post" action="{{ url('booking/barber') }}" class="col d-flex flex-column">
            @csrf
            <h2>Выберите барбера</h2>
            <table class="table table-hover table-bordered rounded shadow-sm overflow-hidden align-middle">
                <thead class="table-light">
                <tr class="text-center">
                    <th>Имя</th>
                    <th>Фамилия</th>
                    <th>Телефон</th>
                    <th>Стаж</th>
                    <th>Выбрать</th>
                </tr>
                </thead>
                <tbody>
                @foreach($barbers as $barber)
                    @php $nearestVisits = $barber->nearestVisits(); @endphp

                    <tr class="text-center fw-medium">
                        <td>{{ $barber->name }}</td>
                        <td>{{ $barber->last_name }}</td>
                        <td>{{ $barber->phone_number }}</td>
                        <td>{{ now()->diff($barber->start_work_at)->format('%y лет, %m мес') }}</td>
                        <td>
                            <input class="form-check-input mt-0" type="radio" name="barber_id" value="{{ $barber->id }}" required>
                        </td>
                    </tr>

                    <tr class="bg-light">
                        <td colspan="5">
                            @if($nearestVisits->isEmpty())
                                <div class="text-center text-muted py-2">Нет ближайших записей</div>
                            @else
                                <div class="mb-2 fw-semibold">
                                    Ближайшие записи на {{ $nearestVisits->first()->start_at->translatedFormat('d F Y') }}:
                                </div>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($nearestVisits as $visit)
                                        <button type="submit" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                            {{ $visit->start_at->format('H:i') }}
                                        </button>
                                    @endforeach
                                </div>
                            @endif
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>


            <button class="btn btn-primary d-block mx-auto my-3">
                Выбрать услугу
            </button>


        </form>
    </div>
@endsection

