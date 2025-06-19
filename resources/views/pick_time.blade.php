
@extends('layout')

@section('content')
    <div class="container d-flex flex-column justify-content-center my-5">
        <h2 class="mb-4 text-center">Календарь свободных записей для барбера: {{ $barber->name }}</h2>
        <div id="calendar" class="mx-auto" style="max-width: 900px; min-width: 600px;"></div>
        <div id="visit-times-container" class="mt-4"></div>
    </div>
@endsection

<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.17/index.global.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/web-component@6.1.17/index.global.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.17/index.global.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('calendar');
        const visitContainer = document.getElementById('visit-times-container');

        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'ru',
            events: '/barber/{{ $barber->id }}/visits_dates',
            eventColor: '#198754',
            eventDisplay: 'background',

            dateClick: function (info) {
                console.log('123');
                const date = info.dateStr;
                fetch(`/barber/{{ $barber->id }}/visit_times?date=${date}`)
                    .then(res => res.json())
                    .then(data => {
                        if (data.visits.length === 0) {
                            visitContainer.innerHTML = `<p class="text-muted">Свободных записей на ${date} нет.</p>`;
                        } else {
                            let buttons = renderVisitButtons(data.visits, date);

                            visitContainer.innerHTML = `
                                <div class="d-flex flex-wrap">${buttons}</div>
                            `;
                        }
                    });
            }
        });
        calendar.render();
    });


    function renderVisitButtons(visits, date) {
        const csrfToken = '{{ csrf_token() }}';
        let buttons = visits.map(v => `
                <form method="post" action="/booking/time" class="d-block mb-2">
                    <input type="hidden" name="_token" value="${csrfToken}">
                    <button type="submit" name="visit_id" value="${v.id}" class="btn btn-outline-primary w-100 py-3 fs-5">${v.time}</button>
                </form>
            `).join('');

        return `
                <div class="card mx-auto" style="max-width: 500px;">
                    <div class="card-body">
                        <h5 class="card-title text-center mb-3">Свободные записи на ${date}</h5>
                        ${buttons}
                    </div>
                </div>
            `;
    }

</script>
