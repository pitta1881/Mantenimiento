import {
    getFichaAll
} from '/public/js/generales/jsGeneral.js';

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

document.addEventListener('DOMContentLoaded', async function () {
    const allEventos = await getFichaAll('/eventos/');
    const arrayEventos = allEventos.flatMap(evento => {
        let randomColor = tinycolor.random().toHexString();
        let fecha = evento.fechaInicio.split(' ')[0].split('/').reverse().join('-');
        let retorno = [];
        const repeatMany = evento.periodicidad < 4 ? 20 : 10;
        for (let index = 0; index < repeatMany; index++) {
            fecha = new Date(fecha);
            fecha = new Date(fecha.setDate(fecha.getDate() + (index == 0 ? 0 : Number(evento.periodicidad)))).toISOString().split('T')[0];
            retorno.push({
                id: evento.id,
                title: `Evnt. Nº ${evento.id}`,
                subtitle: evento.nombre,
                description: evento.descripcion,
                start: fecha,
                url: `/eventos?id=${evento.id}`,
                backgroundColor: randomColor,
                borderColor: tinycolor(randomColor).brighten(50).toHexString(),
                textColor: tinycolor.mostReadable(randomColor, ["black", "grey", "white"]).toHexString()
            });
        }
        return retorno
    })
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        themeSystem: 'bootstrap',
        height: 'auto',
        defaultAllDay: true,
        eventDidMount: function (info) {
            var tooltip = new Tooltip(info.el, {
                html: true,
                title: `<strong>Titulo</strong>: ${info.event.extendedProps.subtitle}<br>
                        <strong>Descripcion</strong>: ${info.event.extendedProps.description}`,
                placement: 'left',
                trigger: 'hover',
                container: 'body'
            });
        },
        events: arrayEventos
    });
    calendar.render();
});