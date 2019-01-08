jQuery(document).ready(function($) {

    $('#field-date').datepicker("destroy");
    $('#field-date').datepicker({ 
        dateFormat: 'dd/mm/yy',
        maxDate: "0"
    });

    $('select[name="type"]').trigger("chosen:update");
    item_auto_fill();

    // Item field active and disable
    $(document).on('change', 'select[name="type"]', function(){

        $('input[name="item_id"]').val('');
        $('input[name="item"]').val('');

        if($(this).val() != ''){
            $('input[name="item"]').removeAttr('disabled');
        }else{
            $('input[name="item"]').attr('disabled', 'disabled');
        }
    });
});

// Auto complete item field
function item_auto_fill() {
    
    var ids = [];
    
    jQuery('input[name="item"]').typeahead({
        source: function(query, process) {

            $('.loader').show();
            $('input[name="item_id"]').val('');
            
            return jQuery.ajax({
                url: base_url+'transactions/get_item',
                type: 'get',
                data: {name: query, type: $('select[name="type"]').val()},
                dataType: 'json',
                success: function(json) {

                    $('.loader').hide();
                    var data = [];
                    for (var i = 0; i < json.length; i++) {
                        ids[json[i].name] = json[i].id;
                        data.push(json[i].name);
                    }
                    return typeof data == 'undefined' ? false : process(data);
                },error: function(e) {
                    $('.loader').hide();
                }
            });
        },
        updater:function (item) {

            $('input[name="item_id"]').val(ids[item]);
            return item;
        }
    });
}