$(document).ready(function () {
        $('.datepicker-init').datetimepicker({
            format: 'HH:mm',
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            }
        });
        $('.datepicker-init-copy').datetimepicker({
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            }
        });

    $('.datepicker-init').on('dp.change', function() {
        calculate_total_worked_time();
    })

    });
$(window).load(function () {
    calculate_total_worked_time();
});



// code to calculate the total worked time
function calculate_total_worked_time()
{
    var totalh = 0;
    var totalm = 0;
    $('.StTotalTime').each(function () {

        if (($(this).val())) {
            var h = parseInt(($(this).val()).split(':')[0]);
            var m = parseInt(($(this).val()).split(':')[1]);
            totalh += h;
            totalm += m;
        }
    });
    //alert('Total Hour is '+totalh+'Total Minutes is '+totalm);
    totalh += Math.floor(totalm / 60);
    totalm = totalm % 60;

    totalh = totalh < 10 ? '0' + totalh : totalh;
    totalm = totalm < 10 ? '0' + totalm : totalm;

    $('#hours_total').text(totalh + ':' + totalm);
    $('button.disabled').removeAttr('disabled').removeClass('disabled');
}