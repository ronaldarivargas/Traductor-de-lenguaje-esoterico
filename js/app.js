document.addEventListener('DOMContentLoaded', () => {
    const sesionUsuario = document.getElementById('saludo-usuario');
    const contenidoPrincipal = document.getElementById('contenido');
    const loginAviso = document.getElementById('mensaje-login');

    fetch('user_adm/session_info.php')
        .then(res => res.json())
        .then(data => {
            if (data.user_id) {
                // Mostrar saludo al usuario
                if (sesionUsuario) {
                    sesionUsuario.textContent = `Bienvenido, ${data.user_name}`;
                }

                // Cargar traducciones anteriores del usuario
                fetch('user_adm/get_user_translations.php?user_id=' + data.user_id)
                    .then(response => response.json())
                    .then(translations => {
                        if (translations && translations.length > 0) {
                            let translationsHtml = '<h2>Traducciones anteriores:</h2><ul>';
                            translations.forEach(translation => {
                                translationsHtml += `<li><strong>Traducción:</strong> ${translation.transld_Contn} <br><strong>Fecha:</strong> ${translation.translation_Date}</li>`;
                            });
                            translationsHtml += '</ul>';
                            contenidoPrincipal.innerHTML = translationsHtml;
                        } else {
                            contenidoPrincipal.innerHTML = '<p>No tienes traducciones previas.</p>';
                        }
                    })
                    .catch(err => {
                        console.error('Error al obtener las traducciones:', err);
                    });
            } else {
                // No hay sesión activa
                if (loginAviso) {
                    loginAviso.innerHTML = '<p style="color:red;">Inicia sesión para acceder al sistema</p>';
                } else {
                    window.location.href = 'user_adm/login.php';
                }
            }
        })
        .catch(err => {
            console.error('Error al verificar la sesión:', err);
        });
});
