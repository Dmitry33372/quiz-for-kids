function openModal(modalId) {
  const modal = document.getElementById(modalId);
  modal.classList.add("active");
}

function closeModal(modalId) {
  const modal = document.getElementById(modalId);
  modal.classList.remove("active");
  // Сбрасываем формы и сообщения об ошибках
  const form = modal.querySelector("form");
  if (form) {
    const inputs = form.querySelectorAll("input, select");
    inputs.forEach((input) => {
      const wrapper = input.closest(".input-wrapper");
      if (wrapper) {
        const icon = wrapper.querySelector(".validation-icon");
        const error = wrapper.nextElementSibling;
        input.classList.remove("error");
        icon.classList.remove("valid", "invalid");
        error.textContent = "";
      }
    });
  }
}

function switchModal(currentModalId, targetModalId) {
  closeModal(currentModalId);
  openModal(targetModalId);
}

function selectAvatar(avatarName) {
  const selectedAvatar = document.getElementById("selected-avatar");
  const avatarInput = document.getElementById("avatar");
  const customAvatarData = document.getElementById("custom-avatar-data");
  selectedAvatar.src = `images/avatars/${avatarName}`;
  selectedAvatar.style.display = "block";
  avatarInput.value = avatarName;
  customAvatarData.value = ""; // Сбрасываем кастомный аватар
  document.querySelector(".avatar-selector span").textContent = "Аватар выбран";
  closeModal("avatar-modal");
}

// Валидация email
function validateEmail(email) {
  const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return re.test(email);
}

// Валидация имени ребенка
function validateChildName(name) {
  const re = /^[a-zA-Zа-яА-Я\s]+$/;
  return re.test(name) && name.trim().length > 0;
}

// Проверка поля
function validateField(input) {
  const wrapper = input.closest(".input-wrapper");
  const icon = wrapper ? wrapper.querySelector(".validation-icon") : null;
  const errorMessage = wrapper ? wrapper.nextElementSibling : null;
  let isValid = false;
  let errorText = "";

  switch (input.id) {
    case "login-email":
    case "register-email":
    case "reset-email":
      isValid = validateEmail(input.value);
      errorText = isValid ? "" : "Введите корректный email";
      break;
    case "login-password":
    case "register-password":
      isValid = input.value.length >= 6;
      errorText = isValid ? "" : "Пароль должен содержать минимум 6 символов";
      break;
    case "confirm-password":
      const password = document.getElementById("register-password").value;
      isValid = input.value === password && input.value.length >= 6;
      errorText = isValid ? "" : "Пароли не совпадают";
      break;
    case "child-name":
      isValid = validateChildName(input.value);
      errorText = isValid
        ? ""
        : "Введите корректное имя (только буквы и пробелы)";
      break;
    case "gender":
      isValid = input.value !== "";
      errorText = isValid ? "" : "Выберите пол";
      break;
  }

  if (wrapper && icon && errorMessage) {
    icon.classList.remove("valid", "invalid");
    input.classList.remove("error");
    if (input.value.trim() !== "") {
      icon.classList.add(isValid ? "valid" : "invalid");
      if (!isValid) input.classList.add("error");
    }
    errorMessage.textContent = errorText;
  }
  return isValid;
}

// Обработчики событий для форм
document.addEventListener("DOMContentLoaded", () => {
  const forms = document.querySelectorAll(
    "#login-form, #register-form, #reset-password-form"
  );
  forms.forEach((form) => {
    const inputs = form.querySelectorAll("input, select");
    inputs.forEach((input) => {
      input.addEventListener("input", () => validateField(input));
      input.addEventListener("blur", () => validateField(input));
    });

    form.addEventListener("submit", (e) => {
      e.preventDefault();
      let allValid = true;
      inputs.forEach((input) => {
        if (!validateField(input)) {
          allValid = false;
        }
      });

      if (allValid) {
        if (form.id === "reset-password-form") {
          const email = form.querySelector("#reset-email").value;
          // Отправка AJAX-запроса для восстановления пароля
          fetch("reset_password.php", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify({ email }),
          })
            .then((response) => response.json())
            .then((data) => {
              if (data.success) {
                alert("Письмо для восстановления пароля отправлено!");
                closeModal("reset-password-modal");
              } else {
                const errorMessage = form.querySelector(".error-message");
                errorMessage.textContent =
                  data.error || "Ошибка при отправке письма";
              }
            })
            .catch((error) => {
              console.error("Error:", error);
              const errorMessage = form.querySelector(".error-message");
              errorMessage.textContent = "Ошибка сервера";
            });
        } else {
          console.log("Форма валидна, данные:", new FormData(form));
          closeModal(form.closest(".modal").id);
        }
      }
    });
  });

  // Обработка загрузки кастомного аватара
  const customAvatarInput = document.getElementById("custom-avatar");
  customAvatarInput.addEventListener("change", (e) => {
    const file = e.target.files[0];
    if (file && file.type.startsWith("image/")) {
      const reader = new FileReader();
      reader.onload = (event) => {
        const selectedAvatar = document.getElementById("selected-avatar");
        const avatarInput = document.getElementById("avatar");
        const customAvatarData = document.getElementById("custom-avatar-data");
        selectedAvatar.src = event.target.result;
        selectedAvatar.style.display = "block";
        avatarInput.value = ""; // Сбрасываем стандартный аватар
        customAvatarData.value = event.target.result; // Сохраняем данные изображения
        document.querySelector(".avatar-selector span").textContent =
          "Аватар загружен";
      };
      reader.readAsDataURL(file);
    }
  });
});
