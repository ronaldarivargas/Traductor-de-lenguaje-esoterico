document.addEventListener('DOMContentLoaded', () => {
    const userList = document.getElementById('user-list');
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const form = document.getElementById('user-form');

    let isEditing = false;
    let editingId = null;

    function checkSession() {
        fetch('server/user/session_info.php')
            .then(res => res.json())
            .then(data => {
                if (!data.admin_id) window.location.href = 'login.php';
                else loadUsers();
            });
    }

    function loadUsers() {
        fetch('server/user/read.php')
            .then(res => res.json())
            .then(users => {
                userList.innerHTML = '';
                users.forEach(user => {
                    const li = document.createElement('li');
                    li.innerHTML = `
                        ${user.name} (${user.email}) - ${user.registration_Date}
                        <button onclick="editUser(${user.id_usr}, '${user.name}', '${user.email}')">Editar</button>
                        <button onclick="deleteUser(${user.id_usr})">Eliminar</button>
                    `;
                    userList.appendChild(li);
                });
            });
    }

    form.addEventListener('submit', e => {
        e.preventDefault();
        const payload = {
            name: nameInput.value,
            email: emailInput.value,
            password: passwordInput.value
        };

        let url = 'server/user/create.php';
        if (isEditing) {
            payload.id_usr = editingId;
            url = 'server/user/update.php';
        }

        fetch(url, {
            method: 'POST',
            body: JSON.stringify(payload),
            headers: { 'Content-Type': 'application/json' }
        })
            .then(res => res.json())
            .then(() => {
                form.reset();
                isEditing = false;
                editingId = null;
                loadUsers();
            });
    });

    window.editUser = (id, name, email) => {
        nameInput.value = name;
        emailInput.value = email;
        isEditing = true;
        editingId = id;
    };

    window.deleteUser = (id) => {
        fetch('server/user/delete.php', {
            method: 'POST',
            body: JSON.stringify({ id_usr: id }),
            headers: { 'Content-Type': 'application/json' }
        })
            .then(res => res.json())
            .then(() => loadUsers());
    };

    checkSession();
});
