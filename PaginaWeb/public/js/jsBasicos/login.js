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