$(function () {
    var App = {
        baseUrl : window.location.protocol + '//' + window.location.host + '/admin/services/enrollment',
        csrfToken : $('meta[name="csrf-token"]').attr('content'),

        init: function () {
            this.setElements();
            this.bindEvents();
        },

        setElements: function () {
            this.$selectAll = $('.select-all');

            this.$enroll = $('.enroll');
            this.$add = $('.add');
        },

        bindEvents: function () {
            this.$selectAll.on('click', function(e) {
                $('.checkbox').prop('checked', this.checked);
            });

            this.$add.on('click', this.add);
            this.$enroll.on('click', this.enroll);
        },

        add: function() {
            if (!$('#dtClass').find('input[type=checkbox]').is(":checked")) {
                bootstrap_alert.warning('#modal-alert', ' Please select a <b>class/clasess</b> before submitting.'); 
                return; 
            }
           
            $('#dtClass tbody tr').each(function(index, row){
                var cols = $(row).children('td');

                if ($(cols[1]).find('input[type=checkbox]').is(":checked")) {
                    
                    $('#dt tr:last').before('<tr>'+
                            '<td class="hidden">'+ $(cols[0]).text() +'</td>'+ 
                            '<td>'+ $(cols[2]).html() +'</td>'+ 
                            '<td>'+ $(cols[3]).text() +'</td>'+ 
                            '<td>'+ $(cols[4]).text() +'</td>'+ 
                            '<td>'+ $(cols[5]).text() +'</td>'+ 
                            '<td class="align-center">'+
                                '<button onclick="hide(this);" type="button" class="btn btn-sm btn-default" title="" data-toggle="tooltip" data-placement="top" data-original-title="Delete"> <i class="icon-trash"></i> </button>'+
                            '</td>'+
                        '</tr>');
                }
            });

            bootstrap_alert.close('#modal-alert');
            $('#dtClass tr input[type="checkbox"]').prop('checked', false);
            $('#modal').modal('hide');    
        },

        enroll: function() {
            if (App.validate()) return; 

            bootstrap_alert.close('#alert');

            swal({
                title: "",
                text: "Are you sure you want to save this record?",
                type: "warning",
                confirmButtonText: "Yes",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true
            }, function () {
                
                const formData = new FormData();
                formData.append('profileID', $('#profileID').val());
                formData.append('courseID', $('#courseID').val());
                formData.append('classIDS', JSON.stringify(App.getClassIDS()));

                $.ajax({
                    url: App.baseUrl + "/store",
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    headers: {'X-CSRF-TOKEN': App.csrfToken},
                    success: function(data) {
                        if (data.success == true) {
                            
                            swal({
                                title: "Success!",
                                text: "1 row successfully submitted.",
                                type: "success",
                            }, function () {
                                window.location.href = App.baseUrl+'/enroll-student'; 
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

        validate: function() {
            if ($('#dt tr').length == 2) { 
                bootstrap_alert.warning('#alert', 'Please add <b>class/clasess</b> to continue.'); 

                $('html, body').animate({
                    scrollTop: ($('#alert').offset().top - 300)
                },500);

                return true; 
            } else {
                return false;
            }
        },


        getClassIDS : function() {
            var dt = [];

            $('#dt tbody tr').each(function(index, row){
                
                if($('#dt tr').length-2 != index) {
                    var cols = $(row).children('td');

                    dt.push({
                        "classID" : $(cols[0]).text()
                    });
                }
            });

            return dt;
        }, 
        
    }

    App.init();
})

function hide(e){
    var cols = $(e).closest('tr').children("td");
       
    $(e).closest('tr').hide();
}
