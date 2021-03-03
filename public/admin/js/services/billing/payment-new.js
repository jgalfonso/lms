$(function () {
    var App = {
        baseUrl : window.location.protocol + '//' + window.location.host + '/admin/services/billing/payments/',
        csrfToken : $('meta[name="csrf-token"]').attr('content'),

        init: function () {
            this.setElements();
            this.bindEvents();
        },

        setElements: function () {
            this.$paymentDate = $('#paymentDate');
            
            this.$save = $('.save');
            this.$add = $('.add');
        },

        bindEvents: function () {
            this.$paymentDate.datepicker({ format: 'dd/mm/yyyy', todayHighlight: true });
            
            this.$add.on('click', this.add);
            this.$save.on('click', this.save);
        },

        save: function() {
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
                
                var form = document.getElementById('form');
                var formData = new FormData(form);
                formData.append('referenceID', $('#invoiceID').val());
                formData.append('amountDue', $('#amountDue').text());

                $.ajax({
                    url: App.baseUrl + "store",
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
                                window.location.href = App.baseUrl+'view/'+data.id; 
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
            if (!$('#form').parsley().validate()) { 
                bootstrap_alert.warning('#alert', 'There are some error/s, please correct them bellow.'); 
                $('html, body').animate({ scrollTop: ($('#alert').offset().top - 300)}, 500);

                return true; 
            } else {
                
                 if ($('#items tr').length == 2) { 

                    bootstrap_alert.warning('#alert', 'Please add <b>item/items</b> to continue.'); 
                    $('html, body').animate({ scrollTop: ($('#alert').offset().top - 300)}, 500);

                    return true; 
                } else {
                    return false;
                }
            }
        },
    }

    App.init();
})

