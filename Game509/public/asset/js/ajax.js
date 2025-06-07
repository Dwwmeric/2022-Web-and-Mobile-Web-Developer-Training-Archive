var tab;
var myModal;
var add=true;
var idSquares;

function init() {

	////////////////APPPEL DES FUNCTIONS POUR AFFICHER 
	loadSquares();
	loadSetting();
	loadUser();
	


	///////////requet des validation des formulaires pour init des ouverture des tables 
	if(menu_to_open == "user"){
		openUser();
	} else if(menu_to_open == "squares"){
		openPlateau();
	}else if(menu_to_open == "settings"){
		openApplication();
	}else{}

	/////////////////APPEL DE LA MODAL 
	myModal2 = new bootstrap.Modal($('#exampleModal2'), {
		keyboard: false
	});
	
	///////////////////////////////////
	///////////////////////////ADD USER
	///////////////////////////////////
	$('#btn_add_form_user').click(function() {
		$.ajax({
			method: "POST",
			url: "users/get-form"
			})
			.done(function( json ) {
				$('#exampleModal2 #exampleModal2Content').html(json);
				// exampleModal2Title
				myModal2.show();
			});
	});
	////////////////////////////UPDATE USER
	$(document).on('click', '.btn_upd_form_user', function() {
		var id = $(this).data('id');
		$.ajax({
			method: "GET",
			url: "users/get-form/"+id
			})
			.done(function( json ) {
				$('#exampleModal2 #exampleModal2Content').html(json);
				// exampleModal2Title
				myModal2.show();
			});
	});

	//////////////////////////////////////
	///////////////////////////ADD SETTING
	//////////////////////////////////////
	$('#btn_add_form_setting').click(function() {
		$.ajax({
			method: "GET",
			url: "setting/get-form"
			})
			.done(function( json ) {
				$('#exampleModal2 #exampleModal2Content').html(json);
				// exampleModal2Title
				myModal2.show();
			});
	});
	////////////////////////////UPDATE SETTING
	$(document).on('click', '.btn_upd_form_setting', function() {
		var settingkey = $(this).data('id');
		$.ajax({
			method: "GET",
			url: "setting/get-form/"+settingkey
			})
			.done(function( json ) {
				$('#exampleModal2 #exampleModal2Content').html(json);
				// exampleModal2Title
				myModal2.show();
			});
	});

	//////////////////////////////////////
	///////////////////////////ADD SQUARES
	//////////////////////////////////////
	$('#btn_add_form').click(function() {
		$.ajax({
			method: "GET",
			url: "squares/get-form"
		  })
			.done(function( json ) {
				$('#exampleModal2 #exampleModal2Content').html(json);
				// exampleModal2Title
				myModal2.show();
			});
	});
	////////////////////////////UPDATE SQUARE
	$(document).on('click', '.btn_upd_form_square', function() {
		var id = $(this).data('id');
		$.ajax({
			method: "GET",
			url: "squares/get-form/"+id
		  })
			.done(function( json ) {
				$('#exampleModal2 #exampleModal2Content').html(json);
				// exampleModal2Title
				myModal2.show();
			});
	});

}

////////////////////////////////////////
//////////////////// LISTING DES USERS
///////////////////////////////////////
function loadUser() {
	$.ajax({
	  method: "GET",
	  url: "home/users/",
	})
	  .done(function( json ) {
		  tab=json;
		var html='';
				for(var i=0;i<tab.length;i++) {
					html+='<tr><td>'
                        +tab[i].email+'</td><td>'
                        +tab[i].roles+'</td><td>'
						+'<button class="btn btn-primary btn_upd_form_user" data-id="'+tab[i].id+'">Modifier</button></td><td>'
						+'<button class="btn btn-danger" onclick="deleteUser(\''
                        +tab[i].id+'\')">Supprimer</button></td></tr>';
				}
				$('#datas_users').html(html);
	  });
}

////////////// DELETE UN USER
function deleteUser(id) {
	$.ajax({
	  method: "POST",
	  url: "users/delete/"+id,
	})
	  .done(function( msg ) {
		loadUser();	
	  });
	
}


////////////////////////////////////////
//////////////////// LISTING DES SETTING 
///////////////////////////////////////
function loadSetting() {
	$.ajax({
	  method: "GET",
	  url: "home/setting/",
	})
	  .done(function( json ) {
		  tab=json;
		var html='';
				for(var i=0;i<tab.length;i++) {
					html+='<tr><td>'
                        +tab[i].key+'</td><td>'
                        +tab[i].value+'</td><td>'
						+'<button class="btn btn-primary btn_upd_form_setting" data-id="'+tab[i].key+'">Modifier</button></td><td>'
						+'<button class="btn btn-danger" onclick="deleteSetting(\''
                        +tab[i].key+'\')">Supprimer</button></td></tr>';
				}
				$('#datas_setting').html(html);
	  });
}

////////////// DELETE UNE SETTING
function deleteSetting(settingkey) {
	$.ajax({
	  method: "POST",
	  url: "setting/delete/"+settingkey,
	})
	  .done(function( msg ) {
		loadSetting();	
	  });
	
}

////////////////////////////////////////
//////////////////// LISTING DES SQUARES
////////////////////////////////////////
function loadSquares() {
	$.ajax({
	  method: "GET",
	  url: "home/squares/",
	})
	  .done(function( json ) {
		  tab=json;
		var html='';
				for(var i=0;i<tab.length;i++) {
					html+='<tr><td>'
                        +tab[i].order+'</td><td>'
                        +tab[i].name+'</td><td>'
                        +tab[i].type+'</td><td>'
                        +tab[i].description+'</td><td>'
						+'<button class="btn btn-primary btn_upd_form_square" data-id="'+tab[i].id+'">Modifier</button></td><td>'
						+'<button class="btn btn-danger" onclick="deleteSquares(\''
                        +tab[i].id+'\')">Supprimer</button></td></tr>';
				}
				$('#datas').html(html);
	  });
}

////////////// DELETE UNE SQUARE
function deleteSquares(id) {
	$.ajax({
	  method: "POST",
	  url: "squares/delete/"+id,
	})
	  .done(function( msg ) {
		loadSquares();	
	  });
	
}


