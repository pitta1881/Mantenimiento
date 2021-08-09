export default function loadSectores(config, datos) {
    let dataJson = [];
    datos.forEach(pedido => {
        let indexSector = dataJson.findIndex(sector => sector.nombre == pedido.sectorNombre)
        if (indexSector == -1) {
            dataJson.push({
                label: pedido.sectorNombre,
                color: tinycolor.random().toHexString(),
                count: 1
            });
        } else {
            dataJson[indexSector].count += 1;
        }
    })
    config.data.labels = dataJson.map(element => element.label);
    config.data.datasets[0].backgroundColor = dataJson.map(element => element.color)
    config.data.datasets[0].data = dataJson.map(element => element.count);
    return config;
}