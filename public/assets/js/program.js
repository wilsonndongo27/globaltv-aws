$('#updateProgramModal').on('show.bs.modal', function(e) {
    var id = $(e.relatedTarget).data('id');
    var title = $(e.relatedTarget).data('title');
    var description = $(e.relatedTarget).data('description');
    var date = $(e.relatedTarget).data('date');
    var time_start = $(e.relatedTarget).data('timestart');
    var time_end = $(e.relatedTarget).data('timeend');
    var day = $(e.relatedTarget).data('day');
    var cover = $(e.relatedTarget).data('cover');
    $(e.currentTarget).find('#programid').val(id);
    $(e.currentTarget).find('#programtitle').val(title);
    $(e.currentTarget).find('#programdate').val(date);
    $(e.currentTarget).find('#programtimestart').val(time_start.split('.')[0]);
    $(e.currentTarget).find('#programtimeend').val(time_end.split('.')[0]);
    $(e.currentTarget).find('#programday').text(day);
    
    const delta = quill.clipboard.convert(description)
    quill.setContents(delta, 'silent')
    $('.post-content-update').val(description);

    $(e.currentTarget).find('#programdescription').val(description);
    $(e.currentTarget).find('#imagetoupdate').attr('src', cover);
});