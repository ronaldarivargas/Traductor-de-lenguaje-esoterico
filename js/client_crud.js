document.addEventListener('DOMContentLoaded', () => {
    const userList = document.getElementById('user-list');
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const form = document.getElementById('user-form');
    const btnVerUsuarios = document.getElementById('btn-ver-usuarios');

    let isEditing = false;
    let editingId = null;

    function checkSession() {
        fetch('server/user/session_info.php')
            .then(res => res.json())
            .then(data => {
                if (!data.user_id) {
                    window.location.href = 'server/user/login.php';
                }
            });
    }

    function loadUsers() {
        fetch('server/crud_usr/read.php')
            .then(res => res.json())
            .then(users => {
                userList.innerHTML = '';
                users.forEach(user => {
                    const li = document.createElement('li');
                    li.innerHTML = `
                        ${user.name} (${user.email}) - ${user.registration_date}
                        <button onclick="editUser(${user.id_usr}, '${user.name}', '${user.email}')">Editar</button>
                        <button onclick="deleteUser(${user.id_usr})">Eliminar</button>
                    `;
                    userList.appendChild(li);
                });
                userList.style.display = 'block';
            })
            .catch(err => {
                console.error('Error al cargar usuarios:', err);
                userList.innerHTML = '<li>Error al cargar usuarios</li>';
            });
    }
    /*btnVerUsuarios.addEventListener('click', () => {
    console.log('Botón presionado');
    loadUsers();
    });*/

    btnVerUsuarios.addEventListener('click', loadUsers);

    form.addEventListener('submit', e => {
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
            body: JSON.stringify(payload),
            headers: { 'Content-Type': 'application/json' }
        })
        .then(res => res.json())
        .then((response) => {
            if (response.error) {
            alert(response.error); // Muestra mensaje si ya existe el correo
            return;
            }
            form.reset();
            isEditing = false;
            editingId = null;
            loadUsers(); // Recarga usuarios después de guardar
        });
    });

    window.editUser = (id, name, email) => {
        nameInput.value = name;
        emailInput.value = email;
        isEditing = true;
        editingId = id;
    };

    window.deleteUser = (id) => {
        fetch('server/crud_usr/delete.php', {
            method: 'POST',
            body: JSON.stringify({ id_usr: id }),
            headers: { 'Content-Type': 'application/json' }
        })
        .then(res => res.json())
        .then(() => loadUsers());
    };

    checkSession();
});


