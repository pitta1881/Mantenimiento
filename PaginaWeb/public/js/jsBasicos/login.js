$('form').on('submit', function (e) {
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
                    alertify.alert('Error', 'Usuario o Contraseña inválidos', function () {});
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