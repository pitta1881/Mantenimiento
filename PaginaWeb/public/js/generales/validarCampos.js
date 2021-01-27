export default async function validarForm(callbackGetFichaAll) {
    let datos = await callbackGetFichaAll();
    let arrayRepetidosOld = [];
    if (datos) {
        datos.forEach(element => {
            arrayRepetidosOld.push(element['nombre']);
        });

        //usuarios forms
        $('#formUsuarioNew, #formUsuarioUpd, #formUsuarioRolesUpd').bootstrapValidator({
                excluded: [':disabled', ':hidden', ':not(:visible)'],
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
            });


        //personas forms
        $('#formPersonaNew, #formPersonaUpd, #formPersonaEstadoUpd').bootstrapValidator({
                excluded: [':disabled', ':hidden', ':not(:visible)'],
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
                                message: 'Carácter no permitido'
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
            });

        //rol forms
        $('#formRolNew').bootstrapValidator({
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
            });

        //agentes forms
        $('#formAgenteNew, #formAgenteUpd').bootstrapValidator({
                excluded: ':disabled',
                fields: {
                    idPersona: {
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
            });

        //sector forms
        $('#formSectorNew, #formSectorModificar').bootstrapValidator({
                excluded: ':disabled',
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
            });
    }
}