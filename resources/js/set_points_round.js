window.onload = function () 
{
	$( document ).ready(function() 
	{

		$( "#round_id").change(function(e) 
		{
			setPoints();
		});
		$( "#user_opcion").change(function(e) 
		{
			setPoints();
		});
		$('#savethepoints').click(function(e){
			var round_id=$('#round_id').val();
			var politic_id=$('#politic_id').val();
			var points=$('#points').val();
			var user_opcion=$('#user_opcion').val();			
			var _token = $('#_token').val();       	
			$.ajax({
				type:'POST',
				url:'savepoints',
				data : {_token:_token, round_id:round_id,politic_id:politic_id,points:points,user_opcion:user_opcion},
				success:function(data)
				{
					var response=JSON.parse(data);
					toastr.success('Puntos actualizados');
				}
			});	
		})

		function setPoints()
		{
			var round_id=$('#round_id').val();
			var politic_id=$('#politic_id').val();
			var user_opcion=$('#user_opcion').val();
			$('#points').val('');
			if(round_id!="" && user_opcion!="")
			{
				var _token = $('#_token').val();       	
				$.ajax({
					type:'POST',
					url:'getpoints',
					data : {_token:_token, round_id:round_id,politic_id:politic_id,user_opcion:user_opcion},
					success:function(data)
					{
						var response=JSON.parse(data);
						if(response.points!=""){
							$('#points').val(response.points);
						}else{
							toastr.error('No se han asignado puntos para esta ronda');
						}
					}
				});	
			}else
			{
				toastr.error('Seleccione la opcion y la ronda');
			}

		}
		
	});
	
}
