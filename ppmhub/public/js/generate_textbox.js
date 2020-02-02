/*
 * This js is generate the textbox as per selection of period-from to period-to in budget management module.
 */
$(document).ready(function () {

    $('#period_from').change(function () {
        $('#dynamic_tb').empty();
        var period_from = $(this).val();
        var period_to = $('#period_to').val();

        if (period_to !== null) {
            var diff = period_to - period_from + 1;
//      var no = diff + 1;
            var no = 0;
            var label = parseInt(period_from) - 1;
            if (diff <= 5) {
                for (var i = 1; i <= diff; i++) {
//        no = no - 1;
                    no = no + 1;
                    label = label + 1;
                    renderTextbox(label, no);
                }
            } else {
                for (var i = 1; i <= 5; i++) {
//        no = no - 1;
                    no = no + 1;
                    label = label + 1;
                }
            }
        }
    });

    $('#period_to').change(function () {
        $('#dynamic_tb').empty();
        var period_to = $(this).val();
        var period_from = $('#period_from').val();

        if (period_from !== null) {
            var diff = period_to - period_from + 1;
            //var no = diff + 1;
            var no = 0;
            var label = parseInt(period_from) - 1;
            if (diff <= 5) {
                for (var i = 1; i <= diff; i++) {
                    //no = no - 1;       
                    no = no + 1;
                    label = label + 1;
                    renderTextbox(label, no);
                }
            } else {
                for (var i = 1; i <= 5; i++) {
//        no = no - 1;
                    no = no + 1;
                    label = label + 1;
                }
            }
        }
    });

    function renderTextbox(label, no) {
        $('<div class="form-group row">' +
                '<label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Year:' + label + '</label>' +
                '<div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">' +
                '<input type="text" class="dynmctb form-control border-radius-0" data-validation="[NOTEMPTY]" value="0"  id="year' + no + '" name="year' + no + '" placeholder="year:' + label + '">' +
                '</div>' +
                '</div>'
                ).appendTo('#dynamic_tb');

        $('#year' + no + '').blur(function () {
            $(this).val($(this).getNum());
        });
    }

    $(document).on("click", "#check", function () {
        var total = 0;
        $("input.dynmctb").each(function () {
            var id = this.id;
            console.log('val', parseInt($('#' + id).val()));
            total += parseInt($('#' + id).val());
        });
        if (isNaN(total)) {
            total = 0;
        }
        var overall = $('#overall').val();
        if (total !== 0) {
            if (overall >= total) {
                $('#myModal').modal('show');
                $('#overerror').html('');
                $('#submit').prop('disabled', false);
            } else {
                if (overall != '' && overall != null) {
                    $('#myModal').modal('hide');
                    $('#overerror').html('Overall Value must be greater than total of all years.');
                    $('#submit').prop('disabled', true);

                }
            }
        } else {

        }
    });

    $(function () {
        $(document).on('keydown', '.dynmctb', function (e) {
            -1 !== $.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) || /65|67|86|88/.test(e.keyCode) && (!0 === e.ctrlKey || !0 === e.metaKey) || 35 <= e.keyCode && 40 >= e.keyCode || (e.shiftKey || 48 > e.keyCode || 57 < e.keyCode) && (96 > e.keyCode || 105 < e.keyCode) && e.preventDefault()
        });
    })

    $(function () {
        $(document).on('keydown', '#overall', function (e) {
            -1 !== $.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) || /65|67|86|88/.test(e.keyCode) && (!0 === e.ctrlKey || !0 === e.metaKey) || 35 <= e.keyCode && 40 >= e.keyCode || (e.shiftKey || 48 > e.keyCode || 57 < e.keyCode) && (96 > e.keyCode || 105 < e.keyCode) && e.preventDefault()
        });
    })


    $(function () {
        $(document).on('keyup', '.dynmctb', function (e) {
            if (this.value.charAt(0) === '0')
                this.value = this.value.slice(1);
            if (this.value === '')
                this.value = '0';
        });
    })

});
