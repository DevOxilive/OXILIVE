<button class="open-popup-button">Abrir ventana emergente</button>

<div class="popup">
    <div class="popup-content">
        <span class="close-popup">&times;</span>
        <h2>rico:V</h2>
        <p>Contenido de la ventana emergente...</p>
        <button class="close-popup-button">Cerrar</button>
    </div>
</div>
<script>
    const popup = document.querySelector('.popup');
    const openPopupButton = document.querySelector('.open-popup-button');
    const closePopupButtons = document.querySelectorAll('.close-popup, .close-popup-button');

    openPopupButton.addEventListener('click', () => {
        popup.style.display = 'block';
    });

    closePopupButtons.forEach(button => {
        button.addEventListener('click', () => {
            popup.style.display = 'none';
        });
    });
</script>
<style>
    .popup {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 999;
    }

    .popup-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
        width: 300px;
    }

    .close-popup {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 20px;
        cursor: pointer;
    }

    .close-popup-button {
        display: block;
        margin-top: 20px;
        background-color: #333;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
</style>