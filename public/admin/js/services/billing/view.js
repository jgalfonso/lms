$(function () {
    var App = {
        baseUrl : window.location.protocol + '//' + window.location.host + '/admin/services/billing/invoices/',
        csrfToken : $('meta[name="csrf-token"]').attr('content'),

        init: function () {
            this.setElements();
            this.bindEvents();

            //$("#actions a.disabled").removeAttr('onclick').removeAttr('href');  
        },

        setElements: function () {
            this.$print = $('#print'); 
        },
      
        bindEvents: function () {
            this.$print.printPage({
                url: App.baseUrl + "forms/" + $('#invoiceID').val(),
                attr: "href",
                message:"Your document is being created..."
            });
        },

        new : function() {
            window.location.href = baseUrl + "/sales/invoices/new"; 
        },

        edit : function() {
            window.location.href = baseUrl + "/sales/invoices/edit/" + $('#invoice-id').val(); 
        },

        back : function() {
            window.history.back();
        }
    }

    App.init();
}); 

