<?= view('partials/user_panel_header.php'); ?>

<main class="main">
    <form action="index.php" class="form" method="post">
        <h2 class="container__title">Iniciar sesión</h2>

        <!-- Email -->
        <div class="form__control">
            <label for="email" class="form__label">Email:</label>
            <input type="email" class="form__input" name="email" required />
        </div>

        <!-- Password -->
        <div class="form__control">
            <label for="password" class="form__label">Contraseña:</label>
            <input type="password" class="form__input" name="password" required />
        </div>

        <!-- Submit -->
        <div class="form__control--submit">
            <input type="submit" name="login" class="form__submit" value="Iniciar sesión" />
        </div>
        <div class="center__container">
            <a href="<?php echo base_url('/users/new') ?>" class="btn__create_user">Crear cuenta</a>
        </div>
    </form>
</main>

<footer class="footer">
    <p class="footer__text">Todos los derechos reservados &copy;</p>
</footer>
</div>
</body>

</html>