function refresh_div1()
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
    var id_commentaire = $('#id_commentaire_application').text();
    var method = 'GET';
    var filename = 'rafraichir_aimer_commentaire_application.php?id_commentaire=' + id_commentaire;

    xhr_object.open(method, filename, true);

    xhr_object.onreadystatechange = 

    function()
    {
        if(xhr_object.readyState == 4)
        {
            var tmp = xhr_object.responseText;

            document.getElementById('rafraichir_aimer_commentaire_application').innerHTML = tmp;
        }
    }

    xhr_object.send(null);

    setTimeout('refresh_div1()', 1000);
}