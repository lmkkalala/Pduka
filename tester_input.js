$(document).ready(function(){
    var $pass = $('#pass'),
        $cpass = $('#cpass'),
	    $erreur = $('#erreur');
    /*    
    var $erreur_non_valide = $('#erreur_non_valide'),
	    $erreur_valide = $('#erreur_valide');
    */
	
    $pass.keyup(function(){
	
    if($(this).val().length < 4)
	{
	
       $erreur.css('display', 'block');  
		
    }
	else
	{
	   $erreur.css('display', 'none');
	}
	
    });

    /* 

	$cpass.keyup(function(){
        if($cpass.val() == $pass.val()){
            $erreur_valide.css('display', 'block'); 
        }else{
            $erreur_non_valide.css('display', 'block'); 
        }
	})

    */

});