var monthNames = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];

export default function loadPedidos(config, datos, start, end, vista) {
    let dataJson;
    let endAsDate;
    if (vista == 'dia') {
        endAsDate = new Date(end[0], end[1] - 1, end[2], 0, 0, 0, 0);
        dataJson = loadPedidosDia(datos, start, endAsDate);
    } else if (vista == 'mes') {
        endAsDate = new Date(end[0], end[1] - 1, 31, 0, 0, 0, 0);
        dataJson = loadPedidosMes(datos, start, endAsDate);
    } else {
        endAsDate = new Date(end[0], end[1] - 1, 31, 0, 0, 0, 0);
        dataJson = loadPedidosAnio(datos, start, endAsDate);
    }
    config.data.labels = dataJson.map(element => element.label);
    config.data.datasets[0].backgroundColor = dataJson.map(element => element.color)
    config.data.datasets[0].data = dataJson.map(element => element.count);
    return config;
}

function loadPedidosDia(datos, start, end) {
    let labelsDays = [];
    let day;
    let month;
    let year;
    let dDays = start;
    do {
        day = dDays.getDate();
        month = monthNames[dDays.getMonth()];
        year = dDays.getFullYear().toString().slice(2);
        labelsDays.push({
            date: dDays.toISOString().split('T')[0],
            label: `${day}/${month}/${year}`,
            color: tinycolor.random().toHexString(),
            count: 0
        });
        dDays = new Date(dDays.setDate(dDays.getDate() + +1));
    } while (dDays.getTime() <= end.getTime());
    datos.forEach(item => {
        let fechaInicioModif = item.fechaInicio.split(' ')[0].split('/').reverse().join('-');
        let indexLabel = labelsDays.findIndex(element => element.date == fechaInicioModif);
        labelsDays[indexLabel].count += 1;
    });
    return labelsDays;
}

function loadPedidosMes(datos, start, end) {
    let labelsMonths = [];
    let month;
    let year;
    let dMonths = start;
    do {
        month = monthNames[dMonths.getMonth()];
        year = dMonths.getFullYear().toString().slice(2);
        labelsMonths.push({
            date: dMonths.toISOString().split('T')[0].slice(0, -2) + '01',
            label: `${month}/${year}`,
            color: tinycolor.random().toHexString(),
            count: 0
        });
        dMonths = new Date(dMonths.setMonth(dMonths.getMonth() + 1));
    } while (dMonths.getTime() <= end.getTime());
    datos.forEach(item => {
        let fechaInicioModif = item.fechaInicio.split(' ')[0].split('/').reverse().join('-').slice(0, -2) + '01';
        let indexLabel = labelsMonths.findIndex(element => element.date == fechaInicioModif);
        labelsMonths[indexLabel].count += 1;
    });
    return labelsMonths;
}

function loadPedidosAnio(datos, start, end) {
    let labelsYears = [];
    let year;
    let dYear = start;
    do {
        year = dYear.getFullYear();
        labelsYears.push({
            date: dYear.toISOString().split('T')[0].slice(0, -5) + '01-01',
            label: `${year}`,
            color: tinycolor.random().toHexString(),
            count: 0
        });
        dYear = new Date(dYear.setFullYear(dYear.getFullYear() + 1));
    } while (dYear.getTime() <= end.getTime());
    datos.forEach(item => {
        let fechaInicioModif = item.fechaInicio.split(' ')[0].split('/').reverse().join('-').slice(0, -5) + '01-01';
        let indexLabel = labelsYears.findIndex(element => element.date == fechaInicioModif);
        labelsYears[indexLabel].count += 1;
    });
    return labelsYears;
}