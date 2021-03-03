$(function () {
    var table = $('#dt').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        scrollX: true,
        bInfo: false,
        bDestroy: true,
        bLengthChange: false,
        columns:[
            { data: 'payment_id', 'className': 'hidden' },
            { data: 'or_no' },
            { data: 'customer' },
            { data: 'payment_date' },
            { data: 'amount_due', 'className': 'text-right' },
            { data: 'amount_paid', 'className': 'text-right' },
            { data: 'balance', 'className': 'text-right' },
            { data: 'status' }
        ],
        "aoColumnDefs":[
            {
                "bSortable": false, 
                "aTargets": [4, 5, 6]
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

