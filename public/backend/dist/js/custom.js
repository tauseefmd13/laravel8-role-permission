var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
elems.forEach(function(html) {
    var switchery = new Switchery(html,  { size: 'small' });
});

$('.js-switch').on('change', function (e) {
    var status = $(this).prop('checked') === true ? 1 : 0;
    var url = $(this).data('url');
    var Id = $(this).data('id');
    $.ajax({
        type: "GET",
        url: url,
        data: {'status': status, 'id': Id},
        dataType: "json",
        success: function (data) {
            toastr.options.closeButton = true;
            toastr.options.closeMethod = 'fadeOut';
            toastr.options.closeDuration = 100;
            toastr.success(data.message);
        }
    });
});

$('.delete-confirmation').on('click', function(event) {
    event.preventDefault();
    var form = $(this).closest("form");

    swal({
        title: "Are you sure to delete?",
        text: "You will not be able to recover this record!",
        icon: "warning",
        buttons: ["No, cancel!", "Yes, delete it!"],
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            form.submit();
        }
    });
});

$('#checkAll').on('click', function(e) {
    if($(this).is(':checked',true))  {
        $(".sub-check").prop('checked', true);  
    } else {  
        $(".sub-check").prop('checked',false);  
    }
});

$('.delete-all').on('click', function(e) {

    var all_ids = [];  
    $(".sub-check:checked").each(function() {  
        all_ids.push($(this).attr('data-id'));
    });  

    if(all_ids.length <= 0)  {
        alert("Please select atleast one row!");  
    }  else { 
        swal({
            title: "Are you sure to delete selected records?",
            text: "You will not be able to recover these records!",
            icon: "warning",
            buttons: ["No, cancel!", "Yes, delete it!"],
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: 'DELETE',
                    url: $(this).data('url'),
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: { ids: all_ids },
                    success: function (data) {
                        toastr.options.closeButton = true;
                        toastr.options.closeMethod = 'fadeOut';
                        toastr.options.closeDuration = 100;
                        toastr.success(data.message);

                        setTimeout(function () {
                            location.reload();
                        }, 5000);
                    },
                    error: function (data) {
                        alert(data.responseText);
                    }
                });
            }
        });          
    }  
});
