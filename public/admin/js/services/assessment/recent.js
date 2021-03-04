$(function () {

    $(document).ready(function() {
        $(".accordion-thumb").click(function() {
            $(this).closest( "li" ).toggleClass("is-active").children(".accordion-panel").slideToggle("ease-out");
        });
    })

    var table = $('#myTable').DataTable({
            responsive: true,
            dom: 'Bfrtip',
            "bInfo": false,
            scrollX: true,
            columns:[
                { data: "class_no" },
                { data: "course" },
                { data: "trainees" , 'className': 'text-right'},
                { data: "assessor" , 'className': 'text-right'},
                { data: "date" },
                { data: "grade" , 'className': 'text-right'},
                { data: "action", 'className': 'text-center' },
            ],
            "aoColumnDefs":[
                {
                    "bSortable": false,
                    "aTargets": [5,6],
                }
            ],
            "order" : [],
            language: {
                paginate: {
                    next: '»',
                    previous: '«'
                }
            }
        });

    var App = {
        baseUrl : window.location.protocol + '//' + window.location.host + '/admin/services/assessment',
        url : window.location.protocol + '//' + window.location.host + '/admin/',
        csrfToken : $('meta[name="csrf-token"]').attr('content'),

        init: function () {
            this.setElements();
            this.bindEvents();
        },

        setElements: function () {
            this.$search = $('#search');
        },

        bindEvents: function () {
            this.$search.on('click', this.search);
        },

        search : function() {

            table
                .columns(0)
                .search($('#class').val())
                .draw();
        },

    }

    App.init();
})

function formatDate1(date) {
    var d = new Date(date),
        month = '' + d.toLocaleString('default', { month: 'short' }),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [day, month, year].join(' ');
}
