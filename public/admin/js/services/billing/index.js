$(function () {
    var table = $('#dt').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        scrollX: true,
        bInfo: false,
        bDestroy: true,
        bLengthChange: false,
        columns:[
            { data: 'invoice_id', 'className': 'hidden' },
            { data: 'invoice_no' },
            { data: 'customer' },
            { data: 'invoice_date' },
            { data: 'due_date' },
            { data: 'amount', 'className': 'text-right' },
            { data: 'unpaid', 'className': 'text-right' }, 
            { data: 'status' },
            { data: 'action', 'className': 'text-center' }
        ],
        "aoColumnDefs":[
            {
                "bSortable": false, 
                "aTargets": [5, 6, 8]
            },
            { 
                "targets": [1, 2], 
                "searchable": true 
            }
        ],
        language: {
            paginate: {
                next: '»', 
                previous: '«' 
            }
        },
        aaSorting: [[1, 'asc']]
    });

    var App = {
        baseUrl : window.location.protocol + '//' + window.location.host + '/admin/services/enrollment',
        csrfToken : $('meta[name="csrf-token"]').attr('content'),

        init: function () {
            this.setElements();
            this.bindEvents();
        },

        setElements: function () {
            this.$accordionThumb = $('.accordion-thumb');
            this.$search = $('#search');
        },

        bindEvents: function () {
            this.$accordionThumb.on('click', function() {
                $(this).closest( "li" ).toggleClass("is-active").children(".accordion-panel").slideToggle("ease-out");
            });

            this.$search.on('click', this.search);
        },

        search : function() {
             table
                .search($('#key').val())
                .draw();
        },
    }

    App.init();
}); 

