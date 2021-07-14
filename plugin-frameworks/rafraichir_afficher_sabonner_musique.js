function refresh_div6()
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
    var id_client = $('#id_client').text();
    var method = 'GET';
    var filename = 'rafraichir_afficher_sabonner_musique.php?id_compte_client=' + id_compte_client + '&id_client=' + id_client ;

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

    setTimeout('refresh_div6()', 1000);
}