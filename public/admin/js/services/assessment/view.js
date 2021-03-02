$(function () {
    $('.date').datepicker({
        format: 'dd-mm-yyyy',
        todayHighlight: true
    });

    var table = $('#trainees').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        scrollX: true,
        bInfo: false,
        bDestroy: true,
        bLengthChange: false,
        columns:[
            { data: 'student_no'},
            { data: 'name'},
            { data: 'passed', 'className' : 'text-center'},
            { data: 'failed', 'className' : 'text-center'},
            { data: 'incomplete', 'className' : 'text-center'},
        ],
        "aoColumnDefs":[
            {
                "bSortable": false,
                "aTargets": [2,3,4]
            }
        ],
        language: {
            paginate: {
                next: '»',
                previous: '«'
            }
        },
        aaSorting: [[0, 'asc']]
    });
})
