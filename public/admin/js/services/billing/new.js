$(function () {
    var App = {
        baseUrl : window.location.protocol + '//' + window.location.host + '/admin/services/billing/invoices/',
        csrfToken : $('meta[name="csrf-token"]').attr('content'),

        init: function () {
            this.setElements();
            this.bindEvents();
        },

        setElements: function () {
            this.$customer = $('#customer');
            this.$invoiceDate = $('#invoiceDate');
            this.$dueDate = $('#dueDate');
            this.$dueDate = $('#dueDate');
            this.$discount = $('#discount');

            this.$item = $('#item');
            this.$qty = $('#qty');
            this.$rate = $('#rate');

            this.$save = $('.save');
            this.$add = $('.add');
        },

        bindEvents: function () {
            this.$customer.on('change', function(e) {
                var customer = e.target.value;

                $('#referenceNO').val(customer.split("~")[1]);
                $('#billTo').val(App.$customer.find('option:selected').text());
            });
            this.$invoiceDate.datepicker({ format: 'dd/mm/yyyy', todayHighlight: true });
            this.$dueDate.datepicker({ format: 'dd/mm/yyyy', todayHighlight: true });
            this.$discount.on('change', function() {
                setSummary();
            });

            this.$item.on('change', function(e) {
                var item = e.target.value;

                $('#description').val(item.split("~")[1]);
                $('#qty').val(item.split("~")[2]);
                $('#rate').val(item.split("~")[3]);
                $('#amount').val(item.split("~")[3]);
            });
            this.$qty.on('change', this.setAmount);
            this.$rate.on('change', this.setAmount);

            this.$add.on('click', this.add);
            this.$save.on('click', this.save);
        },

        setAmount : function() {

            $('#amount').val((Number(App.$rate.val())*Number(App.$qty.val())).toFixed(2));
        },

        add: function() {
            if (!$('#modal-form').parsley().validate()) { 
                bootstrap_alert.warning('#modal-alert', 'There are some error/s, please correct them bellow.'); 
                return; 
            } 
           
            $('#items tr:last').before('<tr>'+
                    '<td class="hidden">'+ App.$item.val().split("~")[0] +'</td>'+ 
                    '<td class="text-right">'+ $('#qty').val() +'</td>'+ 
                    '<td>'+ App.$item.find('option:selected').text() +'</td>'+ 
                    '<td>'+ App.$item.val().split("~")[1]  +'</td>'+ 
                    '<td class="text-right">'+ mask($('#rate').val()) +'</td>'+ 
                    '<td class="text-right">'+ mask($('#amount').val()) +'</td>'+ 
                    '<td class="align-center">'+
                        '<button onclick="hide(this);" type="button" class="btn btn-sm btn-default" title="" data-toggle="tooltip" data-placement="top" data-original-title="Delete"> <i class="icon-trash"></i> </button>'+
                    '</td>'+
                '</tr>');

            setSummary();

            App.$item.val(1);
            App.$item.removeClass('parsley-success');
            $('#modal-form input[type="text"], #modal-form input[type="number"]').val('');
            $('#modal-form input[type="text"], #modal-form input[type="number"]').removeClass('parsley-success');

            bootstrap_alert.close('#modal-alert');    
            $('#modal').modal('hide');    
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
                formData.append('customerID', App.$customer.val().split("~")[0]);
                formData.append('itemIDS', JSON.stringify(App.getItemIDS()));

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


        getItemIDS : function() {
            var dt = [];

            $('#items tbody tr').each(function(index, row){
                
                if($('#items tr').length-2 != index) {
                    var cols = $(row).children('td');

                    dt.push({
                        "itemID"    : $(cols[0]).text(),
                        "qty"       : $(cols[1]).text(),
                        "rate"      : $(cols[4]).text(),
                        "amount"    : $(cols[5]).text()
                    });
                }
            });

            return dt;
        }, 
        
    }

    App.init();

    setSummary();
})

function setSummary(){
    var subTotal = 0;
    var discount = 0;
    var total = 0;

    $('#items tbody tr').each(function(row, tr){
        var cols = $(tr).children('td');
        subTotal += Number($(cols[4]).text().replace(',', ''));
    });

    if ($('#discount').val()) discount = parseFloat($('#discount').val());
    
    $('#subTotal').val(mask(subTotal.toFixed(2))); 
    $('#total').val(mask((subTotal - discount).toFixed(2))); 
    $('#summary-sub-total').text(mask(subTotal.toFixed(2))); 
    $('#summary-discount').text(mask(discount.toFixed(2))); 
    $('#summary-total').text(mask((subTotal - discount).toFixed(2))); 
}

function hide(e){
    var cols = $(e).closest('tr').children("td");
       
    $(e).closest('tr').hide();
}

function mask(number) {
    var parts = number.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}

