$(document).on('change', '#subject_id', function(){
    var subject_id = $(this).val();
    var user = $('#createEvent').data('user');

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