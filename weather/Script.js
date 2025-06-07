var id  , options;
var ville;

function init(){
    const input=document.getElementById("gsearch");
    input.onkeydown=logKey;
}
function logKey(e){
    if(e.code=='Enter'){
       ville=document.getElementById("gsearch").value;
       console.log(ville);
       search();
       prev3();
    }
}

function success(pos) {
  
	console.log(pos);
	lat= pos.coords.latitude ;
    lon= pos.coords.longitude;
    search_geo();
    navigator.geolocation.clearWatch(id);
}
function error(err) {
  console.warn('ERROR(' + err.code + '): ' + err.message);
}

options = {
  enableHighAccuracy: false,
  timeout: 5000,
  maximumAge: 0,
};
id = navigator.geolocation.watchPosition(success, error, options);




function search_geo(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
     if (this.readyState == 4 && this.status == 200) {   
         var objJson=JSON.parse(this.responseText);
         var icon0=objJson.weather[0].icon;
         document.getElementById("icon").src="http://openweathermap.org/img/w/"+icon0+".png";
         document.getElementById("ville").innerHTML = objJson.name;
         document.getElementById("temp").innerHTML = objJson.main.temp+"°";
         document.getElementById("description").innerHTML = objJson.weather[0].description;
    }
};
xhttp.open("GET","https://api.openweathermap.org/data/2.5/weather?lat="+lat+"&lon="+lon+"&appid=9d63106b0003583259d7d973d5addfa9&units=metric&lang=fr");
xhttp.send();
prev();
}

function prev(){

var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
 if (this.readyState == 4 && this.status == 200) {
            var objJson=JSON.parse(this.responseText);
             for(i=0;i<=39;i+=6){
             var date= objJson.list[i].dt_txt;
             var temp = objJson.list[i].main.temp+"°";
             var description = objJson.list[i].weather[0].description;
             var icon1="http://openweathermap.org/img/w/"+objJson.list[i].weather[0].icon+".png";

             document.getElementById("Jan").innerHTML+='<tr><td>'+date+'</td><td>'+temp+'</td><td>'+description+'</td><td><img src='+icon1+'></td></tr>';
            
             }
            }

};
xhttp.open("GET","https://api.openweathermap.org/data/2.5/forecast?lat="+lat+"&lon="+lon+"&appid=9d63106b0003583259d7d973d5addfa9&units=metric&lang=fr");
xhttp.send();

}

function search(){
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
     if (this.readyState == 4 && this.status == 200) {   
         var objJson=JSON.parse(this.responseText);
         var icon0=objJson.weather[0].icon;
         document.getElementById("icon").src="http://openweathermap.org/img/w/"+icon0+".png";
         document.getElementById("ville").innerHTML = ville;
         document.getElementById("temp").innerHTML = objJson.main.temp+"°";
         document.getElementById("description").innerHTML = objJson.weather[0].description;
    }
};
xhttp.open("GET","https://api.openweathermap.org/data/2.5/weather?q="+ville+"&appid=9d63106b0003583259d7d973d5addfa9&units=metric&lang=fr");
xhttp.send();
}

    function prev3(){

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
         if (this.readyState == 4 && this.status == 200) { 
             var objJson=JSON.parse(this.responseText);
             document.getElementById("Jan").innerHTML="";
             for(i=0;i<=39;i+=6){
             var date= objJson.list[i].dt_txt;
             var temp = objJson.list[i].main.temp+"°";
             var description = objJson.list[i].weather[0].description;
             var icon1="http://openweathermap.org/img/w/"+objJson.list[i].weather[0].icon+".png";

             document.getElementById("Jan").innerHTML+='<tr><td> '+date+'</td><td>'+temp+'</td><td>'+description+'</td><td><img src='+icon1+'></td></tr>';
            
             }
            }
        };
        xhttp.open("GET","https://api.openweathermap.org/data/2.5/forecast?q="+ville+"&appid=9d63106b0003583259d7d973d5addfa9&units=metric&lang=fr");
        xhttp.send();
        }
