$(function()
{
    var sabonner = $('#sabonner'),
	aimer_commentaire_application = $('#aimer_commentaire_application'),
	id_commentaire_application = $('#id_commentaire_application').text(),
	id_application = $('#id_application').text(),
	partager = $('.share_whatsapp'),
	id_compte_client = $('#id_compte_client').text();
	
	sabonner.click(function(){
	
	    $.ajax({
		    url : 'sabonner_compte.php',
			type : 'GET',
			data : 'id_compte_client=' + id_compte_client
		});

    })
	
	partager.click(function(){
	
	    $.ajax({
		    url : 'nombre_partager_application.php',
			type : 'GET',
			data : 'id_application=' + id_application
		});

    })
	
	aimer_commentaire_application.click(function(){
	
	    $.ajax({
		    url : 'aimer.php',
			type : 'GET',
			data : 'id_commentaire=' + id_commentaire_application
		});

    })
	
});