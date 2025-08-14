function loginButton() {
  const login = document.getElementById("login").value;
  const password = document.getElementById("password").value;
  const submitBtn = document.getElementById("submitBtn");

  // Если поля пустые, блокируем кнопку, иначе разблокируем
  if (login.trim() === "" || password.trim() === "") {
    submitBtn.disabled = true;
  } else {
    submitBtn.disabled = false;
  }
}

// МОДАЛЬНОЕ ОКНО
const openModalBtns = document.querySelectorAll(".open-modal");
const closeModalBtn = document.getElementById("closeModalBtn");
const modal = document.getElementById("modal");
const overlay = document.getElementById("overlay");

if (modal) {
  openModalBtns.forEach((btn) => {
    btn.addEventListener("click", (event) => {
      event.preventDefault();

      if (btn.dataset.remove) {
        // Находим блок modal-buttons в модалке
        const modalButtons = modal.querySelector(".modal-buttons");

        // Удаляем предыдущую радио-кнопку, если она уже есть
        const existingRadio = modalButtons.querySelector(
          'input[name="remove"]'
        );
        if (existingRadio) {
          existingRadio.remove();
        }

        // Создаем новую радио-кнопку
        const radioBtn = document.createElement("input");
        radioBtn.type = "radio";
        radioBtn.name = "remove";
        radioBtn.value = btn.dataset.remove;
        radioBtn.checked = true;

        // Вставляем радио-кнопку в блок modal-buttons
        modalButtons.appendChild(radioBtn);
      }

      modal.showPopover(); // Используем showPopover для открытия модального окна
      overlay.style.display = "block"; // Показываем затемнение фона
    });
  });

  closeModalBtn.addEventListener("click", () => {
    modal.hidePopover(); // Используем hidePopover для закрытия модального окна
    overlay.style.display = "none"; // Скрываем затемнение фона
  });

  overlay.addEventListener("click", () => {
    modal.hidePopover();
    overlay.style.display = "none";
  });

  document.addEventListener("keydown", (event) => {
    if (event.key === "Escape" && modal.matches(":popover-open")) {
      modal.hidePopover();
      overlay.style.display = "none";
    }
  });
}

// КОМПОНЕНТ ЗАГРУЗКИ ФАЙЛОВ

document.querySelectorAll(".file-upload-component").forEach((component) => {
  const fileInput = component.querySelector(".file-input");
  const fileList = component.querySelector(".file-list");
  let filesArray = [];

  // Добавление файлов в список
  fileInput.addEventListener("change", () => {
    filesArray = [];
    fileList.innerHTML = "";
    for (let file of fileInput.files) {
      addFileToList(file);
    }
  });

  function addFileToList(file) {
    // Добавление файла в массив
    filesArray.push({ file, isFavorite: false });

    const listItem = document.createElement("li");
    listItem.classList.add("file-item");

    const fileName = document.createElement("span");
    fileName.textContent = file.name;
    fileName.classList.add("file-name");
    listItem.appendChild(fileName);

    fileList.appendChild(listItem);
  }
});

document
  .querySelectorAll('.file-uploaded__remove input[type="checkbox"]')
  .forEach((checkbox) => {
    checkbox.addEventListener("change", function () {
      const fileUploaded = this.closest(".file-uploaded");
      if (this.checked) {
        fileUploaded.classList.add("is-deleted");
      } else {
        fileUploaded.classList.remove("is-deleted");
      }
    });
  });
