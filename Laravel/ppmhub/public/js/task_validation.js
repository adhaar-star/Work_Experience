$(function () {
  $("#Projecttaskform").validate({
    errorElement: 'p',
    rules: {
      'task_name': {
        required: true,
        minlength: 3,
        maxlength: 14

      },
      'task_type': 'required',
      'project_id': 'required',
      'phase_id': 'required',
      'start_date': 'required',
      'end_date': 'required',
      'status': 'required',
      'weighting_factor': {
        required: true,
        number: true,
        range: [0, 100]

      },
      'completion': {
        required: true,
        range: [0, 100],
        number: true
      }
    },
    messages: {
      'task_name': {
        required: "Please enter task name",
        minlength: 'task name must be more than 4 character',
        maxlength: 'task name must be less than 14 character'
      },
      'weighting_factor': {
        required: 'Please enter weighting factor',
        number: 'please input number Only'

      },
      'completion': {
        required: 'Please enter completion',
        number: 'please input number Only'
      },
      'task_type': 'Please select task type',
      'project_id': 'Please select project id',
      'phase_id': 'Please select phase id',
      'start_date': 'Please select start date',
      'end_date': 'Please select end date',
      'status': 'Please select status'
    },
    submitHandler: function (form) {
      form.submit();
    },
    errorPlacement: function (error, element) {
      $('#emailError').html('');
      if (element.hasClass("select2-hidden-accessible"))
      {
        error.insertAfter(element.next('span.select2'));
      } else if (element.hasClass("start")) {
        $("#start").append(error);
      } else if (element.hasClass("end")) {
        $("#end").append(error);
      } else
      {
        error.insertAfter(element);
      }

      error.addClass('text-danger');
    }
  });
});

