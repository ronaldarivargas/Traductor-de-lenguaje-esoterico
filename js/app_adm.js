document.addEventListener('DOMContentLoaded', () => {
    const sesionUsuario = document.getElementById('saludo-usuario');
    const contenidoPrincipal = document.getElementById('contenido');
    const loginAviso = document.getElementById('mensaje-login');

    fetch('server/user_adm/session_info.php')
        .then(res => res.json())
        .then(data => {
            if (data.user_id) {
                if (sesionUsuario) {
                    sesionUsuario.textContent = `Bienvenido, ${data.user_name}`;
                }

                // Mostrar traducciones del usuario
                fetch('server/translations/get_user_translations.php')
                    .then(res => res.json())
                    .then(traducciones => {
                        if (traducciones.length === 0) {
                            contenidoPrincipal.innerHTML += '<p>No tienes traducciones registradas.</p>';
                        } else {
                            const lista = document.createElement('ul');
                            traducciones.forEach(trad => {
                                const item = document.createElement('li');
                                item.innerHTML = `
                                    <strong>Original:</strong> ${trad.source_Content}<br>
                                    <strong>Traducción:</strong> ${trad.transld_Contn}<br>
                                    <em>Fecha:</em> ${trad.translation_Date}
                                `;
                                lista.appendChild(item);
                            });
                            contenidoPrincipal.appendChild(lista);
                        }
                    });

            } else {
                if (loginAviso) {
                    loginAviso.innerHTML = '<p style="color:red;">Inicia sesión para acceder al sistema</p>';
                } else {
                    window.location.href = 'server/user_adm/login.php';
                }
            }
        })
        .catch(err => {
            console.error('Error al verificar la sesión:', err);
        });
});
