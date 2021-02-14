$(function () {
    var table = $('#dt').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        scrollX: true,
        bInfo: false,
        bDestroy: true,
        bLengthChange: false,
        columns:[
            { data: 'profile_id', 'className': 'hidden' },
            { data: 'avatar', 'className': 'text-center' },
            { data: 'name' },
            { data: 'student_no' },
            { data: 'dob' },
            { data: 'age', 'className': 'text-right' },
            { data: 'gender' },
            { data: 'action', 'className': 'text-center' }
        ],
        "aoColumnDefs":[
            {
                "bSortable": false, 
                "aTargets": [1, 7],
            },
            { 
                "targets": [2, 3], 
                "searchable": true 
            }
        ],
        language: {
            paginate: {
                next: '»', 
                previous: '«' 
            }
        },
        aaSorting: [[0, 'desc']]
    });

    var App = {
        host: window.location.protocol + '//' + window.location.host + '/',
        baseUrl : window.location.protocol + '//' + window.location.host + '/admin/users/',
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
                .search($('#keyword').val())
                .draw();
        }
    }

    App.init();
}); 

