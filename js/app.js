document.addEventListener('DOMContentLoaded', () => {
  const saludo = document.getElementById('saludo-usuario');
  const mensajeLogin = document.getElementById('mensaje-login');

  const userForm = document.getElementById('user-form');
  const nameInput = document.getElementById('name');
  const emailInput = document.getElementById('email');
  const passwordInput = document.getElementById('password');
  const btnVerUsuarios = document.getElementById('btn-ver-usuarios');
  const userList = document.getElementById('user-list');

  let traduccionEnEdicion = null;

  fetch('server/user/session_info.php')
    .then(res => res.json())
    .then(data => {
      if (!data.user_id) {
        mensajeLogin.innerHTML = `<p style="color:red;">Inicia sesión para acceder</p>`;
        return;
      }
      saludo.textContent = `Hola, ${data.user_name} (rol: ${data.rol})`;
      if (data.rol === 'admin') {
        initAdminCrud();
        initTranslationModal();
      } else {
        initUserTranslation();
      }
    });

  window.eliminarTraduccion = function(id) {
    if (confirm('¿Eliminar traducción ' + id + '?')) {
      fetch('server/translations/delete.php', {
        method: 'POST', headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id_trans: id })
      })
      .then(res => res.json())
      .then(r => {
        if (r.error) alert(r.error);
        else cargarTraducciones();
      });
    }
  };

  window.editarTraduccion = function(id) {
    fetch('server/translations/get_one.php?id=' + id)
      .then(res => res.json())
      .then(data => {
        if (data.error) return alert(data.error);
        traduccionEnEdicion = data;
        document.getElementById('editar-id').value = data.id_trans;
        document.getElementById('editar-traduccion').value = data.transld_contn;
        new bootstrap.Modal(document.getElementById('modalEditar')).show();
      });
  };

  window.guardarEdicion = function() {
    const id = document.getElementById('editar-id').value;
    const nuevaTraduccion = document.getElementById('editar-traduccion').value;
    fetch('server/translations/update.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ id_trans: id, transld_contn: nuevaTraduccion })
    })
      .then(res => res.json())
      .then(resp => {
        if (resp.error) alert(resp.error);
        else {
          bootstrap.Modal.getInstance(document.getElementById('modalEditar')).hide();
          cargarTraducciones();
        }
      });
  };

  window.generarReporte = function() {
    window.open('server/translations/exportar_reporte.php', '_blank');
  };

  function initAdminCrud() {
    userForm && (userForm.style.display = 'block');
    btnVerUsuarios && (btnVerUsuarios.style.display = 'inline-block');

    btnVerUsuarios?.addEventListener('click', loadUsers);
    userForm?.addEventListener('submit', handleUserForm);

    let isEditing = false, editingId = null;

    window.editUser = (id, name, email) => {
      nameInput.value = name;
      emailInput.value = email;
      passwordInput.value = '';
      isEditing = true;
      editingId = id;
    };

    window.deleteUser = (id) => {
      if (confirm('¿Eliminar usuario?')) {
        fetch('server/crud_usr/delete.php', {
          method: 'POST', headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ id_usr: id })
        })
        .then(res => res.json())
        .then(() => loadUsers());
      }
    };

    function handleUserForm(e) {
      e.preventDefault();
      const name = nameInput.value.trim();
      const email = emailInput.value.trim();
      const password = passwordInput.value.trim();
      if (!name || !email || (!isEditing && !password)) {
        alert('Todos los campos son obligatorios');
        return;
      }
      const payload = { name, email };
      if (!isEditing || password) payload.password = password;
      let url = 'server/crud_usr/create.php';
      if (isEditing) {
        payload.id_usr = editingId;
        url = 'server/crud_usr/update.php';
      }
      fetch(url, {
        method: 'POST', headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload)
      })
        .then(res => res.json())
        .then(resp => {
          if (resp.error) {
            alert(resp.error);
            return;
          }
          userForm.reset();
          isEditing = false;
          editingId = null;
          loadUsers();
        });
    }

    function loadUsers() {
      fetch('server/crud_usr/read.php')
        .then(res => res.json())
        .then(users => {
          userList.innerHTML = '';
          users.forEach(u => {
            userList.insertAdjacentHTML('beforeend', `
              <li class="list-group-item">
                ${u.name} (${u.email}) — ${u.registration_date}
                <button class="btn btn-sm btn-warning ms-2" onclick="editUser(${u.id_usr}, '${u.name}', '${u.email}')">Editar</button>
                <button class="btn btn-sm btn-danger ms-1" onclick="deleteUser(${u.id_usr})">Eliminar</button>
              </li>
            `);
          });
        })
        .catch(() => {
          userList.innerHTML = '<li class="list-group-item text-danger">Error al cargar usuarios</li>';
        });
    }
  }

  function initUserTranslation() {
    const formT = document.getElementById('translation-form');
    const msg = document.getElementById('mensaje');
    formT?.addEventListener('submit', e => {
      e.preventDefault();
      const data = {
        source_Content: document.getElementById('source_Content').value,
        cod_typ_writing: document.getElementById('cod_typ_writing').value
      };
      fetch('server/translations/create_translation.php', {
        method: 'POST', headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
      })
        .then(res => res.json())
        .then(r => {
          if (r.error) msg.innerHTML = `<p style="color:red">${r.error}</p>`;
          else {
            msg.innerHTML = `<p style="color:green">¡Guardado!</p>`;
            formT.reset();
          }
        })
        .catch(() => {
          msg.innerHTML = `<p style="color:red">Error de conexión</p>`;
        });
    });
  }

  function initTranslationModal() {
    const modalEl = document.getElementById('modalTraducciones');
    if (!modalEl) return;

    modalEl.addEventListener('shown.bs.modal', cargarTraducciones);
  }

  function cargarTraducciones() {
    const tbody = document.querySelector('#tabla-traducciones tbody');
    tbody.innerHTML = '<tr><td colspan="5">Cargando...</td></tr>';
    fetch('server/translations/read_all.php')
      .then(res => res.json())
      .then(data => {
        tbody.innerHTML = '';
        if (data.error) {
          tbody.innerHTML = `<tr><td colspan="5" class="text-danger">${data.error}</td></tr>`;
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
  }
});






