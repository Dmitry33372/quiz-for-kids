<?php
require_once 'php/config.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz for Kids</title>
    <link rel="stylesheet" href="styles/main.css">
    <link rel="icon" href="images/favicon/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Bubblegum+Sans&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <img src="images/logo.svg" alt="Quiz for Kids Logo">
            </div>
            <div class="welcome-text">
                <h1>
                    <span class="line1">Привет, юный исследователь!</span>
                    <span class="line2">Добро пожаловать в мир знаний!</span>
                </h1>
            </div>
            <div class="auth-buttons">
                <button onclick="openModal('login-modal')">Войти</button>
                <button onclick="openModal('register-modal')">Зарегистрироваться</button>
            </div>
        </div>
    </header>

    <!-- Модальное окно для входа -->
    <div id="login-modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('login-modal')">×</span>
            <h2>Вход</h2>
            <form id="login-form">
                <div class="form-group">
                    <label for="login-email">Эл. почта:</label>
                    <div class="input-wrapper">
                        <input type="email" id="login-email" name="email" required>
                        <span class="validation-icon"></span>
                    </div>
                    <span class="error-message"></span>
                </div>
                <div class="form-group">
                    <label for="login-password">Пароль:</label>
                    <div class="input-wrapper">
                        <input type="password" id="login-password" name="password" required>
                        <span class="validation-icon"></span>
                    </div>
                    <span class="error-message"></span>
                </div>
                <div class="form-group form-links">
                    <a href="#" onclick="switchModal('login-modal', 'reset-password-modal')">Забыли пароль?</a>
                    <label class="remember-me">
                        <input type="checkbox" id="remember-me" name="remember-me">
                        <span>Запомнить меня</span>
                    </label>
                </div>
                <a href="#" onclick="switchModal('login-modal', 'register-modal')">Зарегистрироваться</a>
                <button type="submit">Войти</button>
            </form>
        </div>
    </div>

    <!-- Модальное окно для регистрации -->
    <div id="register-modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('register-modal')">×</span>
            <h2>Регистрация</h2>
            <form id="register-form">
                <div class="form-group">
                    <label for="register-email">Эл. почта:</label>
                    <div class="input-wrapper">
                        <input type="email" id="register-email" name="email" required>
                        <span class="validation-icon"></span>
                    </div>
                    <span class="error-message"></span>
                </div>
                <div class="form-group">
                    <label for="register-password">Пароль:</label>
                    <div class="input-wrapper">
                        <input type="password" id="register-password" name="password" required>
                        <span class="validation-icon"></span>
                    </div>
                    <span class="error-message"></span>
                </div>
                <div class="form-group">
                    <label for="confirm-password">Повторите пароль:</label>
                    <div class="input-wrapper">
                        <input type="password" id="confirm-password" name="confirm-password" required>
                        <span class="validation-icon"></span>
                    </div>
                    <span class="error-message"></span>
                </div>
                <div class="form-group">
                    <label for="child-name">Имя ребенка:</label>
                    <div class="input-wrapper">
                        <input type="text" id="child-name" name="child-name" required>
                        <span class="validation-icon"></span>
                    </div>
                    <span class="error-message"></span>
                </div>
                <div class="form-group">
                    <label for="gender">Пол:</label>
                    <div class="input-wrapper">
                        <select id="gender" name="gender" required>
                            <option value="">Выберите пол</option>
                            <option value="male">Мужской</option>
                            <option value="female">Женский</option>
                        </select>
                        <span class="validation-icon"></span>
                    </div>
                    <span class="error-message"></span>
                </div>
                <div class="form-group">
                    <label>Выберите аватар:</label>
                    <div class="avatar-selector" onclick="openModal('avatar-modal')">
                        <span>Нажмите, чтобы выбрать аватар</span>
                        <img id="selected-avatar" src="" alt="" style="display: none;">
                        <input type="hidden" id="avatar" name="avatar">
                        <input type="hidden" id="custom-avatar-data" name="custom-avatar-data">
                    </div>
                </div>
                <div class="form-group">
                    <label for="custom-avatar">Или загрузите свой:</label>
                    <input type="file" id="custom-avatar" name="custom-avatar" accept="image/*">
                </div>
                <a href="#" onclick="switchModal('register-modal', 'login-modal')">Войти</a>
                <button type="submit">Зарегистрироваться</button>
            </form>
        </div>
    </div>

    <!-- Модальное окно для выбора аватарок -->
    <div id="avatar-modal" class="modal">
        <div class="modal-content avatar-modal-content">
            <span class="close" onclick="closeModal('avatar-modal')">×</span>
            <h2>Выберите аватар</h2>
            <div class="avatar-grid">
                <img src="images/avatars/avatarka1.png" alt="Аватар 1" onclick="selectAvatar('avatarka1.png')">
                <img src="images/avatars/avatarka2.png" alt="Аватар 2" onclick="selectAvatar('avatarka2.png')">
                <img src="images/avatars/avatarka3.png" alt="Аватар 3" onclick="selectAvatar('avatarka3.png')">
                <img src="images/avatars/avatarka4.png" alt="Аватар 4" onclick="selectAvatar('avatarka4.png')">
                <img src="images/avatars/avatarka5.png" alt="Аватар 5" onclick="selectAvatar('avatarka5.png')">
                <img src="images/avatars/avatarka6.png" alt="Аватар 6" onclick="selectAvatar('avatarka6.png')">
                <img src="images/avatars/avatarka7.png" alt="Аватар 7" onclick="selectAvatar('avatarka7.png')">
                <img src="images/avatars/avatarka8.png" alt="Аватар 8" onclick="selectAvatar('avatarka8.png')">
                <img src="images/avatars/avatarka9.png" alt="Аватар 9" onclick="selectAvatar('avatarka9.png')">
                <img src="images/avatars/avatarka10.png" alt="Аватар 10" onclick="selectAvatar('avatarka10.png')">
            </div>
        </div>
    </div>

    <!-- Модальное окно для восстановления пароля -->
    <div id="reset-password-modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('reset-password-modal')">×</span>
            <h2>Восстановление пароля</h2>
            <form id="reset-password-form">
                <div class="form-group">
                    <label for="reset-email">Эл. почта:</label>
                    <div class="input-wrapper">
                        <input type="email" id="reset-email" name="email" required>
                        <span class="validation-icon"></span>
                    </div>
                    <span class="error-message"></span>
                </div>
                <button type="submit">Отправить</button>
            </form>
        </div>
    </div>

    <main>
        <!-- Список предметов будет добавлен позже -->
    </main>

    <script src="scripts/main.js"></script>
</body>
</html>