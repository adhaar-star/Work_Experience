$(function () {
  $.validator.addMethod("greaterThan",
      function (value, element, param) {
        var $min = $(param);
        if (this.settings.onfocusout) {
          $min.off(".validate-greaterThan").on("blur.validate-greaterThan", function () {
            $(element).valid();
          });
        }
        return parseInt(value) >= parseInt($min.val());
      }, "Max must be greater than min");
  $(".reportClass").validate({
    errorElement: 'p',
    rules: {
      'reportProject_from': 'required',
      'reportProject_to':{
        required : true,
        greaterThan: '#reportProject_from'
      },
      'sales_orderno_from': 'required',
      'sales_orderno_to': {
          required : true,
          greaterThan: '#sales_orderno_from',
          },
      'reportpurchaseorder[]': 'required',
      'invoicereportpurchaseorder': 'required',
    },
    messages: {
      'reportProject_from': 'Please select Project Id from',
      'reportProject_to':{
          required: 'Please select Project Id to',
          greaterThan: 'Project Id To must be greater than Project Id From'
      },
      'sales_orderno_from': 'Please select Sales Order no From',
      'sales_orderno_to': { 
          required : 'Please select Sales Order no To',
          greaterThan : 'Sales Order no To must be greater than Sales Order no From'
          },
      'reportpurchaseorder[]' : 'Please select Purchase Order no',
      'invoicereportpurchaseorder' : 'Please select Purchase Order no',
    },
    submitHandler: function (form) {
      return false;
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