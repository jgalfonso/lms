$(function () {
    var table = $('#dt').DataTable({
            responsive: true,
            dom: 'Bfrtip',
            "bInfo": false,
            scrollX: true,
            columns:[
                { data: "filename" },
                { data: "action", 'className': 'text-center' },
            ],
            searching: false,
            "aoColumnDefs":[
                {
                    "bSortable": false,
                    "aTargets": [0,1],
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
        baseUrl : window.location.protocol + '//' + window.location.host + '/admin/academic/assignments',
        csrfToken : $('meta[name="csrf-token"]').attr('content'),

        init: function () {
            this.setElements();
            this.bindEvents();
        },

        setElements: function () {
            this.$markAsCompleted = $('#mark-as-completed');
        },

        bindEvents: function () {
            this.$markAsCompleted.on('click', this.markAsCompleted);
        },

        markAsCompleted : function() {
            swal({
                title: "",
                text: "Are you sure you want to complete this record?",
                type: "warning",
                confirmButtonText: "Yes",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true
            }, function () {

                const formData = new FormData();
                formData.append('participantIDS', JSON.stringify(App.getParticipantID()));

                $.ajax({
                    url: App.baseUrl + "/complete",
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    headers: {'X-CSRF-TOKEN': App.csrfToken},
                    success: function(data) {
                        if (data.success == true) {

                            swal({
                                title: "Success!",
                                text: "Assignment successfully completed.",
                                type: "success",
                            }, function () {
                                window.location.href = App.baseUrl + '/evaluation';
                            });
                        } else {

                            alert(data);
                        }
                    },
                    error : function(request, status, error) {
                        swal("Oops!", "Seems like there is an error. Please try again", "error");
                    },
                    contentType: false,
                    processData: false,
                    cache: false
                });
            });
        },

        getParticipantID : function() {
            var dt = [];

            dt.push({
                "participantID" : $('#participantID').val()
            });

            return dt;
        },
    }

    App.init();

})
