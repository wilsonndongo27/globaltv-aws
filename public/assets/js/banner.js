$('#updateBannerModal').on('show.bs.modal', function(e) {
    var id = $(e.relatedTarget).data('id');
    var title = $(e.relatedTarget).data('title');
    var label = $(e.relatedTarget).data('label');
    var link = $(e.relatedTarget).data('link');
    var description = $(e.relatedTarget).data('description');
    var cover = $(e.relatedTarget).data('cover');
    $(e.currentTarget).find('#bannerid').val(id);
    $(e.currentTarget).find('#bannertitle').val(title);
    $(e.currentTarget).find('#bannerlabel').val(label);
    $(e.currentTarget).find('#bannerlink').val(link);
    
    const delta = quill.clipboard.convert(description)
    quill.setContents(delta, 'silent')
    $('.post-content-update').val(description);

    $(e.currentTarget).find('#bannerdescription').val(description);

    $(e.currentTarget).find('#imagetoupdate').attr('src', cover);
});