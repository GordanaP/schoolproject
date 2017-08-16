$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).on('click', '#editPassword', function() {

    var id = $(this).data('id');
    var url = '../profiles/' + id +'/edit';
    var dob = $(this).data('dob');

    $('#updatePassword').val(id);

    $.ajax({
        url: url,
        type: 'GET',
    })
    .done(function(data) {
        $('#first_name').val(data.first_name);
        $('#last_name').val(data.last_name);
        $('#dob').val(dob);
    });
});

$(document).on('click', '#updatePassword', function(){
    var id = $(this).val();
    var url = '../password/' + id;

    var first_name = $('#first_name').val();
    var last_name = $('#last_name').val();
    var dob = $('#dob').val();

    $.ajax({
        url: url,
        type: 'PATCH',
        data: {
            first_name: first_name,
            last_name: last_name,
            dob: dob
        }
    })
    .done(function(data) {
        console.log(data.message);
        _successMessage(data);
    })
});

function _successMessage(data)
{
    $('.alert__flash-message').empty();

    $('.alert__flash').show().fadeOut(4000);
    $('.alert__flash-message').append(data.message);


}