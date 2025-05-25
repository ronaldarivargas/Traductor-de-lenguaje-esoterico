<?php
session_start();

// Verificar que haya sesión y sea un administrador
if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 'admin') {
    header('Location: server/user/login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrador - Usuarios y Traducciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Gestión de Usuarios</h2>
            <form action="server/user/logout.php" method="post">
                <button type="submit" class="btn btn-danger">Cerrar sesión</button>
            </form>
        </div>

        <!-- Formulario CRUD Usuarios -->
        <form id="user-form" class="mb-4">
            <div class="row g-2">
                <div class="col-md-4">
                    <input type="text" id="name" class="form-control" placeholder="Nombre" required>
                </div>
                <div class="col-md-4">
                    <input type="email" id="email" class="form-control" placeholder="Correo electrónico" required>
                </div>
                <div class="col-md-4">
                    <input type="password" id="password" class="form-control" placeholder="Contraseña">
                </div>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-success">Guardar usuario</button>
                <button type="button" id="btn-ver-usuarios" class="btn btn-primary ms-2">Mostrar usuarios</button>
                <button type="button" class="btn btn-info ms-2" data-bs-toggle="modal" data-bs-target="#modalTraducciones">Ver Traducciones</button>
            </div>
        </form>

        <ul id="user-list" class="list-group"></ul>
    </div>

    <!-- Modal Traducciones -->
    <div class="modal fade" id="modalTraducciones" tabindex="-1" aria-labelledby="modalTraduccionesLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalTraduccionesLabel">Gestión de Traducciones</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>
          <div class="modal-body">
            <table class="table table-striped" id="tabla-traducciones">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Texto Original</th>
                  <th>Traducción</th>
                  <th>Fecha</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
            <button class="btn btn-success" onclick="generarReporte()">📄 Generar Reporte</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal para editar traducción -->
    <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalEditarLabel">Editar Traducción</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="editar-id">
            <textarea id="editar-traduccion" class="form-control" rows="4"></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" onclick="guardarEdicion()">Guardar Cambios</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Scripts -->
    <script>
    document.getElementById('modalTraducciones').addEventListener('shown.bs.modal', () => {
        const tbody = document.querySelector('#tabla-traducciones tbody');
        tbody.innerHTML = '<tr><td colspan="5">Cargando...</td></tr>';
        fetch('server/translations/read_all.php')
            .then(res => res.json())
            .then(data => {
                tbody.innerHTML = '';
                if (data.error) {
                    tbody.innerHTML = `<tr><td colspan="5" class="text-danger">Error: ${data.error}</td></tr>`;
                    return;
                }
                if (data.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="5">No hay traducciones registradas.</td></tr>';
                    return;
                }
                data.forEach(t => {
                    tbody.insertAdjacentHTML('beforeend', `
                        <tr>
                            <td>${t.id_trans}</td>
                            <td>${t.source_content}</td>
                            <td>${t.transld_contn}</td>
                            <td>${new Date(t.translation_date).toLocaleString()}</td>
                            <td>
                                <button class="btn btn-sm btn-warning" onclick="editarTraduccion(${t.id_trans})">Editar</button>
                                <button class="btn btn-sm btn-danger" onclick="eliminarTraduccion(${t.id_trans})">Eliminar</button>
                            </td>
                        </tr>
                    `);
                });
            })
            .catch(() => {
                tbody.innerHTML = '<tr><td colspan="5" class="text-danger">Error de conexión</td></tr>';
            });
    });

    window.generarReporte = function() {
        window.open('server/translations/exportar_reporte.php', '_blank');
    };
    window.editarTraduccion = function(id) {
        alert('Implementar edición para ID ' + id);
    };
    window.eliminarTraduccion = function(id) {
        if (confirm('¿Eliminar traducción ' + id + '?')) {
            fetch('server/translations/delete.php', {
                method: 'POST', headers: {'Content-Type':'application/json'},
                body: JSON.stringify({ id_trans:id })
            })
            .then(res=>res.json())
            .then(r=>{
                if (r.error) alert(r.error);
                else {
                    var modal = bootstrap.Modal.getInstance(document.getElementById('modalTraducciones'));
                    modal.hide();
                    setTimeout(() => modal.show(), 300);
                }
            });
        }
    };
    </script>

    <script src="js/client_crud.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>







