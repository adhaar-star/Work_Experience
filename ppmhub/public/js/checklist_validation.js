$(function () {
  $("#Projectchecklistform").validate({
    errorElement: 'p',
    rules: {
      'checklist_id': 'required',
      'checklist_name': 'required',
      'checklist_text':
              {
                required: true,
                maxlength: 240
              },
      'checklist_type': 'required',
      'project_id': 'required',
      'phase_id': 'required',
      'task_id': 'required',
      'start_date': 'required',
      'end_date': 'required',
    },
    messages: {
      'checklist_id': 'Please enter checklist id',
      'checklist_name': 'Please enter checklist name',
      'checklist_text': {
        required: 'Please enter checklist text',
        maxlength: 'Please enter checklist text less than 240 character'
      },
      'checklist_type': 'Please select checklist type',
      'project_id': 'Please select project id',
      'phase_id': 'Please select phase id',
      'task_id': 'Please select task id',
      'start_date': 'Please select select start date',
      'end_date': 'Please select task end date',
    },
    submitHandler: function (form) {
      form.submit();
    },
    errorPlacement: function (error, element) {
      $('#emailError').html('');

      if (element.hasClass("select2-hidden-accessible"))
      {
        error.insertAfter(element.next('span.select2'));
      } else
      {
        error.insertAfter(element);
      }

      error.addClass('text-danger');
    }
  });

});

