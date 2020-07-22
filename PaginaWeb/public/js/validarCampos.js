$('#formAlta').bootstrapValidator({
    feedbackIcons: {
        valid: 'fa fa-thumbs-up',
        invalid: 'fa fa-remove',
        validating: 'fa fa-refresh'
    },
    fields: {
        nombre: {
            validators: {
                stringLength: {
                    min: 5,
                    max: 11,
                    message: 'Minimo 5 caracteres y Maximo 11'
                },
                notEmpty: {
                    message: 'Ingrese un Nick'
                }
            }
        },
        dni: {
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
        confirmPassword: {
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
        idRol: {
            validators: {
                notEmpty: {
                    message: 'Seleccione un Rol'
                }
            }
        },
    }
});