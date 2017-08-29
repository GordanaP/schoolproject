$(document).on('change', '#subject_id', function(){
    var subject_id = $(this).val();
    var user = $('#user').val();

    if(subject_id)
    {
        $.ajax({
            url : '../classrooms/' + subject_id + '/' + user,
            type: 'get',
            success: function(data)
            {
                $('#classroom_id').html(data);
            }
        })
    }
});