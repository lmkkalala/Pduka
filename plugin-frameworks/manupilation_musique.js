$(function()
{
    var playerTrack = $("#player-track"), 
    bgArtwork = $('#bg-artwork'),
	bgArtworkUrl, 
	albumName = $('#album-name'), 
	trackName = $('#track-name'), 
	albumArt = $('#album-art'), 
	sArea = $('#s-area'), 
	seekBar = $('#seek-bar'), 
	trackTime = $('#track-time'), 
	insTime = $('#ins-time'), 
	sHover = $('#s-hover'), 
	playPauseButton = $("#play-pause-button"),  
	i = playPauseButton.find('i'), 
	tProgress = $('#current-time'), 
	tTime = $('#track-length'),
	seekT, 
	seekLoc, 
	seekBarPos, 
	cM, 
	ctMinutes, 
	ctSeconds, 
	curMinutes, 
	curSeconds, 
	durMinutes, 
	durSeconds, 
	playProgress, 
	bTime, 
	nTime = 0, 
	buffInterval = null, 
	tFlag = false, 
	albums = '',
	trackNames = '', 
	albumArtworks = '', 
	trackUrl = '', 
	playPreviousTrackButton = $('#play-previous'), 
	playNextTrackButton = $('#play-next'), 
	currIndex = -1,
    current_id_musique = $('#current_id_musique'),
	aime_musique = $('#aime'),
	sabonner = $('#sabonner'),
	partager = $('#lien_text'),
	aimer_commentaire_musique = $('#aimer_commentaire_musique'),
	pas_aimer_commentaire_musique = $('#pas_aimer_commentaire_musique'),
	id_compte_client = $('#id_compte_client').text(),
	id_categorie_client = $('#id_categorie_client').text(),
	musique = $('#musique').text(),
	id_commentaire_musique = $('#id_commentaire_musique').text(),
	id_client = $('#id_client').text(),
	id_musique = $('#id_musique').text();

    var sal = 0;
	
	albumArtworks = $('#nombre_next').text().split('%%');
	
    albums = $('#titre_musique_de_plus').text().split('%%');
    id_musiques = $('#id_musiques').text().split('%%');

	trackUrl = $('#musique_de_plus').text().split('%%');
	trackNames = $('#artiste_et_titre_album_de_plus').text().split('%%');

    //alert(id_musique);
	
	pas_aimer_commentaire_musique.click(function(){
	
	    $.ajax({
		    url : 'pas_aimer_commentaire_musique.php',
			type : 'GET',
			data : 'id_commentaire_musique=' + id_commentaire_musique
		});
    })
	
	aimer_commentaire_musique.click(function(){
	
	    $.ajax({
		    url : 'aimer_commentaire_musique.php',
			type : 'GET',
			data : 'id_commentaire_musique=' + id_commentaire_musique
		});
    })
	
	aime_musique.click(function(){
	
	    $.ajax({
		    url : 'aimer_musique.php',
			type : 'GET',
			data : 'id_musique=' + ID_MUSIQUE
		});

    })
	
	sabonner.click(function(){
	
	    $.ajax({
		    url : 'sabonner_compte.php',
			type : 'GET',
			data : 'id_compte_client=' + ID_COMPTE_CLIENT
		});

    })
	current_id_musique.click(function(){
        document.location.href='chaine_musique.php?id_musique='+ID_MUSIQUE+'&id_compte_client='+ID_COMPTE_CLIENT+'';
    })

	partager.click(function(){
	
	    $.ajax({
		    url : 'nombre_partager_musique.php',
			type : 'GET',
			data : 'id_musique=' + ID_MUSIQUE
		});

    })

    $('.telecharger').on('click',function(e){
        e.preventDefault();

        const href = $(this).attr('href');

        if(ID_CATEGORIE_CLIENT == 3)
        {
            swal.fire({
                text: 'Vous voulez télécharger ?',
                icon: "question",
                showConfirmButton: true,
                showCancelButton: true,
                confirmButtonColor: '#3885d6',
                cancelButtonColor:'#d33',
                confirmButtonText: 'Oui',
                cancelButtonText: 'Non',
            }).then((result)=>{
                if(result.value){
                    document.location.href='telechargement.php?file=Medias/musique/'+ MUSIQUE +'&id_musique='+ ID_MUSIQUE;
                }
            })
       }
       else if(ID_CATEGORIE_CLIENT == 4)
       {
            swal.fire({
                text: 'Cet instrumental est à vendre.\nVous voulez achéter ?',
                icon: "question",
                showConfirmButton: true,
                showCancelButton: true,
                confirmButtonColor: '#3885d6',
                cancelButtonColor:'#d33',
                confirmButtonText: 'Oui',
                cancelButtonText: 'Non',
            }).then((result)=>{
                if(result.value){
                    //document.location.href='acheter.php?id_musique='+ ID_MUSIQUE +'&file=Medias/musique/'+ MUSIQUE +'&niv=2';

if(window.XMLHttpRequest){
                xhr = new XMLHttpRequest();
            }else{
                xhr = new AcriveXObject("Microsoft.XMLHTTP");
            }
            xhr.onreadystatechange = function(){

                if (this.readyState == 4 && this.status == 200) {
                    paymentdata = JSON.parse(this.responseText);
                    console.log(paymentdata);
                    ubpayredirecturl = paymentdata.url;
                    window.location.href = ubpayredirecturl;

    }

}
xhr.open("GET","UserPayment.php?id_musique=" + ID_MUSIQUE+"&status="+"loadInfo",true);
xhr.send();



                }
            })
        }
    })
/*
    $(document).ready(function(){
        document.location.href='musique.php?id_musique='+ ID_MUSIQUE +'&id_compte_client='+ ID_COMPTE_CLIENT ;
    })
*/

    function rafraichir(){
        setTimeout(function(){
            
            var xhr_object = null;

            if(window.XMLHttpRequest)
            {
                // Firefox
                xhr_object = new XMLHttpRequest();
            }
            else
            {
                //Internet Explorer
                xhr_object = new ActiveXObject('Microsoft.XMLHTTP');
            }
            var method = 'GET';
            var filename = 'rafraichir_duree_musique.php?id_musique=' + ID_MUSIQUE;
    
            xhr_object.open(method, filename, true);
    
            xhr_object.onreadystatechange = 
    
            function()
            {
                if(xhr_object.readyState == 4)
                {
                    var tmp = xhr_object.responseText;
    
                    document.getElementById('rafraichir_duree_musique').innerHTML = tmp;
                }
            }
    
            xhr_object.send(null);

        rafraichir();
        }, 1000);
        }
        rafraichir();


        function rafraichir1(){
        setTimeout(function(){
            
            var xhr_object = null;

            if(window.XMLHttpRequest)
            {
                // Firefox
                xhr_object = new XMLHttpRequest();
            }
            else
            {
                //Internet Explorer
                xhr_object = new ActiveXObject('Microsoft.XMLHTTP');
            }
            var method = 'GET';
            var filename = 'rafraichir_aimer_musique.php?id_musique=' + ID_MUSIQUE;
    
            xhr_object.open(method, filename, true);
    
            xhr_object.onreadystatechange = 
    
            function()
            {
                if(xhr_object.readyState == 4)
                {
                    var tmp = xhr_object.responseText;
    
                    document.getElementById('rafraichir_aimer_musique').innerHTML = tmp;
                }
            }
    
            xhr_object.send(null);

        rafraichir1();
        }, 1000);
        }
        rafraichir1();


        function rafraichir2(){
        setTimeout(function(){
            
            var xhr_object = null;

            if(window.XMLHttpRequest)
            {
                // Firefox
                xhr_object = new XMLHttpRequest();
            }
            else
            {
                //Internet Explorer
                xhr_object = new ActiveXObject('Microsoft.XMLHTTP');
            }
            var method = 'GET';
            var filename = 'rafraichir_afficher_aimer_musique.php?id_musique=' + ID_MUSIQUE + '&id_client=' + id_client ;
    
            xhr_object.open(method, filename, true);
    
            xhr_object.onreadystatechange = 
    
            function()
            {
                if(xhr_object.readyState == 4)
                {
                    var tmp = xhr_object.responseText;
    
                    document.getElementById('rafraichir_afficher_aimer_musique').innerHTML = tmp;
                }
            }
    
            xhr_object.send(null);

        rafraichir2();
        }, 1000);
        }
        rafraichir2();


        function rafraichir3(){
        setTimeout(function(){
            
            var xhr_object = null;

            if(window.XMLHttpRequest)
            {
                // Firefox
                xhr_object = new XMLHttpRequest();
            }
            else
            {
                //Internet Explorer
                xhr_object = new ActiveXObject('Microsoft.XMLHTTP');
            }
            var method = 'GET';
            var filename = 'rafraichir_ecouter_musique.php?id_musique=' + ID_MUSIQUE;
    
            xhr_object.open(method, filename, true);
    
            xhr_object.onreadystatechange = 
    
            function()
            {
                if(xhr_object.readyState == 4)
                {
                    var tmp = xhr_object.responseText;
    
                    document.getElementById('rafraichir_ecouter_musique').innerHTML = tmp;
                }
            }
    
            xhr_object.send(null);

        rafraichir3();
        }, 1000);
        }
        rafraichir3();


        function rafraichir4(){
        setTimeout(function(){
            
            var xhr_object = null;

            if(window.XMLHttpRequest)
            {
                // Firefox
                xhr_object = new XMLHttpRequest();
            }
            else
            {
                //Internet Explorer
                xhr_object = new ActiveXObject('Microsoft.XMLHTTP');
            }
            var method = 'GET';
            var filename = 'rafraichir_telecharger_musique.php?id_musique=' + ID_MUSIQUE;
    
            xhr_object.open(method, filename, true);
    
            xhr_object.onreadystatechange = 
    
            function()
            {
                if(xhr_object.readyState == 4)
                {
                    var tmp = xhr_object.responseText;
    
                    document.getElementById('rafraichir_telecharger_musique').innerHTML = tmp;
                }
            }
    
            xhr_object.send(null);

        rafraichir4();
        }, 1000);
        }
        rafraichir4();


        function rafraichir5(){
        setTimeout(function(){
            
            var xhr_object = null;

            if(window.XMLHttpRequest)
            {
                // Firefox
                xhr_object = new XMLHttpRequest();
            }
            else
            {
                //Internet Explorer
                xhr_object = new ActiveXObject('Microsoft.XMLHTTP');
            }
            var method = 'GET';
            var filename = 'rafraichir_sabonner_musique.php?id_compte_client=' + ID_COMPTE_CLIENT;
    
            xhr_object.open(method, filename, true);
    
            xhr_object.onreadystatechange = 
    
            function()
            {
                if(xhr_object.readyState == 4)
                {
                    var tmp = xhr_object.responseText;
    
                    document.getElementById('rafraichir_sabonner_musique').innerHTML = tmp;
                }
            }
    
            xhr_object.send(null);

        rafraichir5();
        }, 1000);
        }
        rafraichir5();


        function rafraichir6(){
        setTimeout(function(){
            
            var xhr_object = null;

            if(window.XMLHttpRequest)
            {
                // Firefox
                xhr_object = new XMLHttpRequest();
            }
            else
            {
                //Internet Explorer
                xhr_object = new ActiveXObject('Microsoft.XMLHTTP');
            }
            var method = 'GET';
            var filename = 'rafraichir_afficher_sabonner_musique.php?id_compte_client=' + ID_COMPTE_CLIENT + '&id_client=' + id_client ;
    
            xhr_object.open(method, filename, true);
    
            xhr_object.onreadystatechange = 
    
            function()
            {
                if(xhr_object.readyState == 4)
                {
                    var tmp = xhr_object.responseText;
    
                    document.getElementById('rafraichir_afficher_sabonner_musique').innerHTML = tmp;
                }
            }
    
            xhr_object.send(null);

        rafraichir6();
        }, 1000);
        }
        rafraichir6();

    function playPause()
    {
        setTimeout(function()
        {
            if(audio.paused)
            {
                playerTrack.addClass('active');
                albumArt.addClass('active');
                checkBuffering();
                i.attr('class','fas fa-pause');
                audio.play();
                /*
				$.ajax({
				    url : 'nombre_ecoute_musique.php',
					type : 'GET',
					data : 'id_musique=' + id_musique
				});
                */
            }
            else
            {
                playerTrack.removeClass('active');
                albumArt.removeClass('active');
                clearInterval(buffInterval);
                albumArt.removeClass('buffering');
                i.attr('class','fas fa-play');
                audio.pause();
            }
        },300);
    }

    	
	function showHover(event)
	{
		seekBarPos = sArea.offset(); 
		seekT = event.clientX - seekBarPos.left;
		seekLoc = audio.duration * (seekT / sArea.outerWidth());
		
		sHover.width(seekT);
		
		cM = seekLoc / 60;
		
		ctMinutes = Math.floor(cM);
		ctSeconds = Math.floor(seekLoc - ctMinutes * 60);
		
		if( (ctMinutes < 0) || (ctSeconds < 0) )
			return;
		
        if( (ctMinutes < 0) || (ctSeconds < 0) )
			return;
		
		if(ctMinutes < 10)
			ctMinutes = '0'+ctMinutes;
		if(ctSeconds < 10)
			ctSeconds = '0'+ctSeconds;
        
        if( isNaN(ctMinutes) || isNaN(ctSeconds) )
            insTime.text('--:--');
        else
		    insTime.text(ctMinutes+':'+ctSeconds);
            
		insTime.css({'left':seekT,'margin-left':'-21px'}).fadeIn(0);
		
	}

    function hideHover()
	{
        sHover.width(0);
        insTime.text('00:00').css({'left':'0px','margin-left':'0px'}).fadeOut(0);		
    }
    
    function playFromClickedPos()
    {
        audio.currentTime = seekLoc;
		seekBar.width(seekT);
		hideHover();
    }

    function updateCurrTime()
	{
        nTime = new Date();
        nTime = nTime.getTime();

        if( !tFlag )
        {
            tFlag = true;
            trackTime.addClass('active');
        }

		curMinutes = Math.floor(audio.currentTime / 60);
		curSeconds = Math.floor(audio.currentTime - curMinutes * 60);
		
		durMinutes = Math.floor(audio.duration / 60);
		durSeconds = Math.floor(audio.duration - durMinutes * 60);
		
		playProgress = (audio.currentTime / audio.duration) * 100;
		
		if(curMinutes < 10)
			curMinutes = '0'+curMinutes;
		if(curSeconds < 10)
			curSeconds = '0'+curSeconds;
		
		if(durMinutes < 10)
			durMinutes = '0'+durMinutes;
		if(durSeconds < 10)
			durSeconds = '0'+durSeconds;
        
        if( isNaN(curMinutes) || isNaN(curSeconds) )
            tProgress.text('00:00');
        else
		    tProgress.text(curMinutes+':'+curSeconds);
        
        if( isNaN(durMinutes) || isNaN(durSeconds) )
            tTime.text('00:00');
        else
		    tTime.text(durMinutes+':'+durSeconds);
        
        if( isNaN(curMinutes) || isNaN(curSeconds) || isNaN(durMinutes) || isNaN(durSeconds) )
            trackTime.removeClass('active');
        else
            trackTime.addClass('active');

        
		seekBar.width(playProgress+'%');

        //alert(parseInt(audio.currentTime));
        
		if( parseInt(audio.currentTime) == 30 )
		{
            if(sal == 0)
            {
                $.ajax({
				    url : 'nombre_ecoute_musique.php',
					type : 'GET',
					data : 'id_musique=' + ID_MUSIQUE
				});
                sal++;
            }

            if(ID_CATEGORIE_CLIENT == 4) 
            {
                audio.pause();

                swal.fire({
                    text: 'Cet instrumental est à vendre.\nVous voulez achéter ?',
                    icon: "question",
                    showConfirmButton: true,
                    showCancelButton: true,
                    confirmButtonColor: '#3885d6',
                    cancelButtonColor:'#d33',
                    confirmButtonText: 'Oui',
                    cancelButtonText: 'Non',
                }).then((result)=>{
                    if(result.value){
                        if(id_client == 0)
                        {
                            swal.fire({
                                text: 'Veillez vous connecter/vous inscrire d\'abord !',
                                icon: "warning",
                                showConfirmButton: true,
                                showCancelButton: true,
                                confirmButtonColor: '#3885d6',
                                cancelButtonColor:'#d33',
                                confirmButtonText: 'Oui',
                                cancelButtonText: 'Non',
                            }).then((result)=>{
                                if(result.value){
                                    document.location.href="index1.php?deconnexion=0";
                                }
                                else
                                {
                                    document.location.href='musique.php?id_musique='+ ID_MUSIQUE;
                                }
                            })
                        }
                        else
                        {
                            document.location.href='acheter.php?id_musique='+ ID_MUSIQUE +'&file=Medias/musique/'+ MUSIQUE +'&niv=2';
                        }
                    
                    }
                    else
                    {
                        document.location.href='musique.php?id_musique='+ ID_MUSIQUE;
                    }
                })
            }
        }
		
		if( playProgress == 100 )
		{

			i.attr('class','fa fa-play');
			seekBar.width(0);
            tProgress.text('00:00');
            albumArt.removeClass('buffering').removeClass('active');
            clearInterval(buffInterval);
           
		}
    }
    
    function checkBuffering()
    {
        clearInterval(buffInterval);
        buffInterval = setInterval(function()
        { 
            if( (nTime == 0) || (bTime - nTime) > 1000  )
                albumArt.addClass('buffering');
            else
                albumArt.removeClass('buffering');

            bTime = new Date();
            bTime = bTime.getTime();

        },100);
    }

    function selectTrack(flag)
    {
        if( flag == 0 || flag == 1 )
            ++currIndex;
        else
            --currIndex;

        if( (currIndex > -1) && (currIndex < albumArtworks.length) )
        {
            if( flag == 0 )
                i.attr('class','fa fa-play');
            else
            {
                albumArt.removeClass('buffering');
                i.attr('class','fa fa-pause');
            }

            seekBar.width(0);
            trackTime.removeClass('active');
            tProgress.text('00:00');
            tTime.text('00:00');

            // id musique courante
            
            currId_musique = id_musiques[currIndex];
            //alert(currId_musique);
            
            //search for logo data and all the others data
            if(window.XMLHttpRequest){
                xhr = new XMLHttpRequest();
            }else{
                xhr = new AcriveXObject("Microsoft.XMLHTTP");
            }
            xhr.onreadystatechange = function(){

                if (this.readyState == 4 && this.status == 200) {
                    var data = JSON.parse(this.responseText);
                    var TITRE_MUSIQUE = data.TITRE_MUSIQUE;
                    var LOGO_MUSIQUE = data.LOGO_MUSIQUE;
                    var TAILLE_MUSIQUE = data.TAILLE_MUSIQUE;

// var x = data.nombre_commentaire;  
//     console.log(data);
//         for (x in data) {
//  	var COMMENTAIRE_MUSIQUE = data.COMMENTAIRE_MUSIQUE[x].COMMENTAIRE_MUSIQUE;
// 	var NOM_CLIENT = data.NOM_CLIENT[x].NOM_CLIENT;
//     var PHOTO_CLIENT = data.PHOTO_CLIENT[x].PHOTO_CLIENT;

// if (PHOTO_CLIENT != '' || PHOTO_CLIENT != null) {
// 	document.getElementById('PHOTO_CLIENT').src = PHOTO_CLIENT;
// }else{
// 	document.getElementById('PHOTO_CLIENT').src;
// } 

// if (NOM_CLIENT != '' || NOM_CLIENT != null) {
// 	document.getElementById('NOM_CLIENT').innerHTML = NOM_CLIENT;
// }else{
// 	document.getElementById('NOM_CLIENT').innerHTML;
// }

// if (COMMENTAIRE_MUSIQUE != '' || COMMENTAIRE_MUSIQUE != null) {
// 	document.getElementById('COMMENTAIRE_MUSIQUE').innerHTML = COMMENTAIRE_MUSIQUE;
// }else{
// 	document.getElementById('COMMENTAIRE_MUSIQUE').innerHTML;
// }
//                 }

                    MUSIQUE = data.MUSIQUE;
                    // var NOMBRE_ECOUTER_MUSIQUE = data.NOMBRE_ECOUTER_MUSIQUE;
                    // var NOMBRE_PARTAGER_MUSIQUE = data.NOMBRE_PARTAGER_MUSIQUE;
                    // var NOMBRE_TELECHAGER_MUSIQUE = data.NOMBRE_TELECHAGER_MUSIQUE;
                    // var NOMBRE_VUES_MUSIQUE = data.NOMBRE_VUES_MUSIQUE;
                    // var NOMBRE_LIKES = data.NOMBRE_LIKES;
                    // var ABONNER_COMPTE = data.ABONNER_COMPTE;

                    ID_MUSIQUE = data.ID_MUSIQUE;
                    var PHOTO_COMPTE_CLIENT = data.PHOTO_COMPTE_CLIENT;
                    var NOM_COMPTE_CLIENT = data.NOM_COMPTE_CLIENT;
                    var nombre_commentaire = data.nombre_commentaire;
                    var PRIX_MUSIQUE = data.PRIX_MUSIQUE;
                    LIEN = data.LIEN;
                    ID_COMPTE_CLIENT = data.ID_COMPTE_CLIENT;
                    ID_CATEGORIE_CLIENT = data.ID_CATEGORIE_CLIENT;
                    NIVEAU_COMPTE_CLIENT = data.NIVEAU_COMPTE_CLIENT; // tester l'activation du bouton telecharger
                    ACTIVER_TELECHARGEMENT = data.ACTIVER_TELECHARGEMENT; // tester l'activation du bouton telecharger
                    LIEN_TEXT = 'https://wa.me/?text=' + LIEN;


                    document.getElementById('id_musique').innerHTML = ID_MUSIQUE;
                    document.getElementById('id_compte_client').innerHTML = ID_COMPTE_CLIENT;
                    document.getElementById('rafraichir_prix_musique').innerHTML = PRIX_MUSIQUE;
                    document.getElementById('lien').innerHTML = LIEN;
                    $('#lien_text').attr('href', LIEN_TEXT);
                    $('#meta_url').attr('content', LIEN);
                    $('#meta_titre').attr('content', TITRE_MUSIQUE);
                    $('#meta_logo').attr('content', LOGO_MUSIQUE);
                    document.getElementById('nombre_commentaire_header').innerHTML = nombre_commentaire;

                    if (NOM_COMPTE_CLIENT != '' || NOM_COMPTE_CLIENT != null) {
                        document.getElementById('NOM_COMPTE_CLIENT').innerHTML = NOM_COMPTE_CLIENT;
                    }else{
                        document.getElementById('NOM_COMPTE_CLIENT').innerHTML;
                    }

                    if (PHOTO_COMPTE_CLIENT != '' || PHOTO_COMPTE_CLIENT != null) {
                        document.getElementById('PHOTO_COMPTE_CLIENT').src = PHOTO_COMPTE_CLIENT;
                    }else{
                        document.getElementById('PHOTO_COMPTE_CLIENT').src;
                    }

                    if (LOGO_MUSIQUE != '' || LOGO_MUSIQUE != null) {
                        document.getElementById('LOGO_MUSIQUE').src = LOGO_MUSIQUE;
                    }else{
                        document.getElementById('LOGO_MUSIQUE').src;
                    }

         
                    document.getElementById('TAILLE_MUSIQUE').innerHTML = TAILLE_MUSIQUE;
                    // document.getElementById('rafraichir_ecouter_musique').innerHTML = NOMBRE_ECOUTER_MUSIQUE;
                    // document.getElementById('rafraichir_telecharger_musique').innerHTML = NOMBRE_TELECHAGER_MUSIQUE;
                    // document.getElementById('rafraichir_partager_musique').innerHTML = NOMBRE_PARTAGER_MUSIQUE;
                    // document.getElementById('rafraichir_aimer_musique').innerHTML = NOMBRE_LIKES;
                    
                }

            }

            xhr.open("GET","loadData.php?id_musique=" + currId_musique,true);
            xhr.send();
            
            currAlbum = albums[currIndex];
            currTrackName = trackNames[currIndex];
            currArtwork = albumArtworks[currIndex];

            audio.src = trackUrl[currIndex];
            
            nTime = 0;
            bTime = new Date();
            bTime = bTime.getTime();

            if(flag != 0)
            {
                audio.play();
                playerTrack.addClass('active');
                albumArt.addClass('active');
            
                clearInterval(buffInterval);
                checkBuffering();
            }

            albumName.text(currAlbum);
            trackName.text(currTrackName);
            albumArt.find('img.active').removeClass('active');
            $('#'+currArtwork).addClass('active');
            
            bgArtworkUrl = $('#'+currArtwork).attr('src');

            bgArtwork.css({'background-image':'url('+bgArtworkUrl+')'});

        }
        else
        {
            if( flag == 0 || flag == 1 )
                --currIndex;
            else
                ++currIndex;
        }
    }
    
    function initPlayer()
	{	
        audio = new Audio();

		selectTrack(0);
		
		audio.loop = false;
		
		playPauseButton.on('click',playPause);
		
		sArea.mousemove(function(event){ showHover(event); });
		
        sArea.mouseout(hideHover);
        
        sArea.on('click',playFromClickedPos);
		
        $(audio).on('timeupdate',updateCurrTime);

        playPreviousTrackButton.on('click',function(){ selectTrack(-1);});
        playNextTrackButton.on('click',function(){ selectTrack(1);});
    }
    
    initPlayer();
    
});