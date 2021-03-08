$(function () {
    var table = $('#dt').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        scrollX: true,
        bInfo: false,
        bDestroy: true,
        bLengthChange: false,
        columns:[
            { data: 'name' },
            { data: 'course' },
        ],
        "aoColumnDefs":[
            {
                "targets": [0],
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
        baseUrl : window.location.protocol + '//' + window.location.host + '/admin/reports/trainees',
        csrfToken : $('meta[name="csrf-token"]').attr('content'),

        init: function () {
            this.setElements();
            this.bindEvents();
        },

        setElements: function () {
            this.$accordionThumb = $('.accordion-thumb');
            this.$courses = $('#course');
            this.$search = $('#search');
        },

        bindEvents: function () {
            this.$accordionThumb.on('click', function() {
                $(this).closest( "li" ).toggleClass("is-active").children(".accordion-panel").slideToggle("ease-out");
            });
            this.$courses.on('change', this.filter);
            this.$search.on('click', this.search);
        },

        filter : function(e) {
            if(e.target.value) {
                var course = e.target.options[event.target.options.selectedIndex].text;

                table
                    .search(course)
                    .draw();
            } else {

                table
                    .search('')
                    .draw();
            }

        },

        // search : function() {
        //     var course_id = $('#course').find(":selected").val();
        //
        //     $.ajax({
        //         url: App.baseUrl + '/filter',
        //         method: 'GET',
        //         dataType: "json",
        //         data: {
        //             'course_id' : course_id,
        //         },
        //         success: function (data) {
        //             table.clear().draw();
        //
        //             if (data != '') {
        //
        //                 $.each(data, function (key, row) {
        //                     console.log(row);
        //
        //                     table.row.add( {
        //                         "name"   : 'Alfonso, Jerald De Guzman',
        //                         "course" : 'Information Technology',
        //                     }).draw();
        //                 });
        //
        //
        //             }
        //         },
        //         error: function () {
        //         }
        //     });
        //
        //     table
        //         .search($('#keyword').val())
        //         .draw();
        // }
    }

    App.init();
});
