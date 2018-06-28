function slugify(text)
{
	return text.toString().toLowerCase()
	.replace(/\s+/g, '-')           // Replace spaces with -
	.replace(/[^\w\-]+/g, '')       // Remove all non-word chars
	.replace(/\-\-+/g, '-')         // Replace multiple - with single -
	.replace(/^-+/, '')             // Trim - from start of text
	.replace(/-+$/, '');            // Trim - from end of text
}

function show_delete_popup(id, text)
{
	var url_category = $('#url-category').val();
	$('.popup-delete').fadeIn(300);
	$('.popup-delete .box-body p').text('Are you sure want to delete ' + text + '?');
	$('.popup-delete .box-body a.btn-danger').attr('href', url_category + '/delete/?id=' + id);
}

$(function () {
    $('.table-data-features-custom').DataTable();
    $('.select2').select2();

    var startweek = $('#start_day_week').val();
    var endweek = $('#end_day_week').val();

    if (startweek != '' && endweek != '') {
        set_first_chart(startweek, endweek);
    }

    // HIGHCHART JS
    /*Highcharts.chart('container-chart', {

        chart: {
            type: 'line'
        },
        title: {
            text: 'Payment Statistic Chart'
        },
        subtitle: {
            text: 'Periode: July 2018'
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'Total (USD)'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
            }
        },
        series: [{
            name: 'Sales Growth',
            data: [7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
        }]

    });
*/
    // READFILE
    var readFile = function (input, destination) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	            $(destination).attr('src', e.target.result);
	        }
	        reader.readAsDataURL(input.files[0]);
	    }
	}

    $('#upload-category-picture').change(function () {
        readFile(this, '#category-picture');
    });

    $('#category-name').blur(function(){
        $('#category-slug').val(slugify($(this).val()));
    });

    $('#subcategory-name').blur(function(){
        $('#subcategory-slug').val(slugify($(this).val()));
    });

    $('#product-name').blur(function(){
        $('#product-slug').val(slugify($(this).val()));
    });

    $('#voucher-name').blur(function(){
        $('#voucher-slug').val(slugify($(this).val()));
    });

    $('#feature-name').blur(function(){
        $('#feature-slug').val(slugify($(this).val()));
    });

    $('#roles-name').blur(function(){
        $('#roles-slug').val(slugify($(this).val()));
    });

    $('.cancel-delete-category').click(function(){
    	$('.popup-delete').fadeOut(300);
    });

    $('.datepicker-date').datepicker({
		autoclose: true,
		format: 'yyyy-mm-dd',
		todayHighlight: true,
    })

    $('#period-range').daterangepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        todayHighlight: true,
    })

    $('#period-range').on('apply.daterangepicker', function(ev, picker) {
        // set_chart('\''+picker.startDate.format('YYYY-MM-DD')+'\'', '\''+picker.endDate.format('YYYY-MM-DD')+'\'');
        set_chart(picker.startDate.format('YYYY-MM-DD'), picker.endDate.format('YYYY-MM-DD'));
        // console.log(picker.startDate.format('YYYY-MM-DD'));
        // console.log(picker.endDate.format('YYYY-MM-DD'));
    });
});