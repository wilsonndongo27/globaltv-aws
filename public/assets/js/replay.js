$('#updateReplayModal').on('show.bs.modal', function(e) {
    var id = $(e.relatedTarget).data('id');
    var title = $(e.relatedTarget).data('title');
    var description = $(e.relatedTarget).data('description');
    var cover = $(e.relatedTarget).data('cover');
    var video = $(e.relatedTarget).data('video');
    var program = `<option value="`+$(e.relatedTarget).data('programid')+`" selected>`+$(e.relatedTarget).data('program')+`</option>`;
    $(e.currentTarget).find('#replayid').val(id);
    $(e.currentTarget).find('#replaytitle').val(title);
    $(e.currentTarget).find('#replayprogram').append(program);    
    
    const delta = quill.clipboard.convert(description)
    quill.setContents(delta, 'silent')
    $('.post-content-update').val(description);

    $(e.currentTarget).find('#replaydescription').val(description);

    $(e.currentTarget).find('#imagetoupdate').attr('src', cover);
    $(e.currentTarget).find('#videotoupdate').attr('src', video);
});