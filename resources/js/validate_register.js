window.onload = function () 
{
  $( document ).ready(function() 
  { 
      $( ".disabled").prop( "disabled",true);
     
      $('#identification_id').keyup(function()
      {
        $( ".disabled").prop( "disabled",true);
        $('#updateduserdata').prop( "disabled",true);
        $("#submitlogin").prop("disabled",true);
        $('#name').val("");
        $('#email').val("");
        $('#deparment_id').val("");
        $('#password').val("");
        $('#password-confirm').val("");
        var _token = $('#_token').val();
        var identification_id=$('#identification_id').val();        
        $.ajax({
          type:'POST',
          url:'user/validateid',
          data : {_token:_token, identification_id:identification_id},
          success:function(data)
          {
            var response=JSON.parse(data);
            if(response.validated==1){
              $('#name').val(response.Nombre);
              $(".disabled").prop("disabled",false );
              $("#updateduserdata").prop("disabled",false); 
              $("#submitlogin").prop("disabled",false);
              $('#identification_id').prop( "disabled",false);
            }
            if(response.validated==2){
              toastr.error('Ya existe un usuario registrado con este numero de identificación');

            }
            // if(response.validated==0){
            //   toastr.error('El numero de identificación no existe');
            // }
            
          }
        }); 
      });
  		$('#register_first_time').submit(function(event){
  			if($('#password').val()!= $('#password-confirm').val()){
  				toastr.error('Las contraseñas no coinciden');
  				return false;
  			}
  		});

      $('#updateduserdata').click(function(e){
         $('#comple_datos').submit();   
      });
	
  });
}
