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

  $(document).ready(function(){
    // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();
  });
     

