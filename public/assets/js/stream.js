$('#updateStreamModal').on('show.bs.modal', function(e) {
    var id = $(e.relatedTarget).data('id');
    var title = $(e.relatedTarget).data('title');
    var link = $(e.relatedTarget).data('link');
    var description = $(e.relatedTarget).data('description');
    $(e.currentTarget).find('#streamid').val(id);
    $(e.currentTarget).find('#streamtitle').val(title);
    $(e.currentTarget).find('#streamlink').val(link);
    
    const delta = quill.clipboard.convert(description)
    quill.setContents(delta, 'silent')
    $('.post-content-update').val(description);

    $(e.currentTarget).find('#streamdescription').val(description);
});