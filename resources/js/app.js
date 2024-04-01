import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

const channel = Echo.private("user.registered.1"); //se crea un canal para escuchar eventos
console.log(channel);
channel.listen(".user.registered.1", (e) => {
    //para la llamada de eventos se usa el punto y el nombre del evento
    console.log(e.user);
    console.table(e.user);
    alert("User registered");
});

