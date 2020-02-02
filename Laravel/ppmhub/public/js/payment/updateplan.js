$(function () {
   $('.update-plan').click(function () {
      newSubId = $(this).attr('date-new-sub');
      oldSubId = $(this).attr('data-subId');
      newSubName = $(this).attr('data-new-sub-name');
      $('input[name="new-subscription"]').val(newSubId);
      $('input[name="subscriptionId"]').val(oldSubId);
      $('.new-subscription').text(newSubName);
      $('#UpdateModal').modal('show');
   })
});
