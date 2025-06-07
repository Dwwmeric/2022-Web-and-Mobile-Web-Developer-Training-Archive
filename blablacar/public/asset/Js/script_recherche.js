function initMap() {

    
 /* const center = { lat: 50.064192, lng: -130.605469 };
  // Create a bounding box with sides ~10km away from the center point
  const defaultBounds = {
      north: center.lat + 0.1,
      south: center.lat - 0.1,
      east: center.lng + 0.1,
      west: center.lng - 0.1,
  };
  const input = document.getElementById("trajet_idVilleDepart");
  const options = {
      bounds: defaultBounds,
      componentRestrictions: { country: "us" },
      fields: ["address_components", "geometry", "icon", "name"],
      strictBounds: false,
      types: ["establishment"],
  };
  const autocomplete = new google.maps.places.Autocomplete(input, options);
*/

    const directionsService = new google.maps.DirectionsService();
    const directionsRenderer = new google.maps.DirectionsRenderer();
    const map = new google.maps.Map(document.getElementById("carte_recherche"), {
      zoom: 7,
      center: { lat: 46.46, lng: -0.79 },
    });
  
    directionsRenderer.setMap(map);
  
    const onChangeHandler = function () {
      if (document.getElementById("trajet_idVilleDepart").value!=''&& document.getElementById("trajet_idVilleRetour").value!='') calculateAndDisplayRoute(directionsService, directionsRenderer);
    };
  
    document.getElementById("trajet_idVilleDepart").addEventListener("change", onChangeHandler);
    document.getElementById("trajet_idVilleRetour").addEventListener("change", onChangeHandler);
  }
  
  function calculateAndDisplayRoute(directionsService, directionsRenderer) {
    directionsService
      .route({
        origin: {
          query: document.getElementById("trajet_idVilleDepart").value,
        },
        destination: {
          query: document.getElementById("trajet_idVilleRetour").value,
        },
        travelMode: google.maps.TravelMode.DRIVING,
      })
      .then((response) => {
        directionsRenderer.setDirections(response);

        var departLat = response.routes[0].legs[0].start_location.lat();
        var departLon = response.routes[0].legs[0].start_location.lng();
        var ArriverLat = response.routes[0].legs[0].end_location.lat();
        var ArriverLon = response.routes[0].legs[0].end_location.lng();
        var distance = response.routes[0].legs[0].distance.value;
        var duration = response.routes[0].legs[0].duration.value;

          document.getElementById('distance').value = distance;
          document.getElementById("duration").value = duration;
          document.getElementById("depart_recherche").value += departLat+','+departLon;
          document.getElementById("arriver_recherche").value += ArriverLat+','+ArriverLon;
      })
      .catch((e) => window.alert("Directions request failed due to " + status));
  }
  /*
  $('#avatar').click(function(){
     $("#file").trigger('click');
  })*/
  
  
  function showAlert(){
      alert(" Vous venez de réserver votre voyage avec $carpooler! Contactez le au $contact");
  }

  