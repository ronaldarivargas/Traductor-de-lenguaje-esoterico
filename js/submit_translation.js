document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('translation-form');
    const mensaje = document.getElementById('mensaje');

    form.addEventListener('submit', (e) => {
        e.preventDefault();

        const data = {
            source_Content: document.getElementById('source_Content').value,
            cod_typ_writing: document.getElementById('cod_typ_writing').value
        };

        fetch('server/translations/create_translation.php', {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(res => res.json())
        .then(result => {
            if (result.success) {
                mensaje.innerHTML = "<p style='color:green;'>¡Traducción registrada correctamente!</p>";
                form.reset();
            } else {
                mensaje.innerHTML = "<p style='color:red;'>Error: " + result.error + "</p>";
            }
        })
        .catch(err => {
            console.error('Error:', err);
            mensaje.innerHTML = "<p style='color:red;'>Error de conexión con el servidor.</p>";
        });
    });
});
