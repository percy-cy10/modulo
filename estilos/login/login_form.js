$('#usuario').on('keyup', function() {
    var re = /([A-Z0-9a-z_-][^@])+?@[^$#<>?]+?\.[\w]{2,4}/.test(this.value);
    if(!re) {
        $('#error').show();
        $('#success').hide();
    } else {
        $('#error').hide();
        $('#success').show();
    }
})