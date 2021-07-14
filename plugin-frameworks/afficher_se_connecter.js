
$('.afficher_message').on('click',function(e){
	e.preventDefault();
	swal.fire({
		text: 'Veillez vous connecter/vous inscrire !',
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
	})
});