import {
    getFichaAll
} from '/public/js/generales/jsGeneral.js';

var monthNames = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];
var myChart;


const labelsConfigLine = {
    align: 'start',
    anchor: 'start',
    backgroundColor: function (context) {
        return context.dataset.backgroundColor;
    },
    borderRadius: 4,
}

const labelsConfigBarPieDough = {
    align: 'center',
    anchor: 'center',
    backgroundColor: 'black',
    borderColor: 'white',
    borderRadius: 25,
    borderWidth: 2,
}

let config = {
    data: {
        datasets: [{
            data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1],
            datalabels: {
                display: function (context) {
                    return context.dataset.data[context.dataIndex] !== 0; // or >= 1 or ...
                },
                color: 'white',
                font: {
                    weight: 'bold'
                },
                formatter: Math.round,
                padding: 6
            },
        }],
    },
    options: {
        plugins: {
            title: {
                display: true,
                text: $('#title').val() || ''
            },
            subtitle: {
                display: true,
                text: $('#subtitle').val() || '',
                padding: {
                    bottom: 10
                }
            },
            legend: {
                display: false
            }
        },
        scales: {
            x: {
                display: true
            },
            y: {
                display: true
            }
        }
    }
}

document.addEventListener('DOMContentLoaded', async function () {

    //const allPedidos = await getFichaAll('/pedidos/');

    Chart.register(ChartDataLabels);

    $('#title').on('keyup', function () {
        config.options.plugins.title.text = $(this).val();
        if (typeof myChart !== "undefined") {
            myChart.update();
        }
    })
    $('#subtitle').on('keyup', function () {
        config.options.plugins.subtitle.text = $(this).val();
        if (typeof myChart !== "undefined") {
            myChart.update();
        }
    })

    $('#chartType').on('change', function () {
        config.type = $('#chartType').val();
        if (config.type != 'bar' && config.type != 'line') {
            config.options.plugins.legend = true;
            config.options.scales.x.display = false;
            config.options.scales.y.display = false;
        } else {
            config.options.plugins.legend = false
            config.options.scales.x.display = true;
            config.options.scales.y.display = true;
        }
        if (config.type == 'line') {
            config.options.plugins.datalabels = labelsConfigLine;
        } else {
            config.options.plugins.datalabels = labelsConfigBarPieDough;
        }
        if (typeof myChart !== "undefined") {
            myChart.destroy();
            myChart = new Chart($('#canvasSingle'), config);
        }
    })

    $('#btn-download').on('click', function () {
        var a = document.createElement('a');
        a.href = myChart.toBase64Image();
        let fileName = myChart.options.plugins.title.text ? myChart.options.plugins.title.text + (myChart.options.plugins.subtitle.text ? '-' + myChart.options.plugins.subtitle.text : '') : 'informe';
        a.download = `${fileName}.png`;
        // Trigger the download
        a.click();
    })

    $('#btn-print').on('click', function () {
        //popup.document.write(`<img src="${myChart.toBase64Image()}">`);
        var mywindow = window.open('', 'PRINT');
        let fileName = myChart.options.plugins.title.text ? myChart.options.plugins.title.text + (myChart.options.plugins.subtitle.text ? '-' + myChart.options.plugins.subtitle.text : '') : 'informe';
        mywindow.document.write('<html><head><title>' + fileName + '</title>');
        mywindow.document.write('</head><body style="text-align: center;">');
        mywindow.document.write('<h1>' + fileName + '</h1>');
        mywindow.document.write(`<img src="${myChart.toBase64Image()}" style="max-width:800px">`);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10*/

        mywindow.print();
        //mywindow.close();
        return true;
    })

    $('#dataset').on('change', function () {
        switch ($(this).val()) {
            case 'especializacion':
                $('#subdataset').html(`
                    <option disabled selected>Seleccione una opcion</option>
                    <option value="esp-1">Especializaciones más solicitados</option>
                `)
                break;
            case 'oc':
                $('#subdataset').html(`
                    <option disabled selected>Seleccione una opcion</option>
                    <option>Ordenes de Compra creadas</option>
                `)
                break;
            case 'ot':
                $('#subdataset').html(`
                    <option disabled selected>Seleccione una opcion</option>
                    <option>Ordenes de Trabajo creadas</option>
                `)
                break;
            case 'pedido':
                $('#subdataset').html(`
                    <option disabled selected>Seleccione una opcion</option>
                    <option value="ped-1">Pedidos creados</option>
                `)
                break;
            case 'sector':
                $('#subdataset').html(`
                    <option disabled selected>Seleccione una opcion</option>
                    <option>Sectores con más pedidos</option>
                `)
                break;

            default:
                break;
        }
    })

    $('form').on('submit', function (e) {
        e.preventDefault();
        $.post($(this).attr('action'), $(this).serializeArray())
            .done(datos => {
                datos = JSON.parse(datos)
                switch ($('#subdataset').val()) {
                    case 'esp-1':
                        console.log('espec')
                        break;
                    case "ped-1":
                        config = loadPedidos(datos, $('#fechaInicio').val(), $('#fechaFin').val());
                        break;
                    default:
                        break;
                }
                if (typeof myChart !== "undefined") {
                    myChart.destroy();
                }
                myChart = new Chart($('#canvasSingle'), config);
                $('#container-canvas').removeClass('hide');
            })
    })
});

function loadPedidos(datos, start, end) {
    const diferenciaDias = diffDates(start, end);
    let labelsMonths = [];
    let labelsDaysMonth = [];
    var today = new Date();
    var d;
    var month;
    var year;
    for (var i = 11; i >= 0; i -= 1) {
        d = new Date(today.getFullYear(), today.getMonth() - i, 1);
        month = monthNames[d.getMonth()];
        year = d.getFullYear();
        labelsMonths.push(`${month}/${year.toString().slice(2)}`);
    }
    let countPedidosPerMonth = new Array(12).fill(0);
    datos.forEach(pedido => {
        let fechaInicioPedido = new Date(pedido.fechaInicio.split(' ')[0].split('/').reverse().join(','))
        countPedidosPerMonth[fechaInicioPedido.getMonth() + 4] += 1;
    });
    config.data.labels = labelsMonths;
    config.data.datasets[0].backgroundColor = countPedidosPerMonth.map(() => tinycolor.random().toHexString())
    config.data.datasets[0].data = countPedidosPerMonth;
    return config;
}

function diffDates(start, end) {
    const date1 = new Date(start);
    const date2 = new Date(end);
    const diffTime = Math.abs(date2 - date1);
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
    return diffDays;
}