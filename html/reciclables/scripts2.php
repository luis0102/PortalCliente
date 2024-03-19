
<!-- Vendors JS -->

<!-- Main JS -->
<script src="../assets/js/main.js"></script>

<!-- Page JS -->
<script src="../assets/js/ui-toasts.js"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<script>
  function obtenerHoraMexico() {
    const fechaHora = new Date();
    const opciones = {
      timeZone: 'America/Mexico_City',
      hour12: false
    };
    const horaMexico = fechaHora.toLocaleTimeString('es-MX', opciones);
    document.getElementById('hora-mexico').textContent = ` ${horaMexico}`;
  }

  // Actualizar cada segundo
  setInterval(obtenerHoraMexico, 1000);
  obtenerHoraMexico(); // Llamar inicialmente
</script>