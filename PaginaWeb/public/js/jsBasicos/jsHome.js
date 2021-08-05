import {
    getFichaAll
} from '/public/js/generales/jsGeneral.js';

document.addEventListener('DOMContentLoaded', function () {
    loadBoxes();
    loadCharts();
    loadCalendar();
});

async function loadBoxes() {
    const boxes = await $.get('/home/boxes')
        .done(function (data) {
            data = JSON.parse(data);
            $('#box-pedidos').text(data.countPedidosActivos)
            $('#box-tareas').text(data.countTareasSinAsignar)
            $('#box-ot').text(data.countOTActivos)
            $('#box-eventos').text(data.countEventosHoy)
        })

}

async function loadCharts() {

    let dateSixMonthBefore = new Date();
    dateSixMonthBefore.setMonth(dateSixMonthBefore.getMonth() - 6);
    dateSixMonthBefore.setDate(1);
    const startDate = dateSixMonthBefore.toISOString().split('T')[0];
    const [allOT, allPedidos, allOC] = await Promise.allSettled([getFichaAll('/ordendetrabajo/', startDate), getFichaAll('/pedidos/', startDate), getFichaAll('/ordendecompra/', startDate)]);

    //labels 6 meses anteriores incluido este
    const labelsMonths = [];
    var monthNames = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];
    var today = new Date();
    var d;
    var month;
    var year;
    for (var i = 5; i >= 0; i -= 1) {
        d = new Date(today.getFullYear(), today.getMonth() - i, 1);
        month = monthNames[d.getMonth()];
        year = d.getFullYear();
        labelsMonths.push(`${month}/${year.toString().slice(2)}`);
    }

    let countOTPerMonth = new Array(12).fill(0);
    let countOCPerMonth = new Array(12).fill(0);
    let countPedidosPerMonth = new Array(12).fill(0);
    let arrayEspecializaciones = [];
    let arraySectores = [];
    let indiceCount = dateSixMonthBefore.getMonth() + 1;

    //count ots ultimos 6 meses
    allOT.value.forEach(ot => {
        let fechaInicioOT = new Date(ot.fechaInicio.split(' ')[0].split('/').reverse().join(','))
        countOTPerMonth[fechaInicioOT.getMonth()] += 1;
    });
    if (indiceCount < 6) {
        countOTPerMonth = (countOTPerMonth.slice(indiceCount, today.getMonth() + 1));
    } else {
        countOTPerMonth = (countOTPerMonth.slice(indiceCount).concat(countOTPerMonth.slice(0, indiceCount - 6)));
    }

    //count ocs ultimos 6 meses
    allOC.value.forEach(oc => {
        let fechaInicioOC = new Date(oc.fechaInicio.split(' ')[0].split('/').reverse().join(','))
        countOCPerMonth[fechaInicioOC.getMonth()] += 1;
    });
    if (indiceCount < 6) {
        countOCPerMonth = (countOCPerMonth.slice(indiceCount, today.getMonth() + 1));
    } else {
        countOCPerMonth = (countOCPerMonth.slice(indiceCount).concat(countOCPerMonth.slice(0, indiceCount - 6)));
    }

    //count pedidos ultimos 6 meses
    allPedidos.value.forEach(pedido => {
        let fechaInicioPedido = new Date(pedido.fechaInicio.split(' ')[0].split('/').reverse().join(','))
        countPedidosPerMonth[fechaInicioPedido.getMonth()] += 1;
        let indexSector = arraySectores.findIndex(sector => sector.nombre == pedido.sectorNombre)
        if (indexSector == -1) {
            arraySectores.push({
                nombre: pedido.sectorNombre,
                cuenta: 1
            });
        } else {
            arraySectores[indexSector].cuenta = arraySectores[indexSector].cuenta + 1;
        }
        pedido.tareas.forEach(tarea => {
            let indexEspecializacion = arrayEspecializaciones.findIndex(especializacion => especializacion.nombre == tarea.especializacionNombre)
            if (indexEspecializacion == -1) {
                arrayEspecializaciones.push({
                    nombre: tarea.especializacionNombre,
                    cuenta: 1
                });
            } else {
                arrayEspecializaciones[indexEspecializacion].cuenta = arrayEspecializaciones[indexEspecializacion].cuenta + 1;
            }
        })
    });
    if (indiceCount < 6) {
        countPedidosPerMonth = (countPedidosPerMonth.slice(indiceCount, today.getMonth() + 1));
    } else {
        countPedidosPerMonth = (countPedidosPerMonth.slice(indiceCount).concat(countPedidosPerMonth.slice(0, indiceCount - 6)));
    }

    var myChart = new Chart(
        $('#chartOT'), {
            data: {
                labels: labelsMonths,
                datasets: [{
                    backgroundColor: countOTPerMonth.map(() => tinycolor.random().toHexString()),
                    data: countOTPerMonth,
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Ordenes de Trabajo'
                    },
                    subtitle: {
                        display: true,
                        text: 'OTs Creadas últimos 6 meses'
                    },
                    legend: {
                        display: false
                    }
                }
            },
            type: 'line'
        }
    );

    var myChart2 = new Chart(
        $('#chartPedidos'), {
            data: {
                labels: labelsMonths,
                datasets: [{
                    backgroundColor: countPedidosPerMonth.map(() => tinycolor.random().toHexString()),
                    data: countPedidosPerMonth,
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Pedidos'
                    },
                    subtitle: {
                        display: true,
                        text: 'Pedidos Creados últimos 6 meses'
                    },
                    legend: {
                        display: false
                    }
                }
            },
            type: 'line'
        }
    );
    var myChart3 = new Chart(
        $('#chartEspecialidades'), {
            data: {
                labels: arrayEspecializaciones.map(especializacion => especializacion.nombre),
                datasets: [{
                    backgroundColor: arrayEspecializaciones.map(() => tinycolor.random().toHexString()),
                    data: arrayEspecializaciones.map(especializacion => especializacion.cuenta),
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Especialidades'
                    },
                    subtitle: {
                        display: true,
                        text: 'Especialidades mas solicitadas últimos 6 meses'
                    }
                }
            },
            type: 'doughnut'
        }
    );
    var myChart4 = new Chart(
        $('#chartSectores'), {
            data: {
                labels: arraySectores.map(sector => sector.nombre),
                datasets: [{
                    backgroundColor: arraySectores.map(() => tinycolor.random().toHexString()),
                    data: arraySectores.map(sector => sector.cuenta),
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Sectores'
                    },
                    subtitle: {
                        display: true,
                        text: 'Sectores con más pedidos últimos 6 meses'
                    }
                }
            },
            type: 'pie'
        }
    );
}

async function loadCalendar() {
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
}