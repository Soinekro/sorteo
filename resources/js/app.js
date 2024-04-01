import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

const channel = Echo.private("user.registered.1"); //se crea un canal para escuchar eventos
channel.listen(".user.registered.1", (e) => {
    Swal.fire({
        title: "<strong>Nuevo Registro</strong>",
        icon: "info",
        html: `
          ¡Un nuevo usuario fue registrado!<br>
            <b>Nombre:</b> ${e.user.name}<br>
            <b>Número:</b> ${e.user.phone}<br>
            <b>Email:</b> ${e.user.email}<br>
            <b>cantidad de tickets:</b> ${e.user.cantidad}<br>
            <u><a href="solicitudes">Ver Listado</a></u>
        `,
        showCloseButton: false,
        showCancelButton: false,
        focusConfirm: false,
    });
});
