$(document).ajaxStart(function () {
    $("#loader").show();
});
$(document).ajaxStop(function () {
    $("#loader").hide();
});

$('#formLogin').on('submit', function (e) {
    e.preventDefault();
    if ($('#input-nick').val() != '' && $('#input-password').val() != '') {
        $.post($(this).attr('action'), $(this).serialize())
            .done(function (data) {
                data = JSON.parse(data);
                if (data.login) {
                    if (data.token) {
                        localStorage.setItem('token', data.token);
                    }
                    location.replace('/home');
                } else {
                    alertify.set('notifier', 'position', 'top-center');
                    alertify.error('Usuario o Contraseña inválidos');
                }
            });
    }
});

$(function () {
    const token = localStorage.getItem('token');
    if (token) {
        $.post('/validarToken', {
                token: token
            })
            .done(function (data) {
                data = JSON.parse(data);
                if (data.login && data.remember) {
                    location.replace('/home');
                }
            });
    }
})

$('#formRecoverPassword').on('submit', function (e) {
    e.preventDefault();
    $.post($(this).attr('action'), $(this).serialize())
        .done(function (data) {
            data = JSON.parse(data);
            alertify.set('notifier', 'position', 'top-center');
            if (data.status) {
                $('#modalRecoverPassword').modal('hide')
                alertify.success('Exito! Por favor revise su casilla de email.');
            } else {
                alertify.error(`Error! ${data.info}`);
            }
        });
});

$('#formResetPassword').on('submit', function (e) {
    e.preventDefault();
    $.post($(this).attr('action'), $(this).serialize())
        .done(function (data) {
            data = JSON.parse(data);
            alertify.set('notifier', 'position', 'top-center');
            if (data.status) {
                $('#modalResetPassword').modal('hide')
                alertify.success('Exito! Su contraseña se actualizó correctamente.');
            } else {
                alertify.error(`Error! No se pudo actualizar su contraseña. ${data.info}`);
            }
        });
});

$(function () {
    $('#formRecoverPassword, #formResetPassword').bootstrapValidator({
            excluded: [':disabled'],
            fields: {
                email: {
                    validators: {
                        notEmpty: {
                            message: 'Ingrese un Email'
                        },
                        emailAddress: {
                            message: 'Debe ingresar un Email válido'
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'Ingrese una Contraseña'
                        },
                        regexp: {
                            regexp: /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/,
                            message: 'Mínimo 8 caracteres, 1 número y 1 mayúscula<br>'
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
})