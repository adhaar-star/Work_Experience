$(document).ready(function () {
//    $('option[value=""]').attr("disabled", "disabled"); //disabled first option to select
    $('#portfolio').change(capacityPlanningProjects);

    function capacityPlanningProjects() {
      var portfolioId = $(this).val();

      window.location.href = '/admin/capacity-planning/' + portfolioId;
    }
    
    $('#search').click(function(){
      var portfolioId = $('#portfolio').val();
      var view = $('#view').val() != null ? '?view='+ $('#view').val() : '?view=';
      var group = $('#group').val() != null ? '&group='+ $('#group').val() : '&group=';
      var category = $('#category').val() != null ? '&category='+ $('#category').val() : '&category=';

      window.location.href = '/admin/capacity-planning/' + portfolioId + view + group + category;
    })
});


