
console.log('hello, from login script');

const password = $('#password');


// change the type of password 
$('#pw-eye').click(function(){
  let type = password.attr('type');
  
  let changeSrc = $(this).attr('src');

  let isHidden = type === 'password';


  if(isHidden)
    changeSrc = changeSrc.replace('open','close');
  else
    changeSrc = changeSrc.replace('close','open');


  password.attr('type',isHidden ? 'text' : 'password');

  $(this).attr('src',changeSrc);


});


