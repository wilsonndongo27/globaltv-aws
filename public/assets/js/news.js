$('#updateNewsModal').on('show.bs.modal', function(e) {
    var id = $(e.relatedTarget).data('id');
    var title = $(e.relatedTarget).data('title');
    var label = $(e.relatedTarget).data('label');
    var description = $(e.relatedTarget).data('description');
    var cover = $(e.relatedTarget).data('cover');
    var video = $(e.relatedTarget).data('video');
    var country = `<option value="`+$(e.relatedTarget).data('countryid')+`" selected>`+$(e.relatedTarget).data('country')+`</option>`;
    var category = `<option value="`+$(e.relatedTarget).data('categoryid')+`" selected>`+$(e.relatedTarget).data('category')+`</option>`;
    $(e.currentTarget).find('#newsid').val(id);
    $(e.currentTarget).find('#newstitle').val(title);
    $(e.currentTarget).find('#newslabel').val(label);
    $(e.currentTarget).find('#newscountry').append(country);    
    $(e.currentTarget).find('#newscategory').append(category);
    
    const delta = quill.clipboard.convert(description)
    quill.setContents(delta, 'silent')
    $('.post-content-update').val(description);

    $(e.currentTarget).find('#newsdescription').val(description);

    $(e.currentTarget).find('#imagetoupdate').attr('src', cover);
    $(e.currentTarget).find('#videotoupdate').attr('src', video);
});