$('#updateInterviewModal').on('show.bs.modal', function(e) {
    var id = $(e.relatedTarget).data('id');
    var title = $(e.relatedTarget).data('title');
    var label = $(e.relatedTarget).data('label');
    var description = $(e.relatedTarget).data('description');
    var cover = $(e.relatedTarget).data('cover');
    var video = $(e.relatedTarget).data('video');
    if($(e.relatedTarget).data('priority') == 0){
        var priorityname = 'Priorité par défault'
    }else if($(e.relatedTarget).data('priority') == 1){
        var priorityname = 'Faible'
    }else if($(e.relatedTarget).data('priority') == 2){
        var priorityname = 'Moyenne'
    }else if($(e.relatedTarget).data('priority') == 3){
        var priorityname = 'Haute'
    }
    var country = `<option value="`+$(e.relatedTarget).data('countryid')+`" selected>`+$(e.relatedTarget).data('country')+`</option>`;
    var category = `<option value="`+$(e.relatedTarget).data('categoryid')+`" selected>`+$(e.relatedTarget).data('category')+`</option>`;
    var priority = `<option value="`+$(e.relatedTarget).data('priority')+`" selected>`+priorityname+`</option>`;
    var program = `<option value="`+$(e.relatedTarget).data('programid')+`" selected>`+$(e.relatedTarget).data('program')+`</option>`;
    $(e.currentTarget).find('#interviewid').val(id);
    $(e.currentTarget).find('#interviewtitle').val(title);
    $(e.currentTarget).find('#interviewlabel').val(label);
    $(e.currentTarget).find('#interviewcountry').append(country);    
    $(e.currentTarget).find('#interviewcategory').append(category);
    $(e.currentTarget).find('#interviewpriority').append(priority);
    $(e.currentTarget).find('#interviewprogram').append(program);
    
    const delta = quill.clipboard.convert(description)
    quill.setContents(delta, 'silent')
    $('.post-content-update').val(description);

    $(e.currentTarget).find('#interviewdescription').val(description);

    $(e.currentTarget).find('#imagetoupdate').attr('src', cover);
    $(e.currentTarget).find('#videotoupdate').attr('src', video);
});