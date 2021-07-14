<?php

    if(isset ($_GET['code']))
	{ 
		if(($_GET['code'])==1)
		{
		    echo '
	        <script>			
			swal.fire({
			text: " Cet Email n\'est pas réconnu !",
			icon: "error",
			showConfirmButton: false,
			timer: 2000,
			});
	        </script>
			';
	    }
		else if(($_GET['code'])==2)
		{
		     echo '
	        <script>			
				swal.fire({
				text: " Le mot de passe est incorrect !",
				icon: "error",
				showConfirmButton: false,
				timer: 2000,
				});
	        </script>
			';
		}  
		else if(($_GET['code'])==3)
		{
		     echo '
	        <script>			
				swal.fire({
				text: " Ce type de fichier n\'est pas supporté !",
				icon: "error",
				showConfirmButton: false,
				timer: 2000,
				});
	        </script>
			';
		}
		else if(($_GET['code'])==4)
		{
		    echo '
	        <script>			
				swal.fire({
				text: " Cet Email existe déjà !",
				icon: "error",
				showConfirmButton: false,
				timer: 2000,
				});
	        </script>
			';
	    } 
		else if(($_GET['code'])==5)
		{
		    echo '
	        <script>			
			swal.fire({
			text: " Bien inscrit !",
			icon: "success",
			showConfirmButton: false,
			timer: 2000,
			});
	        </script>
			';
	    } 
		else if(($_GET['code'])==6)
		{
		    echo '
	        <script>			
			swal.fire({
			text: " Bien supprimé !",
			icon: "success",
			showConfirmButton: false,
			timer: 2000,
			});
	        </script>
			';
	    }
	}
?>