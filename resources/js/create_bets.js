window.onload = function () {
	$(document).ready(function () {

		$(".savebet").click(function (event) {
			var match_id = $(event.target).closest('table').find('.match_id').val();
			var score_team1_op1 = $(event.target).closest('table').find('.score_team_1_opc1').val();
			var score_team2_op1 = $(event.target).closest('table').find('.score_team_2_opc1').val();
			var score_team1_op2 = $(event.target).closest('table').find('.score_team_1_opc2').val();
			var score_team2_op2 = $(event.target).closest('table').find('.score_team_2_opc2').val();
			if (score_team1_op1 != "" && score_team2_op1 != "" && score_team1_op2 != "" && score_team2_op2 != "") {
				if (validatenumber(score_team1_op1) && validatenumber(score_team2_op1) && validatenumber(score_team1_op2) && validatenumber(score_team2_op2)) {
					var _token = $('#_token').val();
					$.ajax({
						type: 'POST',
						url: 'user_bets/user_bets',
						data: { _token: _token, match_id: match_id, score_team1_op1: score_team1_op1, score_team2_op1: score_team2_op1, score_team1_op2: score_team1_op2, score_team2_op2: score_team2_op2 },
						success: function (data) {
							var response = JSON.parse(data);
							alert(response.message);
							location.reload();
						}
					});
				} else {
					toastr.error('Solo se permiten numeros mayores o iguales a cero');
				}

			} else {
				toastr.error('Por favor ingrese todos los marcadores');
			}

		});
		$("#savebet").click(function (event) {
			var match_id = $('#match_id_modal').val();
			var score_team1_op1 = $('#score_team_1_opc1_modal').val();
			var score_team2_op1 = $('#score_team_2_opc1_modal').val();
			var score_team1_op2 = $('#score_team_1_opc2_modal').val();
			var score_team2_op2 = $('#score_team_2_opc2_modal').val();
			if (score_team1_op1 != "" && score_team2_op1 != "" && score_team1_op2 != "" && score_team2_op2 != "") {
				var _token = $('#_token').val();
				$.ajax({
					type: 'POST',
					url: 'user_bets/user_bets',
					data: { _token: _token, match_id: match_id, score_team1_op1: score_team1_op1, score_team2_op1: score_team2_op1, score_team1_op2: score_team1_op2, score_team2_op2: score_team2_op2 },
					success: function (data) {
						var response = JSON.parse(data);
						alert(response.message);
						location.reload();
					}
				});
			} else {
				toastr.error('Por favor ingrese todos los marcadores');
			}
		});
		$(".showmodal").click(function (event) {
			$('.flagmodal').remove();
			$('#team1_name_modal').empty();
			$('#team2_name_modal').empty();
			$('#match_id_modal').val($(event.target).closest('tr').find('.match_id').val());
			$('#team1_name_modal').append($(event.target).closest('tr').find('.name_team1').val());
			$('#team2_name_modal').append($(event.target).closest('tr').find('.name_team2').val());
			var flag_team1 = $(event.target).closest('tr').find('.flag_team1').val();
			var flag_team2 = $(event.target).closest('tr').find('.flag_team2').val();
			$('#image_team1_modal').append('<img src="' + flag_team1 + '" class="size_flag_near_match flagmodal">');
			$('#image_team2_modal').append('<img src="' + flag_team2 + '" class="size_flag_near_match flagmodal">');
			$('#score_team_1_opc1_modal').val($(event.target).closest('tr').find('.score_team_1_opc1').val());
			$('#score_team_2_opc1_modal').val($(event.target).closest('tr').find('.score_team_2_opc1').val());
			$('#score_team_1_opc2_modal').val($(event.target).closest('tr').find('.score_team_1_opc2').val());
			$('#score_team_2_opc2_modal').val($(event.target).closest('tr').find('.score_team_2_opc2').val());
			$('#myModal').modal('show');
		});

		function validatenumber(number) {
			if (number >= 0) {
				return true;
			}
			else {
				return false;
			}


		}
	});

}
