export default function loadEspecialidades(config, datos) {
    let dataJson = [];
    datos.forEach(pedido => {
        pedido.tareas.forEach(tarea => {
            let indexEspecializacion = dataJson.findIndex(especializacion => especializacion.nombre == tarea.especializacionNombre)
            if (indexEspecializacion == -1) {
                dataJson.push({
                    label: tarea.especializacionNombre,
                    color: tinycolor.random().toHexString(),
                    count: 1
                });
            } else {
                dataJson[indexEspecializacion].count += 1;
            }
        })
    })
    config.data.labels = dataJson.map(element => element.label);
    config.data.datasets[0].backgroundColor = dataJson.map(element => element.color)
    config.data.datasets[0].data = dataJson.map(element => element.count);
    return config;
}