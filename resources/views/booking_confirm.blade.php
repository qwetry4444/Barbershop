@extends('layout')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 70vh;">
        <div class="card shadow p-4" style="max-width: 500px; width: 100%;">
            <h3 class="text-center mb-4">Подтверждение записи</h3>

            <p><strong>Барбер:</strong> {{ $barber->name }} {{ $barber->last_name }}</p>
            <p><strong>Услуга:</strong> {{ $service->name }} ({{ $service->type }})</p>
            <p><strong>Дата и время:</strong> {{ $visit->start_at->format('d.m.Y H:i') }}</p>
            <p><strong>Цена:</strong> {{ $service->price }} ₽</p>

            <form method="post" action="{{ url('/booking/confirm') }}"  class="mt-4">
                @csrf
                <div class="d-flex justify-content-between">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Назад</a>
                    <button type="submit" class="btn btn-success">Подтвердить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
