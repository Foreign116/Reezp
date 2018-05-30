  $(document).ready(function(){
    $('.modal').modal();
  });
          


  function showPassword(){
  	var inputPass = document.getElementById('password');
  	if(inputPass.type=='password'){
  		inputPass.type='text';
  	}
  	else{
  		inputPass.type='password';
  	}
  }


  $('#importButton').click(function(e){
    
    $('#pdf').modal('close');
    $('#movie').modal('close');
    $('#music').modal('close');
    $('#photo').modal('close');
    
    
   

  });

$('input[type="radio"]').prop('checked', false);


  $(document).ready(function(){
    // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();
  });
     

