<link rel="stylesheet" href="{{ URL::asset('admin/css/forms.css') }}">

<div class="page-wrap">
		<div style="margin-top: 20px;">	
            <div class="identity">
            	156 Jonson Street Byron Bay NSW 2481 Australia<br />
				Tax ID # 88 164 251 950
			</div>

            <div class="logo">
              	<img src="{{ URL::asset('favicon.ico') }}" height="20" class="d-inline-block align-top mr-2" alt="">
            </div>
		</div>
	
		<div style="clear:both"></div>
		
		<div class="header">PAYMENT</div>

		<div style="margin-top: 15px;">
			<div class="customer"> 
	            <div class="customer-title">{{ $payment->lastname }}, {{ $payment->firstname }} {{ $payment->middlename }}</div>
			</div>

            <table class="meta">
                <tr>
                    <td class="meta-head">OR No.</td>
                    <td><span>{{ $payment->or_no }}</span></td>
                </tr>

                <tr>
                    <td class="meta-head">Date</td>
                    <td><span>{{ date('d/m/Y', strtotime($payment->payment_date)) }}</span></td>
                </tr>

                <tr>
                    <td class="meta-head">Amount Due</td>
                    <td><span>{{ number_format($payment->amount_due, 2) }}</span></td>
                </tr>

                <tr>
                    <td class="meta-head">Amount Paid</td>
                    <td><span>{{ number_format($payment->amount_paid, 2) }}</span></td>
                </tr>
            </table>
		</div>
		
		<div style="clear:both"></div>

		<table class="items">
		  	<tr>
			    <th style="width: 10%">Invoice No.</th>
                <th style="width: 10%">Date Issued</th>
                <th>Memo</th>
                <th class="align-right" style="width: 10%">Amount</th>
		  	</tr>
			
			<tr class="item-row">
			    <td><b>{{ $invoice->invoice_no }}</b></td>
                <td>{{ date('d/m/Y', strtotime($invoice->invoice_date)) }}</td>
                <td class="word-wrap">{{ $invoice->order_memo }}</td>
                <td class="align-right">{{ number_format($invoice->net, 2) }}</td>
			</tr>
		</table>
	</div>

		<table class="items">
		  	<tr>
			    <th class="align-right" style="width: 5%">Qty</th>
                <th style="width: 20%">Item Name</th>
                <th>Description</th>
                <th class="align-right" style="width: 10%">Rate</th>
                <th class="align-right" style="width: 10%">Total</th>
                <th class="align-right" style="width: 10%">Discount</th>
                <th class="align-right" style="width: 10%">Net</th>
		  	</tr>
			  
			@foreach ($invoice_items as $row)
				<tr class="item-row">
				    <td class="align-right">{{ $row->quantity }}</td>
                    <td>{{ $row->item_name }}</td>
                    <td>{{ $row->item_description }}</td>
                    <td class="align-right">{{ number_format($row->rate / $row->quantity, 2) }}</td>
                    <td class="align-right">{{ number_format($row->rate, 2) }}</td>
                    <td class="align-right">{{ number_format($invoice->total_discount, 2) }}</td>
                    <td class="align-right">{{ number_format($row->amount, 2) }}</td>
				</tr>
			@endforeach

			<tr>
			    <td colspan="5" class="blank"> </td>
			    <td class="total-line total">Total :</td>
			    <td class="total-value total">{{ $payment->amount_due }}</td>
			</tr>
		</table>
	</div>