export default async function validarForm(callbackGetFichaAll, callbackAfterReloadTable) {
    let datos = await callbackGetFichaAll();
    let arrayRepetidosOld = [];
    if (datos) {
        datos.forEach(element => {
            arrayRepetidosOld.push(element['nombre']);
        });
    }

    //usuarios forms
    $('#formUsuarioNew, #formUsuarioUpd').bootstrapValidator({
            excluded: [':disabled'],
            fields: {
                nick: {
                    validators: {
                        stringLength: {
                            min: 5,
                            max: 30,
                            message: 'Minimo 5 caracteres y Maximo 30<br>'
                        },
                        notEmpty: {
                            message: 'Ingrese un Nick'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9_]+$/,
                            message: 'Solo acepta Alfanumerico y Guion Bajo'
                        },
                        callback: {
                            callback: function (value, validator, $field) {
                                if (arrayRepetidosOld.includes(value)) {
                                    return {
                                        valid: false,
                                        message: 'El nick ya existe'
                                    }
                                }
                                return {
                                    valid: true
                                }
                            }
                        }
                    }
                },
                idPersona: {
                    validators: {
                        notEmpty: {
                            message: 'Seleccione una Persona'
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'Ingrese una Contraseña'
                        }
                    }
                },
                passwordConfirm: {
                    validators: {
                        notEmpty: {
                            message: 'Repita la Contraseña'
                        },
                        identical: {
                            field: 'password',
                            message: 'Las Contraseñas no coinciden'
                        }
                    }
                },
                'idRol[]': {
                    validators: {
                        notEmpty: {
                            message: 'Seleccione uno o varios Roles'
                        }
                    }
                }
            }
        })
        .on('success.field.bv', function (e, data) {
            data.element.removeClass('is-invalid');
            data.element.addClass('is-valid');
        })
        .on('error.field.bv', function (e, data) {
            data.element.removeClass('is-valid');
            data.element.addClass('is-invalid');
        })
        .on('success.form.bv', function (e) {
            reloadTable(e, this);
        });


    //personas forms
    $('#formPersonaNew, #formPersonaUpd, #formPersonaEstadoUpd').bootstrapValidator({
            excluded: [':disabled'],
            fields: {
                id: {
                    validators: {
                        stringLength: {
                            min: 8,
                            max: 10,
                            message: 'Formato Inválido<br>'
                        },
                        notEmpty: {
                            message: 'Ingrese el DNI'
                        },
                        regexp: {
                            regexp: /^[0-9]+$/,
                            message: 'Solo acepta Numeros, sin Puntos'
                        },
                        callback: {
                            callback: function (value, validator, $field) {
                                if ($field.prop("defaultValue") != value && arrayRepetidosOld.includes(value)) {
                                    return {
                                        valid: false,
                                        message: 'La Persona ya existe'
                                    }
                                }
                                return {
                                    valid: true
                                }
                            }
                        }
                    }
                },
                nombre: {
                    validators: {
                        notEmpty: {
                            message: 'Ingrese un Nombre'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z ]+$/,
                            message: 'Solo acepta Letras'
                        }
                    }
                },
                apellido: {
                    validators: {
                        notEmpty: {
                            message: 'Ingrese un Apellido'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z ]+$/,
                            message: 'Solo acepta Letras'
                        }
                    }
                },
                direccion: {
                    validators: {
                        stringLength: {
                            max: 50,
                            message: 'Máximo 50 caracteres<br>'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9º" ]+$/,
                            message: 'Caracter no permitido'
                        }
                    }
                },
                email: {
                    validators: {
                        emailAddress: {
                            message: 'Debe ingresar un Email válido'
                        }
                    }
                },
                fechaNacimiento: {
                    validators: {
                        notEmpty: {
                            message: 'Ingrese una Fecha'
                        }
                    }
                },
                idEstadoPersona: {
                    validators: {
                        notEmpty: {
                            message: 'Ingrese una Opcion'
                        }
                    }
                }
            }
        })
        .on('success.field.bv', function (e, data) {
            data.element.removeClass('is-invalid');
            data.element.addClass('is-valid');
        })
        .on('error.field.bv', function (e, data) {
            data.element.removeClass('is-valid');
            data.element.addClass('is-invalid');
        })
        .on('success.form.bv', function (e) {
            reloadTable(e, this);
        });

    //rol forms
    $('#formRolNew, #formRolUpd').bootstrapValidator({
            excluded: [':disabled', ':hidden', ':not(:visible)'],
            fields: {
                nombre: {
                    validators: {
                        notEmpty: {
                            message: 'Ingrese un Nombre'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z ]+$/,
                            message: 'Solo acepta Letras'
                        },
                        callback: {
                            callback: function (value, validator, $field) {
                                if (arrayRepetidosOld.includes(value)) {
                                    return {
                                        valid: false,
                                        message: 'El Rol ya existe'
                                    }
                                }
                                return {
                                    valid: true
                                }
                            }
                        }
                    }
                }
            }
        })
        .on('success.field.bv', function (e, data) {
            data.element.removeClass('is-invalid');
            data.element.addClass('is-valid');
        })
        .on('error.field.bv', function (e, data) {
            data.element.removeClass('is-valid');
            data.element.addClass('is-invalid');
        })
        .on('success.form.bv', function (e) {
            reloadTable(e, this);
        });

    //permisos forms
    $('#formPermisoNew, #formPermisoUpd').bootstrapValidator({
            excluded: [':disabled'],
            fields: {
                nombre: {
                    validators: {
                        notEmpty: {
                            message: 'Ingrese un Nombre'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z ]+$/,
                            message: 'Solo acepta Letras'
                        },
                        callback: {
                            callback: function (value, validator, $field) {
                                if (arrayRepetidosOld.includes(value)) {
                                    return {
                                        valid: false,
                                        message: 'El Permiso ya existe'
                                    }
                                }
                                return {
                                    valid: true
                                }
                            }
                        }
                    }
                }
            }
        })
        .on('success.field.bv', function (e, data) {
            data.element.removeClass('is-invalid');
            data.element.addClass('is-valid');
        })
        .on('error.field.bv', function (e, data) {
            data.element.removeClass('is-valid');
            data.element.addClass('is-invalid');
        })
        .on('success.form.bv', function (e) {
            reloadTable(e, this);
        });

    //agentes forms
    $('#formAgenteNew, #formAgenteUpd').bootstrapValidator({
            excluded: ':disabled',
            fields: {
                idPersona: {
                    validators: {
                        notEmpty: {
                            message: 'Seleccione una Persona'
                        }
                    }
                },
                'idEspecializacion[]': {
                    validators: {
                        notEmpty: {
                            message: 'Seleccione una o varias Especialidades'
                        }
                    }
                }
            }
        })
        .on('success.field.bv', function (e, data) {
            data.element.removeClass('is-invalid');
            data.element.addClass('is-valid');
        })
        .on('error.field.bv', function (e, data) {
            data.element.removeClass('is-valid');
            data.element.addClass('is-invalid');
        })
        .on('success.form.bv', function (e) {
            reloadTable(e, this);
        });

    //especializacion forms
    $('#formEspecializacionNew, #formEspecializacionUpd').bootstrapValidator({
            excluded: [':disabled'],
            fields: {
                nombre: {
                    validators: {
                        notEmpty: {
                            message: 'Ingrese un Nombre'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z ]+$/,
                            message: 'Solo acepta Letras'
                        },
                        callback: {
                            callback: function (value, validator, $field) {
                                if (arrayRepetidosOld.includes(value)) {
                                    return {
                                        valid: false,
                                        message: 'La Especializacion ya existe'
                                    }
                                }
                                return {
                                    valid: true
                                }
                            }
                        }
                    }
                }
            }
        })
        .on('success.field.bv', function (e, data) {
            data.element.removeClass('is-invalid');
            data.element.addClass('is-valid');
        })
        .on('error.field.bv', function (e, data) {
            data.element.removeClass('is-valid');
            data.element.addClass('is-invalid');
        })
        .on('success.form.bv', function (e) {
            reloadTable(e, this);
        });

    //sector forms
    $('#formSectorNew, #formSectorModificar').bootstrapValidator({
            excluded: [':disabled'],
            fields: {
                nombre: {
                    validators: {
                        notEmpty: {
                            message: 'Ingrese un Nombre'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z1-9 ]+$/,
                            message: 'Solo acepta Letras y Numeros'
                        },
                        callback: {
                            callback: function (value, validator, $field) {
                                if ($field.prop("defaultValue") != value && arrayRepetidosOld.includes(value)) {
                                    return {
                                        valid: false,
                                        message: 'El Sector ya existe'
                                    }
                                }
                                return {
                                    valid: true
                                }
                            }
                        }
                    }
                },
                responsable: {
                    validators: {
                        notEmpty: {
                            message: 'Ingrese un Nombre'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z ]+$/,
                            message: 'Solo acepta Letras'
                        }
                    }
                },
                idTipoSector: {
                    validators: {
                        notEmpty: {
                            message: 'Seleccione un Tipo'
                        }
                    }
                },
                email: {
                    validators: {
                        emailAddress: {
                            message: 'Debe ingresar un Email válido'
                        }
                    }
                },
                telefono: {
                    validators: {
                        digits: {
                            message: 'Solo puede contener números'
                        }
                    }
                }
            }
        })
        .on('success.field.bv', function (e, data) {
            data.element.removeClass('is-invalid');
            data.element.addClass('is-valid');
        })
        .on('error.field.bv', function (e, data) {
            data.element.removeClass('is-valid');
            data.element.addClass('is-invalid');
        })
        .on('success.form.bv', function (e) {
            reloadTable(e, this);
        });

    //pedidos forms
    $('#formPedidoNew, #formPedidoUpd, #formPedidoDel').bootstrapValidator({
            excluded: [':disabled'],
            fields: {
                idUsuario: {
                    excluded: true
                },
                fechaInicio: {
                    excluded: true
                },
                idEstado: {
                    excluded: true
                },
                idSector: {
                    validators: {
                        callback: {
                            callback: function (value, validator, $field) {
                                if (!value) {
                                    return {
                                        valid: false,
                                        message: 'Seleccione una opcion'
                                    }
                                }
                                return {
                                    valid: true
                                }
                            }
                        }
                    }
                },
                idPrioridad: {
                    validators: {
                        callback: {
                            callback: function (value, validator, $field) {
                                if (!value) {
                                    return {
                                        valid: false,
                                        message: 'Seleccione una opcion'
                                    }
                                }
                                return {
                                    valid: true
                                }
                            }
                        }
                    }
                },
                descripcion: {
                    validators: {
                        notEmpty: {
                            message: 'Ingrese una Descripcion'
                        }
                    }
                },
                observacion: {
                    validators: {
                        notEmpty: {
                            message: 'Ingrese una Observación'
                        }
                    }
                }
            }
        })
        .on('success.field.bv', function (e, data) {
            data.element.removeClass('is-invalid');
            data.element.addClass('is-valid');
        })
        .on('error.field.bv', function (e, data) {
            data.element.removeClass('is-valid');
            data.element.addClass('is-invalid');
        })
        .on('success.form.bv', function (e) {
            reloadTable(e, this);
        });

    //tareas forms
    $('#formTareaNew, #formTareaUpdate, #formTareaDel').bootstrapValidator({
            excluded: [':disabled'],
            fields: {
                idUsuario: {
                    excluded: true
                },
                fechaInicio: {
                    excluded: true
                },
                idEstado: {
                    excluded: true
                },
                idEspecializacion: {
                    validators: {
                        callback: {
                            callback: function (value, validator, $field) {
                                if (!value) {
                                    return {
                                        valid: false,
                                        message: 'Seleccione una opcion'
                                    }
                                }
                                return {
                                    valid: true
                                }
                            }
                        }
                    }
                },
                idPrioridad: {
                    validators: {
                        callback: {
                            callback: function (value, validator, $field) {
                                if (!value) {
                                    return {
                                        valid: false,
                                        message: 'Seleccione una opcion'
                                    }
                                }
                                return {
                                    valid: true
                                }
                            }
                        }
                    }
                },
                descripcion: {
                    validators: {
                        notEmpty: {
                            message: 'Ingrese una Descripcion'
                        }
                    }
                },
                observacion: {
                    validators: {
                        notEmpty: {
                            message: 'Ingrese una Observación'
                        }
                    }
                }
            }
        })
        .on('success.field.bv', function (e, data) {
            data.element.removeClass('is-invalid');
            data.element.addClass('is-valid');
        })
        .on('error.field.bv', function (e, data) {
            data.element.removeClass('is-valid');
            data.element.addClass('is-invalid');
        })
        .on('success.form.bv', function (e) {
            reloadTable(e, this);
        });

    //insumos forms
    $('#formInsumoNew, #formInsumoUpd').bootstrapValidator({
            excluded: [':disabled'],
            fields: {
                nombre: {
                    validators: {
                        notEmpty: {
                            message: 'Ingrese un Nombre'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z ]+$/,
                            message: 'Solo acepta Letras'
                        }
                    }
                },
                idMedida: {
                    validators: {
                        callback: {
                            callback: function (value, validator, $field) {
                                if (!value) {
                                    return {
                                        valid: false,
                                        message: 'Seleccione una opcion'
                                    }
                                }
                                return {
                                    valid: true
                                }
                            }
                        }
                    }
                },
                stock: {
                    validators: {
                        notEmpty: {
                            message: 'Ingrese Stock Actual'
                        },
                        greaterThan: {
                            value: 0,
                            inclusive: true,
                            message: 'Debe ser mayor o igual a 0'
                        }
                    }
                },
                stockMinimo: {
                    validators: {
                        notEmpty: {
                            message: 'Ingrese un stock min.'
                        },
                        greaterThan: {
                            value: 0,
                            inclusive: true,
                            message: 'Debe ser mayor o igual a 0'
                        }
                    }
                },
                descripcion: {
                    validators: {
                        notEmpty: {
                            message: 'Ingrese una Descripcion'
                        }
                    }
                }
            }
        })
        .on('success.field.bv', function (e, data) {
            data.element.removeClass('is-invalid');
            data.element.addClass('is-valid');
        })
        .on('error.field.bv', function (e, data) {
            data.element.removeClass('is-valid');
            data.element.addClass('is-invalid');
        })
        .on('success.form.bv', function (e) {
            reloadTable(e, this);
        });

    //orden de compra forms
    $('#formOCNew, #formOCUpd, #formCheckAndSetCosto, #formOCUpdInsumos, #formCancelInsumo, #formSetCostoFinal').bootstrapValidator({
            excluded: [':disabled'],
            fields: {
                idUsuario: {
                    excluded: true
                },
                idEstadoOC: {
                    excluded: true
                },
                idTiposOC: {
                    validators: {
                        notEmpty: {
                            message: 'Ingrese una Opcion'
                        }
                    }
                },
                tipoOCUpdate: {
                    validators: {
                        notEmpty: {
                            message: 'Ingrese una Opcion'
                        }
                    }
                },
                insumoChk: {
                    validators: {
                        notEmpty: {
                            message: 'Debe seleccionar al menos un Insumo'
                        },
                    }
                },
                costoEstimado: {
                    validators: {
                        notEmpty: {
                            message: 'Ingrese un Costo Estimado'
                        },
                        greaterThan: {
                            value: 0,
                            inclusive: false,
                            message: 'Debe ser mayor a 0'
                        }
                    }
                },
                costoFinal: {
                    validators: {
                        notEmpty: {
                            message: 'Ingrese el Costo Final'
                        },
                        greaterThan: {
                            value: 0,
                            inclusive: false,
                            message: 'Debe ser mayor a 0'
                        }
                    }
                }
            }
        })
        .on('success.field.bv', function (e, data) {
            data.element.removeClass('is-invalid');
            data.element.addClass('is-valid');
        })
        .on('error.field.bv', function (e, data) {
            data.element.removeClass('is-valid');
            data.element.addClass('is-invalid');
        })
        .on('success.form.bv', function (e) {
            reloadTable(e, this);
        });

    //eventos forms
    $('#formEventoNew, #formEventoUpdate, #formEventoUpdateEstado').bootstrapValidator({
            excluded: [':disabled'],
            fields: {
                nombre: {
                    validators: {
                        notEmpty: {
                            message: 'Ingrese un Nombre'
                        }
                    }
                },
                descripcion: {
                    validators: {
                        notEmpty: {
                            message: 'Ingrese una Descripcion'
                        }
                    }
                },
                fechaInicio: {
                    validators: {
                        notEmpty: {
                            message: 'Seleccione una Fecha'
                        },
                    }
                },
                periodicidad: {
                    validators: {
                        notEmpty: {
                            message: 'Ingrese una Periodicidad'
                        },
                        greaterThan: {
                            value: 0,
                            inclusive: false,
                            message: 'Debe ser mayor a 0'
                        }
                    }
                }
            }
        })
        .on('success.field.bv', function (e, data) {
            data.element.removeClass('is-invalid');
            data.element.addClass('is-valid');
        })
        .on('error.field.bv', function (e, data) {
            data.element.removeClass('is-valid');
            data.element.addClass('is-invalid');
        })
        .on('success.form.bv', function (e) {
            reloadTable(e, this);
        });

    function reloadTable(e, form) {
        e.preventDefault();
        let dataForm = $(form).serializeArray();
        if ($(form).attr('id') == 'formOCNew') {
            localStorage.setItem('idTiposOC', dataForm.find(element => element.name === 'idTiposOC')['value']);
            $('#modalCheckAndSetCosto').modal('show');
        } else {
            if ($(form).attr('id') == 'formCheckAndSetCosto') {
                dataForm.push({
                    name: 'idTiposOC',
                    value: JSON.parse(localStorage.getItem('idTiposOC'))
                }, {
                    name: 'insumos',
                    value: localStorage.getItem('insumos')
                });
            }
            if ($(form).attr('id') == 'formOCUpdInsumos') {
                dataForm.push({
                    name: 'insumos',
                    value: localStorage.getItem('insumosUpdate')
                });
            }
            $.post($(form).attr('action'), dataForm)
                .done(function (data) {
                    verificarAlertas(data);
                    callbackAfterReloadTable();
                    $('.modal').modal('hide');
                    if ($(form).attr('id') == 'formUsuarioNew' || $(form).attr('id') == 'formAgenteNew') {
                        $(`#${$(form).attr('id')} option[value=${dataForm.find(element => element.name == 'idPersona').value}]`).remove();
                    }
                    localStorage.clear();
                });
        }
    }
}