
		$('.btn_supprimer').on('click',function(){
			
			swal.fire({
				title : 'Vous etes sur ?',
				text: 'annule',
				type: 'question',
				icon: "question",
				showCancelButton: true,
				confirmButtonColor: '#3885d6',
				cancelButtonColor:'#d33',
				confirmButtonText: 'Efface',
			}).then((result)=>{
				if(result.value){
					document.location.href=href;
				}
			})
		})
		//btn_supprimer
		//btn_confirmer
		//btn_aficher
		//btn_reussi
		//btn_validation
		$('.btn_confirmer').on('click',function(){
			
			swal.fire({
				icon: "error",
				type: 'Aide',
				text: 'annule',
				title : 'Vous etes sur ?',
				
		
			})
		})
		$('.btn_aficher').on('click',function(){
			
			swal.fire({
			text: "You clicked the button!",
			buttons: false,
			timer: 3000,
			});
		
		})

		$('.btn_reussi').on('click',function(){
			
			swal.fire({
			title: "Good job!",
			text: "You clicked the button!",
			icon: "success",
			});
		})

		$('.btn_validation').on('click',function(){
			swal.fire({
				title: "Are you sure?",
				text: "Once deleted, you will not be able to recover this imaginary file!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
				})
				.then((willDelete) => {
				if (willDelete) {
					swal("Poof! Your imaginary file has been deleted!", {
					icon: "success",
					});
				} else {
					swal("Your imaginary file is safe!");
				}
				});
  
		})
