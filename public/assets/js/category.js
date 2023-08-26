$('#updateCategoryModal').on('show.bs.modal', function(e) {
    var id = $(e.relatedTarget).data('id');
    var title = $(e.relatedTarget).data('title');
    var description = $(e.relatedTarget).data('description');
    $(e.currentTarget).find('#categoryid').val(id);
    $(e.currentTarget).find('#categorytitle').val(title);
    
    const delta = quill.clipboard.convert(description)
    quill.setContents(delta, 'silent')
    $('.post-content-update').val(description);

    $(e.currentTarget).find('#categorydescription').val(description);
});