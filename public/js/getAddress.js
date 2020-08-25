var url = "../../../showWard";
    $("#district").change(function(){
    var address = $(this).val();
    var token = $("input[name='_token']").val();
    $.ajax({
    url: url,
    method: 'GET',
    data: {
    address: address,
    _token: token,
},
    success: function(data) {
    $("#ward").html('<option selected="selected" value="">Xã phường</option>');
    $.each(data, function(key, value){
    $("#ward").append(
    "<option  value=" + value.xaid + ">" + value.name + "</option>"
    );
});
}
});
});

    $(document).ready(function () {

    var address =$('#districtPost').val();
    var token = $("input[name='_token']").val();
    $.ajax({
    url: url,
    method: 'GET',
    data: {
    address: address,
    _token: token,
},
    success: function (data) {
    $("#ward").html(
        '<option selected="selected" value="">Xã phường</option>');

    $.each(data, function (key, value) {
    $("#ward").append(
    "<option value=" + value.xaid + ">" + value.name + "</option>"
    );

});
    var ward =$('#wardPost').val();
    $('#ward option[value='+ward+']').attr('selected',true)
}
});
});

