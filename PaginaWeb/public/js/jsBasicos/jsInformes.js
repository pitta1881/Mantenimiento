import loadPedidos from '/public/js/jsBasicos/subinformes/pedidos.js';
import loadEspecialidades from '/public/js/jsBasicos/subinformes/especialidades.js';
import loadSectores from '/public/js/jsBasicos/subinformes/sectores.js';
import loadOrdenesDeTrabajo from '/public/js/jsBasicos/subinformes/ordenesdetrabajo.js';
import loadOrdenesDeCompra from '/public/js/jsBasicos/subinformes/ordenesdecompra.js';

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
                    <option disabled>Seleccione una opcion</option>
                    <option value="esp-1">Especializaciones más solicitadas</option>
                `)
                break;
            case 'oc':
                $('#subdataset').html(`
                    <option disabled>Seleccione una opcion</option>
                    <option value="oc-1">Ordenes de Compra creadas</option>
                `)
                break;
            case 'ot':
                $('#subdataset').html(`
                    <option disabled>Seleccione una opcion</option>
                    <option value="ot-1">Ordenes de Trabajo creadas</option>
                `)
                break;
            case 'pedido':
                $('#subdataset').html(`
                    <option disabled>Seleccione una opcion</option>
                    <option value="ped-1">Pedidos creados</option>
                `)
                break;
            case 'sector':
                $('#subdataset').html(`
                    <option disabled>Seleccione una opcion</option>
                    <option value="sec-1">Sectores con más pedidos</option>
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
                let startDateArray = $('#fechaInicio').val().split('-')
                let endDateArray = $('#fechaFin').val().split('-')
                let startAsDate = new Date(startDateArray[0], startDateArray[1] - 1, startDateArray[2], 0, 0, 0, 0)
                let vista = $('#vista').val();
                switch ($('#subdataset').val()) {
                    case 'esp-1':
                        config = loadEspecialidades(config, datos);
                        break;
                    case 'sec-1':
                        config = loadSectores(config, datos);
                        break;
                    case 'ot-1':
                        config = loadOrdenesDeTrabajo(config, datos, startAsDate, endDateArray, vista);
                        break;
                    case 'oc-1':
                        config = loadOrdenesDeCompra(config, datos, startAsDate, endDateArray, vista);
                        break;
                    case "ped-1":
                        config = loadPedidos(config, datos, startAsDate, endDateArray, vista);
                        break;
                    default:
                        break;
                }
                if (typeof myChart !== "undefined") {
                    myChart.destroy();
                }
                $('#title').val($('#dataset option:selected').text());
                $('#subtitle').val($('#subdataset option:selected').text());
                config.options.plugins.title.text = $('#dataset option:selected').text();
                config.options.plugins.subtitle.text = $('#subdataset option:selected').text();
                myChart = new Chart($('#canvasSingle'), config);
                $('#canvas-footer').removeClass('hide');
            })
    })
});