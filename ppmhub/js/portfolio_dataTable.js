$(document).ready(function () {
if($(".myalert").is(':visible')){
   $('.myalert').show(0).delay(5000).hide(1000);
}
  var table = $("#DateTablePPMHUB").DataTable({
    processing: true,
    serverSide: true,
    bDestroy: true,
    ajax: {
      url: '/admin/portfolio.datatable',
    },createdRow: function( row, data, dataIndex ) {
        $( row ).find('td:eq(4)').attr('style', 'text-align:center');
        $( row ).find('td:eq(6)').attr('class', 'action-btn');
    },
    columns: [
      {data: 'name', name: 'name'},
      {data: 'port_id', name: 'port_id'},
      {data: 'portfolio_type', name: 'portfolio_type'},
      {data: 'change_by', name: 'change_by'},
      {data: 'buckets', name: 'buckets'},
      {data: 'status', name: 'status'},
      {data: 'action', name: 'action', searchable: false,"orderable": false},
    ]
  });
  table.draw();
   $('#DateTablePPMHUB tbody').on('click', '.deleteportfolio', function () {
    var id = $(this).attr('data-id');
    var _token = $('_token').val();
    var res = confirm('Are you sure you want to delete this portfolio?');
    if (res) {
       $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "DELETE",
        url: '/admin/portfolio/'+id,
        data: {'_token': _token},
        success: function (result) {
                if (result.status == 'msg')
                {
                    $('.message').show(0).delay(5000).hide(1000);
                    $('#msg').html(result.data);
                } else
                {
                    $('.message1').show(0).delay(5000).hide(1000);
                    $('#msg1').html(result.data);
                }
          table.draw();
        }
      });
    }
  });
  $('#DateTablePPMHUB tbody').on('click', '.viewportfolio', function () {
    var id = $(this).attr('data-id');
    var _token = $('_token').val();
    $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "GET",
        url: '/admin/portfolio/view/'+ id,
        data: {'_token': _token},
        success: function (r) {
       $("#table-view-popup").modal("show");
       $("#port_id").html(r.data.port_id);
       $("#span_port_id").html(r.data.port_id);
       $("#port_name").html(r.data.name);
       $("#port_type").html(r.data.portfolio_type.name);
       
       if(r.data.description!= ""){
                $("#port_desc").html(r.data.description);
       }else{
                $("#port_desc").html("No Description Found");
       }       
       if(r.data.planning_unit !== null){
               $("#port_financial_plan").html(r.data.planning_units.name);
       }else{
               $("#port_financial_plan").html("Not Updated");
        }
       if(r.data.capacity_unit !== null){
               $("#port_capacity_unit").html(r.data.capacity_units.name);
       }else{
               $("#port_capacity_unit").html("Not Updated");
        }
        $("#created_on").html(r.data.createdAt);
        $("#changed_on").html(r.data.updatedAt);
        if(r.data.creator.name !== null){
               $("#created_by").html(r.data.creator.name);
        }else{
               $("#created_by").html("Not Updated");
        } 
        if(r.data.updated_by.name !== null){
               $("#changed_by").html(r.data.updator.name);
        }else{
               $("#changed_by").html("Not Updated");
        } 
          $("#status").html(r.data.status);
         $("#popupEdit").attr("href", '/admin/portfolio/'+id+'/edit');
        }
      });
  });
});

