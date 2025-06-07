var tab;

////////////////////////////////
/*compteur du nombre de tour */

  jQuery('<div class="quantity-nav"><button class="quantity-button quantity-up">&#xf106;</button><button class="quantity-button quantity-down">&#xf107</button></div>').insertAfter('.quantity input');
  jQuery('.quantity').each(function () {
    var spinner = jQuery(this),
        input = spinner.find('input[type="number"]'),
        btnUp = spinner.find('.quantity-up'),
        btnDown = spinner.find('.quantity-down'),
        min = input.attr('min'),
        max = input.attr('max');

    btnUp.click(function () {
      var oldValue = parseFloat(input.val());
      if (oldValue >= max) {
        var newVal = oldValue;
      } else {
        var newVal = oldValue + 1;
      }
      spinner.find("input").val(newVal);
      spinner.find("input").trigger("change");
    });

    btnDown.click(function () {
      var oldValue = parseFloat(input.val());
      if (oldValue <= min) {
        var newVal = oldValue;
      } else {
        var newVal = oldValue - 1;
      }
      spinner.find("input").val(newVal);
      spinner.find("input").trigger("change");
    });

  });

  ///////////////////////////////////////////
  /* gestion du dé numérique annimation  */
  $(document).on("click","#roll",function() {
    const dice = document.querySelector('.dice');
    const diceButton  = document.getElementById('roll');

    const rotate_face = {
        "1" : {"x" : 900, "y" : 900},
        "2" : {"x" : 180, "y" : 720},
        "3" : {"x" : 540, "y" : 630},
        "4" : {"x" : 900, "y" : 1170},
        "5" : {"x" : 1350, "y": 630},
        "6" : {"x" : 810, "y" : 1170},
    };

    const min = 1;
    const max = 6;

    // var res = {
    //   "1" : 0,
    //   "2" : 0,
    //   "3" : 0,
    //   "4" : 0,
    //   "5" : 0,
    //   "6" : 0,
    // };

    // for(var i = 0; i < 1000; i++){
    //   var face = Math.floor(Math.random() * ((max+1)-min)) + min;
    //   res[face]++;
    // }

    // console.log(res);
    // return;

    diceButton.onclick = function() {
      //gestion de l'affichage des buttons en None et de block pour la div timer 
      document.getElementById('roll').style.display = "none"; 
      document.getElementById('timer').style.display = "block";  
      //annimation du dé 
      var face = Math.floor(Math.random() * ((max+1)-min)) + min;
      dice.style.transform = 'rotateX('+rotate_face[face].x+'deg) rotateY('+rotate_face[face].y+'deg)';
      dice.setAttribute("data-current-face", face);
      //affichage en console de la face visuel 
      //console.log(dice.getAttribute("data-current-face", face));
       
        //fonction qui ce joue à la fin de l'annimation 
        $('.dice').on('transitionend MSTransitionEnd webkitTransitionEnd oTransitionEnd', function(event) {
          var counter = 5;
          var intervalId = null;

          function finish() {
            clearInterval(intervalId);
              var form_data ={ dice : dice.getAttribute("data-current-face", face) };
              $.ajax({
                 type: "POST",
                 data : form_data,
                 dataType: 'json',
                 url : "game/result/",
                })
                .done(function( json ) {
                  $('#slide4').html(json);
                });
              // console.log(form_data);
              swiper_horizontal_2.slideNext();  /////// effectue automatiquement le swiper 
               
          }

          function bip() {
            counter--;
            if(counter == 4) finish();
            else {	
                document.getElementById("timerScore").innerHTML = counter ;
            }	
        }

        function start(){
          intervalId = setInterval(bip, 1000);
        }

        // var swiper_horizontal_2 = new Swiper(".mySwiperHorizontal2", {
        //   spaceBetween: 0,
        //   touchMoveStopPropagation:true,
        //    navigation: {
        //       nextEl: '.mySwiperHorizontal2 .nextH',
        //       prevEl: '.mySwiperHorizontal2 .prevH',
        //   },
        // });

        start();

      });
    };
  });

  ////////////////////////////////////////////
  /////////////Modal des régle des jeux /////
  myModal3 = new bootstrap.Modal($('#exampleModal3'), {
		keyboard: false
	});
  

  $('#ruleModal').click(function() {
    $.ajax({
			method: "GET",
			url: "home/setting/" 
		  })
        .done(function( json ) {
         tab=json;
        var html='';
        var title= '<p class="titleModal">Regulations </p>';
        for(var i=0;i<tab.length;i++) {
					html+='<p class="modaltext">'+tab[i].key+':</p><p class="modalRegulation"> '
                +tab[i].value+'</p>';
				}
				$('#exampleModal3 #exampleModal3Content').html(html);
        $('#exampleModal3 #exampleModal3Title').html(title);
				// exampleModal2Title
				myModal3.show();	
			});
	});

//////////////////////////////////////////
////////////////Modal score /////////////


////////////////Modal score slide3 /////////////
$(document).on("click",".score1Modal",function() {
  $.ajax({
        method: "GET",
        url: "game/get-score/" 
    })
    .done(function(json){
            var title ="Score";
            $('#exampleModal3 #exampleModal3Content').html(json);
            $('#exampleModal3 #exampleModal3Title').html(title);
            myModal3.show();
        })   
});


//////////////////////////////////////////////
/////////////récupération du nombre de joueur 
function numberPlayer(){
   var nomberPlayer = document.getElementById("player").value;
 if(nomberPlayer != 0){
 
  var accordion ="";
  for(var i=1; i<=nomberPlayer; i++){
    var html='<input type="text" id="fname'+[i]+'" name="fname'+[i]+'" value="Joueur '+i+'"><br>';
    accordion +='<p>'+html+'</p>';
  }
  $('#accordionText').html(accordion);
 }else{
   console.log('null');
 }
}

//////////////////////////////////////////////////////////////////////////////////
////gestion et envoi des donné en ajax pour la création de la liste des joueurs de jeu //////////
 $("#play").click(function(e) {
  var form_data = {
    players : $("#accordionText").serializeArray(),
    turns : $('#numberTurn').val(),
  };
   $.ajax({
     type: "POST",
     data : form_data,
     dataType: 'json',
     url : "game/session/",
    })
    .done(function( json ) {
      $('#slide3').html(json);
    });
  /// console.log(form_data);
 });

 //////////////////////////////////////////////////////////////////////////////////
 ////gestion et envoi des donné en ajax pour la création de la boucle des joueurs entre slide 3 et 4 //////////
 $(document).on("click","#bouclePlayer",function() {
  $.ajax({
        method: "POST",
        url: "game/session/"
    })
    .done(function(json){
      $('#slide3').html(json);
      swiper_horizontal_2.slidePrev();
        })   
 });

 //////////////////////////////////////////////////////////////////////////////////
////gestion et envoi des donné en ajax pour la création de la liste des joueurs de  fin de jeu //////////
$(document).on("click","#finishPlay",function() {
  $.ajax({
        method: "POST",
        url: "game/finish/" 
    })
    .done(function(json){
      $('#slide5').html(json);
      swiper_vertical.slideNext();
        })   
});


 //////////////////////////////////////////////////////////////////////////////////
////Renvois le joueur au début du jeu  //////////
$(document).on("click","#rePlay",function() {
 
  window.location.href = 'game/';  
       
});

//////////////////////////capture slide5 pour affichage dans le partage 
// $(function() { 
//   $("#btnSave").click(function() { 
//       html2canvas($("#widget"), {
//           onrendered: function(canvas) {
//               theCanvas = canvas;
//               document.body.appendChild(canvas);

//               canvas.toBlob(function(blob) {
//         saveAs(blob, "Dashboard.png"); 
//       });
//           }
//       });
//   });
// }); 

//  $(document).on("click","#facebook",function(){
//    html2canvas($("#capture"), {
//      onrendered: function(canvas) {
//          theCanvas = canvas;
//          document.body.appendChild(canvas);
//              canvas.toBlob(function(blob) {
//        saveAs(blob, "capture.png"); 
//      });
//          }
//      })
//  });


function takeshot() {
  let div =
      document.getElementById('capture');
  // Use the html2canvas
  // function to take a screenshot
  // and append it
  // to the output div
  html2canvas(div).then(
      function (canvas) {
          document
          .getElementById('output')
          .appendChild(canvas);
      })
}





 

  











 
