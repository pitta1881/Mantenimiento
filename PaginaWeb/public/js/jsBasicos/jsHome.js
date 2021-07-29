const labels = [
    'Enero',
    'Febrero',
    'Marzo',
    'Abril',
    'Mayo',
    'Junio',
];
const data = {
    labels: labels,
    datasets: [{
        label: 'My First dataset',
        backgroundColor: [
            'rgba(255, 99, 132,0.8)',
            'rgba(75, 192, 192,0.8)',
            'rgba(255, 205, 86,0.8)',
            'rgba(201, 203, 207,0.8)',
            'rgba(54, 162, 235,0.8)',
            'rgba(154, 62, 35,0.8)'
        ],
        data: [0, 10, 5, 2, 20, 30],
    }]
};

const config = {
    data,
    options: {
        plugins: {
            title: {
                display: true,
                text: 'Custom Chart Title'
            },
            subtitle: {
                display: true,
                text: 'Custom Chart Subtitle'
            }
        }
    }
};

var myChart = new Chart(
    $('#chartOT'), {
        ...config,
        type: 'line'
    }
);
var myChart2 = new Chart(
    $('#chartPedidos'), {
        ...config,
        type: 'bar'
    }
);
var myChart3 = new Chart(
    $('#chartTareas'), {
        ...config,
        type: 'pie'
    }
);
var myChart4 = new Chart(
    $('#chartOC'), {
        ...config,
        type: 'doughnut'
    }
);

document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        themeSystem: 'bootstrap',
        height: 'auto',
        defaultAllDay: true,
        eventColor: 'red',
        eventDidMount: function (info) {
            var tooltip = new Tooltip(info.el, {
                html: true,
                title: `${info.event.extendedProps.title}<br>
                        ${info.event.extendedProps.description}`,
                placement: 'top',
                trigger: 'hover',
                container: 'body'
            });
            console.log(tooltip)
        },
        events: [{ // this object will be "parsed" into an Event Object
            title: 'Cambiar Focos pabellon 3', // a property!
            description: 'description for Birthday Party',
            start: '2021-07-25', // a property!
        }, { // this object will be "parsed" into an Event Object
            title: 'Revisar estufas', // a property!
            description: 'description for Birthday Party',
            start: '2021-07-25', // a property!
        }, { // this object will be "parsed" into an Event Object
            title: 'Cambiar Focos pabellon 3', // a property!
            description: 'description for Birthday Party',
            start: '2021-07-28', // a property!
        }]
    });
    calendar.render();
});