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
		
		<div class="header">INVOICE</div>

		<div style="margin-top: 15px;">
			<div class="customer"> 
	            <div class="customer-title">{{ $invoice->lastname }}, {{ $invoice->firstname }} {{ $invoice->middlename }}</div>
	            
	            <div style="clear:both"></div>

	            <p>{{ $invoice->billing_address }}</p>

				<p style="margin-top: 15px;">
	            	<span class="bold">Memo</span>: {{ $invoice->order_memo }}
				</p>
			</div>

            <table class="meta">
                <tr>
                    <td class="meta-head">Invoice #</td>
                    <td><span>{{ $invoice->invoice_no }}</span></td>
                </tr>

                <tr>
                    <td class="meta-head">Date</td>
                    <td><span>{{ date('d/m/Y', strtotime($invoice->invoice_date)) }}</span></td>
                </tr>

                <tr>
                    <td class="meta-head">Created From</td>
                    <td><span> </span></td>
                </tr>
            </table>
		</div>
		
		<div style="clear:both"></div>

		<table class="items">
		  	<tr>
			    <th class="align-right" style="width: 5%">Qty</th>
                <th style="width: 30%">Item Name</th>
                <th>Description</th>
                <th class="align-right" style="width: 10%">Rate</th>
                <th class="align-right" style="width: 10%">Total</th>
		  	</tr>
			  
			@foreach ($invoice_items as $row)
				<tr class="item-row">
				    <td class="align-right">{{ $row->quantity }}</td>
                    <td>{{ $row->item_name }}</td>
                    <td>{{ $row->item_description }}</td>
                    <td class="align-right">{{ number_format($row->rate, 2) }}</td>
                    <td class="align-right">{{ number_format($row->amount, 2) }}</td>
				</tr>
			@endforeach

			<tr>
			    <td colspan="3" class="blank"> </td>
			    <td class="total-line">Subtotal :</td>

			    <td class="total-value">{{ $invoice->subtotal }}</td>
			</tr>

			<tr>
			    <td colspan="3" class="blank"> </td>
			    <td class="total-line">Discount :</td>

			    <td class="total-value">{{ $invoice->total_discount }}</td>
			</tr>

			<tr>
			    <td colspan="3" class="blank"> </td>
			    <td class="total-line total">Total :</td>

			    <td class="total-value total">{{ $invoice->net }}</td>
			</tr>
		</table>
	</div>