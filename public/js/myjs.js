$('#num_card').on('change', function () {
    var donnee =  $(this).val();
    var inputF = document.getElementById("segment");
    var id = document.getElementById("idsegment");

    var token = $(this).data('token');

    var base_url = $(this).data('url');

    $.ajax({
        url:base_url+'/'+donnee,
        type: 'POST',
        data: { _token :token, donnee_id:donnee},
        success:function(msg){
            inputF.value='';
            id.value='';

            for (let index = 8; index < msg.length; index++) {
                id.value = msg[index];
            }


            for (let index = 0; index < 8; index++) {
                inputF.value += msg[index];
            }
            console.log(id);
         }
     });

})
