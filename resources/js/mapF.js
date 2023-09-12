function initMap() {
    // Coordenadas del centro del mapa
    var center = { lat: 40.7128, lng: -74.0060 }; // Por ejemplo, Nueva York
  
    // Opciones del mapa
    var mapOptions = {
      zoom: 10, // Nivel de zoom
      center: center // Coordenadas del centro del mapa
    };
  
    // Crea el mapa
    var map = new google.maps.Map(document.getElementById('map'), mapOptions);
  }

  export default initMap;