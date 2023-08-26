/********************* enregistrer un administrateur *******************/ 
$(document).on('click','#newuser', function (e) {
    e.preventDefault();
    $('#AddUserModal').modal({backdrop: 'static'});
});

$('#updateUserModal').on('show.bs.modal', function(e) {
    var id = $(e.relatedTarget).data('id');
    var name = $(e.relatedTarget).data('name');
    var phone = $(e.relatedTarget).data('phone');
    var email = $(e.relatedTarget).data('email');
    var address = $(e.relatedTarget).data('address');
    var pp = $(e.relatedTarget).data('pp');
    var country = `<option value="`+$(e.relatedTarget).data('countryid')+`" selected>`+$(e.relatedTarget).data('country')+`</option>`;
    var state = `<option value="`+$(e.relatedTarget).data('stateid')+`" selected>`+$(e.relatedTarget).data('state')+`</option>`;
    var city = `<option value="`+$(e.relatedTarget).data('cityid')+`" selected>`+$(e.relatedTarget).data('city')+`</option>`;
    var typeid = '';
    var typename = '';
    if($(e.relatedTarget).data('type') == 1){
        typeid = 1;
        typename = 'Staff';
    }else if($(e.relatedTarget).data('type') == 2){
        typeid = 2;
        typename = 'Agent';
    }else if($(e.relatedTarget).data('type') == 3){
        typeid = 3
        typename = 'Administrateur'
    }else if($(e.relatedTarget).data('type') == 4){
        typeid = 4
        typename = 'Super Administrateur'
    }else if($(e.relatedTarget).data('type') == 5){
        typeid = 5
        typename = 'Utilisateur API'
    }
    var type = `<option value="`+typeid+`" selected>`+typename+`</option>`;

    $(e.currentTarget).find('#userid').val(id);
    $(e.currentTarget).find('#username').val(name);
    $(e.currentTarget).find('#userphone').val(phone);
    $(e.currentTarget).find('#useremail').val(email);
    $(e.currentTarget).find('#useraddress').val(address);
    $(e.currentTarget).find('.usercountry').append(country);    
    $(e.currentTarget).find('.userstate').append(state);
    $(e.currentTarget).find('.usercity').append(city);
    $(e.currentTarget).find('#usertype').append(type);
    $(e.currentTarget).find('#imagetoupdate').attr('src', pp);
});


/**
* END BLOCK
*/