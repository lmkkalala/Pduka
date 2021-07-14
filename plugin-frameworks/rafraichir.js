function refresh_div5()
{
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
    var id_compte_client = $('#id_compte_client').text();
    var id_musique = $('#id_musique').text();
    var method = 'GET';
    var filename = 'rafraichir.php?id_compte_client=' + id_compte_client + '&id_musique=' + id_musique;

    xhr_object.open(method, filename, true);

    xhr_object.onreadystatechange = 

    function()
    {
        if (xhr_object.readyState == 4 && xhr_object.status == 200)
        {
            var data = JSON.parse(xhr_object.responseText);

            var aime = data.aime;
            var aimer_musique = data.aimer_musique;

            
            document.getElementById('rafraichir_afficher_aimer_musique').innerHTML = aime;
            document.getElementById('rafraichir_aimer_musique').innerHTML = aimer_musique;
        }
    }

    xhr_object.send(null);

    setTimeout('refresh_div5()', 1000);
}