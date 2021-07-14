<?php  
        session_start();
        require_once("connexion.php");
        		
        $file = $_GET['file'];
		
		if(! empty($_GET['file']))
		{
		   if(file_exists($_GET['file']) && is_file($_GET['file']))
		   {
		        if(isset($_GET['id_application']))
				{
					$id_application=htmlspecialchars(trim(addslashes($_GET['id_application'])));
						
		            $req="select * from NOMBRE_TELECHARGEMENT where ID_APPLICATION = $id_application ";
                    $rs=mysqli_query($conn,$req) or die(mysqli_error());

                    if($u=mysqli_fetch_assoc($rs))
                    {
                        $req="update NOMBRE_TELECHARGEMENT set NOMBRE_TELECHARGEMENT = NOMBRE_TELECHARGEMENT + 1 where ID_APPLICATION = $id_application ";
                        mysqli_query($conn,$req) or die(mysqli_error());
                    }
                    else
                    {
                        $req="insert into NOMBRE_TELECHARGEMENT(ID_NOMBRE_TELECHARGEMENT,NOMBRE_TELECHARGEMENT,ID_APPLICATION) values ('',1,$id_application)";
                        mysqli_query($conn,$req) or die(mysqli_error());
                    }
				
				}
			    else if(isset($_GET['id_musique']))
			    {
					$id_musique=htmlspecialchars(trim(addslashes($_GET['id_musique'])));
					
		            $req="select * from NOMBRE_TELECHARGEMENT_MUSIQUE where ID_MUSIQUE = $id_musique ";
                    $rs=mysqli_query($conn,$req) or die(mysqli_error());

                    if($u=mysqli_fetch_assoc($rs))
                    {
                        $req="update NOMBRE_TELECHARGEMENT_MUSIQUE set NOMBRE_TELECHARGEMENT_MUSIQUE = NOMBRE_TELECHARGEMENT_MUSIQUE + 1 where ID_MUSIQUE = $id_musique ";
                        mysqli_query($conn,$req) or die(mysqli_error());
                    }
                    else
                    {
                        $req="insert into NOMBRE_TELECHARGEMENT_MUSIQUE(ID_NOMBRE_TELECHARGEMENT_MUSIQUE,NOMBRE_TELECHARGEMENT_MUSIQUE,ID_MUSIQUE) values ('',1,$id_musique)";
                        mysqli_query($conn,$req) or die(mysqli_error());
                    }
				
				}
		   
			header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: '. filesize($file));
            ob_clean();
            flush();
            readfile($file);
			exit;
		    }
			else 
            {
                if(isset($_GET['id_application']))
				{
				    $id_application=htmlspecialchars(trim(addslashes($_GET['id_application'])));
					
				    header("location:application.php?id_application=$id_application&code=0");
				} 
				else if(isset($_GET['id_musique']))
			    {
				    $id_musique=htmlspecialchars(trim(addslashes($_GET['id_musique'])));
					
				    header("location:musique.php?id_musique=$id_musique&code=0");
				}
            }
	    }
?>