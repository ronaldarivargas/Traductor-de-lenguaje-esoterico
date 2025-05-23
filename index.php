<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Trductor de lenguaje esotérico</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/styles.css'>
    <script src='js/app.js'></script>
</head>

<body>
    <form action="server/user/logout.php" method="get">
        <button type="submit" class="delete-btn left-align">Cerrar sesión</button>
    </form>

    <br><br><br>
    <main>
        <h1>Traductor de lenguaje antiguo y esotérico <?php echo $_SESSION['user_name']; ?></h1>
        <form action="server/task/create.php" method="post" class="my-form">
            <label for="title" class="field">
                <span>
                    <span class="req-field">*</span>
                    Title:
                </span>
                <input type="text" name="title" placeholder="title" id="title" required />
            </label>
            <label for="description" class="field">
                <span>Description: </span>
                <input type="text" name="description" placeholder="description" id="description" />
            </label>
            <label for="due_date" class="field">
                <span>Release date:</span>
                <input type="date" name="due_date" placeholder="due_date" id="due_date" />
            </label>
            <label for="completed" class="field cbx-g">
                <span>¿Is completed?</span>
                <input !checked type="checkbox" name="completed" placeholder="completed" id="completed" value="false" />
            </label>
            <!--
            <label for="user_id" class="field">
                <span>
                    <span class="req-field">*</span>
                    User id:
                </span>
-->
            <input type="hidden" name="user_id" placeholder="user_id" id="user_id" required
                value="<?php echo $_SESSION['user_id']; ?>" />
            <!--</label>-->
            <label for="category_id" class="field">
                <span>
                    <span class="req-field">*</span>
                    Category:
                </span>
                <!--
                <input type="number" name="category_id" placeholder="category_id" id="category_id" required />
                -->
                <select id="category-list" name="category_id" class="form-control form-control-sm" required>

                </select>
            </label>
            <button type="submit">Enviar</button>
        </form>
        <ul id="task-list"></ul>
    </main>
</body>

</html>