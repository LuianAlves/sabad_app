<div id='calendar'></div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
            initialView: 'dayGridMonth',
            selectable: true,
            events: "{{ route('bookings.events') }}",
            select: function(info) {
                // Abrir modal com form de agendamento
            },
            eventClick: function(info) {
                // Mostrar detalhes ou abrir edição
            }
        });
        calendar.render();
    });
</script>
