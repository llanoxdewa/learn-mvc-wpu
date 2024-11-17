
// input field for mahaissw modal form
const inputName       = $('#name');
const inputNim        = $('#nim');
const inputAge        = $('#age');
const inputEmail      = $('#email');
const majorOptions    = $('#major-options option');
const mahasiswaForm   = $('#mahasiswa-form');
const defaultOptions  = $('#default-options');
const BASE_URL        = 'http://localhost:5000';

function fillModalFormMahasiswaInputField(data,id){
  inputName.val(data.name);
  inputAge.val(data.age);
  inputEmail.val(data.email);
  inputNim.val(data.nim);

  defaultOptions.removeAttr('selected'); 
  for(const option of majorOptions){
    if($(option).val() === data.major)
      $(option).attr('selected',true);
  }

  mahasiswaForm.attr('action',BASE_URL + '/mahasiswa/update/' + id);
}


$('#add-btn').click(function(){
  mahasiswaForm.attr('action',BASE_URL + '/mahasiswa/add');
});


// rederecnt user to mahasiswa detail
$('.list-group-item').click(function(e){
    const id = $(e.currentTarget).data('id');

    window.location.href = '/mahasiswa/detail/' + id;
});

$('.list-group-item .btn.update').click(function(e){
  e.stopPropagation(); 
  const id = $(this.parentElement).data('id');

  $.ajax({
    url: 'http://localhost:5000/mahasiswa/fetch?id=' + id,
    method: 'GET',
    dataType: 'json',
    success(data){
      fillModalFormMahasiswaInputField(data,id); 
    },
    error(xhr,status,error){
      console.error(status + ': fetch id = ' + id + ' gagal!!');
      console.error(error);
    }
  });
  


  //window.location.href = '/mahasiswa/update/' + id;
});


$('.list-group-item .btn.delete').click(function(e){
  e.stopPropagation(); 
  const id = $(this.parentElement).data('id');
  window.location.href = '/mahasiswa/delete/' + id;
});



//$('#submit-btn').click(function(){
  //console.log('submiting form...');
  //mahasiswaForm.submit();
//});



