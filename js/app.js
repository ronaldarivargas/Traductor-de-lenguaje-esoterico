document.addEventListener('DOMContentLoaded', () => {
  const saludo = document.getElementById('saludo-usuario');
  const mensajeLogin = document.getElementById('mensaje-login');
  const contenido = document.getElementById('contenido');

  const userForm      = document.getElementById('user-form');
  const nameInput     = document.getElementById('name');
  const emailInput    = document.getElementById('email');
  const passwordInput = document.getElementById('password');
  const btnVerUsuarios= document.getElementById('btn-ver-usuarios');
  const userList      = document.getElementById('user-list');

  // 1) Primero, preguntamos quién está en sesión (usuario o admin)
  fetch('server/user/session_info.php')
    .then(res => res.json())
    .then(data => {
      if (!data.user_id) {
        // no hay nadie logueado
        mensajeLogin.innerHTML = `<p style="color:red;">Inicia sesión para acceder</p>`;
        return;
      }

      saludo.textContent = `Hola, ${data.user_name} (rol: ${data.rol})`;

      if (data.rol === 'admin') {
        // ACTIVAMOS el CRUD de usuarios
        initAdminCrud();
      } else {
        // Entra al otro rol (usuario) ACTIVAMOS el formulario de traducciones
        initUserTranslation();
      }
    })
    .catch(err => console.error(err));

  // ——————————————————————————————————————
  // ADMIN: CRUD de usuarios
  function initAdminCrud() {
    // Mostrar el formulario y botón de usuarios
    userForm  && userForm.style.display  = 'block';
    btnVerUsuarios && btnVerUsuarios.style.display = 'inline-block';

    // Comportamiento de CARGAR usuarios
    btnVerUsuarios.addEventListener('click', loadUsers);
    // Comportamiento de GUARDAR/EDITAR usuarios
    userForm.addEventListener('submit', e => {
      e.preventDefault();
      const payload = {
        name: nameInput.value,
        email: emailInput.value,
        password: passwordInput.value
      };
      let url = 'server/crud_usr/create.php';
      if (isEditing) {
        payload.id_usr = editingId;
        url = 'server/crud_usr/update.php';
      }
      fetch(url, {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(payload)
      })
      .then(res => res.json())
      .then(response => {
        if (response.error) {
          return alert(response.error);
        }
        userForm.reset();
        isEditing = false;
        editingId = null;
        loadUsers();
      });
    });
    // Variables para editar
    let isEditing = false, editingId = null;
    window.editUser = (id, name, email) => {
      nameInput.value = name;
      emailInput.value = email;
      isEditing = true;
      editingId = id;
    };
    window.deleteUser = id => {
      fetch('server/crud_usr/delete.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({id_usr: id})
      })
      .then(() => loadUsers());
    };
    // Función de lectura
    function loadUsers() {
      fetch('server/crud_usr/read.php')
        .then(res => res.json())
        .then(users => {
          userList.innerHTML = '';
          users.forEach(u => {
            const li = document.createElement('li');
            li.innerHTML = `
              ${u.name} (${u.email}) — ${u.registration_date}
              <button onclick="editUser(${u.id_usr}, '${u.name}', '${u.email}')">Editar</button>
              <button onclick="deleteUser(${u.id_usr})">Eliminar</button>
            `;
            userList.appendChild(li);
          });
          userList.style.display = 'block';
        })
        .catch(() => {
          userList.innerHTML = '<li>Error al cargar usuarios</li>';
          userList.style.display = 'block';
        });
    }
  }

  // —————————————————————————————————————
  // USUARIO: envío de traducción
  function initUserTranslation() {
    const formT = document.getElementById('translation-form');
    const msg   = document.getElementById('mensaje');
    formT && formT.addEventListener('submit', e => {
      e.preventDefault();
      const data = {
        source_Content: document.getElementById('source_Content').value,
        cod_typ_writing: document.getElementById('cod_typ_writing').value
      };
      fetch('server/translations/create_translation.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
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

});


