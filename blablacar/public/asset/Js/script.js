var etapeSum = 0;

function initMap() {
    const directionsService = new google.maps.DirectionsService();
    const directionsRenderer = new google.maps.DirectionsRenderer();
    const map = new google.maps.Map(document.getElementById("carte"), {
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
   
         var coordo=response.routes[0].legs[0].steps;

         var distance = response.routes[0].legs[0].distance.value;
         var distanceInter = distance/1000; 
         var distanceRound = distanceInter.toFixed(0);
         var prixTrajet = (distance/100) * 0.008;
         var prixTrajetFinal = prixTrajet.toFixed(0);
         var minPrix = parseInt(prixTrajetFinal) - 20;
         var maxPrix = parseInt(prixTrajetFinal) + 20;
          document.getElementById("trajet_distanceTrajet").value = parseInt(distanceRound);
          document.getElementById("trajet_prixTrajet").max = maxPrix;
          document.getElementById("trajet_prixTrajet").min = minPrix;
          document.getElementById("trajet_prixTrajet").setAttribute('value',prixTrajetFinal);
          test89();

        
         for(var x=0;x<coordo.length;x++){
           var test0 = response.routes[0].legs[0].steps[x].start_location.lat();
           var test1 = response.routes[0].legs[0].steps[x].start_location.lng();
          
           var EtapeTime = response.routes[0].legs[0].steps[x].duration.value;
           EtapeTime = parseInt(EtapeTime);
           etapeSum = parseInt(etapeSum);
           etapeSum = etapeSum + EtapeTime; 
           if(coordo.length-1 == x){
          document.getElementById("trajet_coordonnees").value += test0+','+test1+','+etapeSum;
           }else{
           document.getElementById("trajet_coordonnees").value += test0+','+test1+','+etapeSum+'/';
         }
        }
      })
      .catch((e) => window.alert("Directions request failed due to " + status));
  }
  /*
  $('#avatar').click(function(){
     $("#file").trigger('click');
  })*/
  
  // var a= setTimeout(showAlert, 2000);
  
  
  
  
  function showAlert(){
      alert(" Vous venez de réserver votre voyage avec $carpooler! Contactez le au $contact");
  }

  
function test89(){
  var prixTrajetMax = document.getElementById('trajet_prixTrajet').max;
  var prixTrajetMin = document.getElementById('trajet_prixTrajet').min;
  $( document ).ready(function() {
    const allRanges = document.querySelectorAll(".range-wrap");
    allRanges.forEach(wrap => {
      const range = wrap.querySelector(".range");
      const bubble = wrap.querySelector(".bubble");
    
      range.addEventListener("input", () => {
        setBubble(range, bubble);
      });
      setBubble(range, bubble);
    });
    
    function setBubble(range, bubble) {
      const val = range.value;
      const min = range.min ? range.min : prixTrajetMin;
      const max = range.max ? range.max : prixTrajetMax;
      const newVal = Number(((val - min) * 100) / (max - min));
      if(val>prixTrajetMax-12){
        bubble.style['background'] = 'orange';}
      if(val>prixTrajetMax-8){
        bubble.style['background'] = 'red';}
      if(val<prixTrajetMax-12){
        bubble.style['background'] = 'green';}

      bubble.innerHTML = val+" €";
    
      // Sorta magic numbers based on size of the native UI thumb
      bubble.style.left = `calc(${newVal}% + (${8 - newVal * 0.15}px))`;
    }
});
}
