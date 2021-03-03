$(function () {
    var table = $('#dt').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        scrollX: true,
        bInfo: false,
        bDestroy: true,
        bLengthChange: false,
        columns:[
            { data: 'class' },
            { data: 'course' },
            { data: 'enrolled', 'className': 'text-right' },
            { data: 'schedule' },
            { data: 'instructor' },
            { data: 'status' },
            { data: 'action', 'className': 'text-center' }
        ],
        "aoColumnDefs":[
            {
                "bSortable": false, 
                "aTargets": [2, 6]
            },
            { 
                "targets": [0, 1, 4], 
                "searchable": true 
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

        search1 : function() {
            
        },
    }

    App.init();
}); 

function view(classID) {
    
    $.ajax({
        url: window.location.protocol + '//' + window.location.host + '/admin/services/enrollment/get-enrolled',
        method: 'GET',
        dataType: "json",
        data: { 
            classID : classID, 
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            if(data) {
                $(".modal table").find("tr:gt(0)").remove();

                $.each(data, function(key, value) {
                    
                    $('.modal table tr:last').after('<tr>'+
                            '<td>'+ value.lastname +', '+ value.firstname +' '+ (value.middlename ? value.middlename : '') +'</td>'+ 
                            '<td>'+ value.control_no +'</td>'+ 
                        '</tr>');
                });

                $('#modal').modal('show');   
    
            }
        },
        error : function(request, status, error) {
            console.log(error)
        }
    });
}


