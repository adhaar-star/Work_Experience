$(document).ready(function () {
  var table = $("#DateTablePPMHUB").DataTable({
    processing: true,
    serverSide: true,
    ajax: $("#DateTablePPMHUB").attr('data-url'),
    columns: [
      {data: 'id', name: 'id'},
      {data: 'portfolio', name: 'portfolio'},
      {data: 'bucket', name: 'bucket'},
      {data: 'view', name: 'view'},
      {data: 'group', name: 'group'},
      {data: 'category', name: 'category'},
      {data: 'hours_day', name: 'hours_day'},
      {data: 'created_at', name: 'created_at'},
      {data: 'action', name: 'action', orderable: false}
    ]
  });
  table.draw();

  $('#DateTablePPMHUB tbody').on('click', '.deleteManualCapacity', function () {
    var id = $(this).attr('data-id');
    var _token = $('_token').val();
    var res = confirm('Are you sure you want to delete this Manual Capacity data?');
    console.log($(this).attr('data-url-delete'));
    if (res) {
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "DELETE",
        url: $(this).attr('data-url-delete'),
        data: {'_token': _token},
        success: function (result) {
          if (result.status) {
              $('.message').show(0).delay(5000).hide(1000);
              $('#msg').html(result.data);
          }
          table.draw();
        }
      });
    }
  });
});