document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('translation-form');
    const mensaje = document.getElementById('mensaje');

    form.addEventListener('submit', (e) => {
        e.preventDefault();

        const texto = document.getElementById('source_Content').value;
        const tipo = document.getElementById('cod_typ_writing').value;

        // Validación UTF-8 antes de enviar
        if (!isValidUTF8(texto)) {
            mensaje.innerHTML = "<p style='color:red;'>El texto contiene caracteres no válidos para codificación UTF-8.</p>";
            return;
        }

        const data = {
           source_Content: texto,
           cod_typ_writing: tipo 
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
                //form.reset();

                // Mostrar la traducción en el textarea
                const traduccion = result.traduccion || "(No disponible)";
                document.getElementById('resultado_traduccion').value = traduccion;

            } else {
                mensaje.innerHTML = "<p style='color:red;'>Error: " + result.error + "</p>";
            }
        })
        .catch(err => {
            console.error('Error:', err);
            mensaje.innerHTML = "<p style='color:red;'>Error de conexión con el servidor.</p>";
        });
    });
//});

 // Esta función valida codificación UTF-8
    function isValidUTF8(text) {
        try {
            const encoder = new TextEncoder();
            const decoder = new TextDecoder('utf-8', { fatal: true });
            decoder.decode(encoder.encode(text));
            return true;
        } catch (e) {
            return false;
        }
    }
// Nueva función para mensajes temporales
    function mostrarMensaje(texto, color = "red", duracion = 3000) {
        mensaje.innerHTML = `<p style="color:${color};">${texto}</p>`;
        setTimeout(() => {
            mensaje.innerHTML = "";
        }, duracion);
    }

});

