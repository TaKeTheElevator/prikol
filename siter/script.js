document.addEventListener('DOMContentLoaded', function() {
    let mountingaddons = false;

    function setProgress(percentage) {
        const progressBar = document.getElementById('progress-element-bar');
        const counter = document.getElementById('progress-element-counter');
        progressBar.style.width = percentage + '%';
        counter.textContent = Math.round(percentage) + '%';
    }

    function updateStatus(status) {
        const statusElement = document.getElementById('loading-status');
        statusElement.textContent = `Статус загрузки: ${status}`;
    }

    function SetStatusChanged(status) {
        if (status === "Mounting Addons") {
            mountingaddons = true;
            setProgress(50);
        } else if (status === "Workshop Complete") {
            mountingaddons = true;
            setProgress(50);
        } else if (status === "Client info sent!") {
            mountingaddons = true;
            setProgress(92);
        } else if (status === "Starting Lua...") {
            mountingaddons = true;
            setProgress(99);
        } else if (status.indexOf("/") !== -1) {
            const statusArray = status.split("/");
            const downloadedFiles = parseInt(statusArray[0], 10);
            const neededFiles = parseInt(statusArray[1].split(" ")[0], 10);
            let offset = 20;

            if (mountingaddons) {
                offset = 50;
            }
            const percent = ((downloadedFiles / neededFiles) * 100) / 3;
            setProgress(offset + percent);
        }

        updateStatus(status);
    }

    // Пример вызова SetStatusChanged
    // Здесь вы можете заменить этот код на реальный вызов, который будет получать данные от сервера
    SetStatusChanged("Mounting Addons");
    setTimeout(() => SetStatusChanged("50/150"), 2000);
    setTimeout(() => SetStatusChanged("Workshop Complete"), 4000);
    setTimeout(() => SetStatusChanged("Client info sent!"), 6000);
    setTimeout(() => SetStatusChanged("Starting Lua..."), 8000);

    // Обработка клика по контейнеру
    window.explainUserElement = function() {
        alert('Клик по контейнеру пользователя.');
    };
});
