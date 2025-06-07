/*GESTION DU MENU ADMINISTRATEUR*/
/*sildebar*/
function w3_open() {
  document.getElementById("main").style.marginLeft = "10%";
  document.getElementById("mySidebar").style.width = "10%";
  document.getElementById("mySidebar").style.display = "block";
  }
  
  function w3_close() {
    document.getElementById("main").style.marginLeft = "0%";
    document.getElementById("mySidebar").style.display = "none";
  }

////////////////////////////////////////////////////////////////////
/*GESTIONNAIRE DES DISPLAY DES TABLES USSER APPLICATION PLATEAU */
///////////////////////////////////////////////////////////////////
  /*Utlisateur*/
  function openUser() {
    document.getElementById("tableUser").style.display = "block";
    document.getElementById("tableApplication").style.display = "none";
    document.getElementById("tablePlateau").style.display = "none";
  }

  function closeUser() {
    document.getElementById("tableUser").style.display = "none";
  }
  /*Application*/
  function openApplication() {
    document.getElementById("tableApplication").style.display = "block";
    document.getElementById("tableUser").style.display = "none";
    document.getElementById("tablePlateau").style.display = "none";
  }
  function closeApplication() {
    document.getElementById("tableApplication").style.display = "none";
  }
  /*Plateau*/
  function openPlateau() {
    document.getElementById("tablePlateau").style.display = "block";
    document.getElementById("tableUser").style.display = "none";
    document.getElementById("tableApplication").style.display = "none";
  }
  function closePlateau() {
    document.getElementById("tablePlateau").style.display = "none";
  }




