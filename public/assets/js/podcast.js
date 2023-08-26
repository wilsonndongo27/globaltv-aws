$('#updatePodcastModal').on('show.bs.modal', function(e) {
    var id = $(e.relatedTarget).data('id');
    var title = $(e.relatedTarget).data('title');
    var label = $(e.relatedTarget).data('label');
    var description = $(e.relatedTarget).data('description');
    var cover = $(e.relatedTarget).data('cover');
    var audio = $(e.relatedTarget).data('audio');
    var program = `<option value="`+$(e.relatedTarget).data('programid')+`" selected>`+$(e.relatedTarget).data('program')+`</option>`;
    $(e.currentTarget).find('#podcastid').val(id);
    $(e.currentTarget).find('#podcasttitle').val(title);
    $(e.currentTarget).find('#podcastlabel').val(label);
    $(e.currentTarget).find('#podcastprogram').append(program);    
    
    const delta = quill.clipboard.convert(description)
    quill.setContents(delta, 'silent')
    $('.post-content-update').val(description);

    $(e.currentTarget).find('#podcastdescription').val(description);

    $(e.currentTarget).find('#imagetoupdate').attr('src', cover);
    $(e.currentTarget).find('#audiotoupdate').attr('src', audio);
});

$('#SponsoringModal').on('show.bs.modal', function(e) {
    var id = $(e.relatedTarget).data('id');
    $(e.currentTarget).find('#podcastsponsoringid').val(id);  
});