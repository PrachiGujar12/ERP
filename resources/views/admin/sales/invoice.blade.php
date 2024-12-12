<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Invoice</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <style>
      /* General Styles */

      @font-face {
        font-family: "Calibri";
        src: url("fonts/calibri-font-sv/Calibri-Light.ttf") format("truetype");
        font-weight: normal;
        font-style: normal;
      }

      /* Step 2: Apply the font to your elements */
      body {
        font-family: "Calibri", sans-serif;
      }
      p,
      th,
      td {
        font-size: 12px;
        line-height: 14.48px;
        align-content: center;
        font-weight: 400;
      }
      /* .invoice-details {
        margin-top: 20px;
      } */
      .invoice-header {
        margin-bottom: 20px;
      }
      .invoice-details th,
      .invoice-details td {
        padding: 5px;
        border: 0px solid #dee2e6;
      }
      .text-right {
        text-align: right;
      }
      .text-left {
        text-align: left;
      }
      .invoice__page .invoice-total {
        margin-top: 120px;
      }
      .invoice__page .terms {
        margin-top: 30px;
      }
      .invoice__page .signature {
        margin-top: 40px;
        display: flex;
        justify-content: start;
        align-items: center;
      }
      .invoice__page .signature-line {
        width: 300px;
        border-bottom: 1px solid #000;
      }
      .container,
      .container-lg,
      .container-md,
      .container-sm,
      .container-xl {
        max-width: 1200px;
      }
      .sales-invoice-header {
        font-size: 29.333px;
      }
      tr {
        border-bottom: 1px dotted;
        height: 50px;
        align-content: end;
      }
      .description {
        width: 70%;
      }
      .Weight {
        width: 15%;
      }
      .Amount {
        width: 15%;
      }
      .table-head {
        border-top: none;
        border-bottom: 2px solid #000 !important;
      }
      .table-head th {
        font-size: 12.333px;
        align-content: end;
        padding: 5px 0;
        font-weight: 600;
      }

      /* Print Styles */
      @media print {
        @page {
          margin-top: 1.7cm !important;
          margin-left: 2.2cm !important;
          margin-right: 2cm !important;
          /* margin-top: 128.5px;
          margin-left: 83.14px;
          margin-right: 83.14px; */
          /* width: 895.28px; */
          /* height: 841.89px; */
          size: A4;
        }
      }
    </style>
  </head>
  <body>
    <div class="container invoice__page  px-0">
      <div class="row invoice-header justify-content-between">
        <div class="col-sm-6">
          <!-- Logo -->
          <!-- <img src="https://demo.webwideit.solutions/raman-jeweller-erp/public/asset/images/logo/55cmx37cm.jpg" alt="Logo" style="padding-right: 20.11px; padding-top: 20px;"> -->
          <img src="https://demo.webwideit.solutions/raman-jeweller-erp/public/asset/images/logo/invoice-logo.webp" alt="Logo" style="padding-right: 20.11px; padding-top: 20px; width: 61.6mm; height: 41.47mm;">

        </div>
        <div class="col-sm-4 col-md-2 col-lg-2">
          <div>
            <p class="mb-0">Raman Jewellers Ltd</p>
            <p>
              140 Ilford Lane<br />
              Ilford<br />
              Essex<br />
              IG1 2LG<br />
              UNITED KINGDOM<br />
            </p>
            <p>
              T: 0208 514 0410<br />
              E: info@ramanjewellers.com<br />
              Vat No: GB1003811789
            </p>
          </div>
        </div>
      </div>
      <div class="row justify-content-between pt-3">
        <div class="col-md-12">
          <div class="row d-flex justify-content-end">
            <div class="col-sm-4 col-md-2 col-lg-2">
              <h5 class="sales-invoice-header">SALES INVOICE</h5>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div style="padding-top: 8px; padding-left: 7px;">
          <p class="mb-0"><strong>Invoice to:</strong></p>
          <p style="margin-bottom: 0"><strong>{{$invoice->customer->first_name}} {{$invoice->customer->last_name}}</strong></p>
          <p>
            <strong>
              {{$invoice->customer->address}}<br />

              {{$invoice->customer->town}}<br />
              {{$invoice->customer->county}}<br />
              {{$invoice->customer->post_code}}
            </strong>
          </p>
        </div>
        </div>
        <div class="col-sm-4 col-md-2 col-lg-2">
          <p class="mb-1">
            <strong>Invoice Date:</strong><br />
            {{ \Carbon\Carbon::parse($invoice->created_at)->format('d/m/Y') }}
          </p>
          <p class="mb-1">
            <strong>Invoice Number:</strong><br />
            {{$invoice->sale_id}}
          </p>
          <p class="mb-1">
            <strong>Account Number:</strong><br />
            Xxx xxxx
          </p>
        </div>
      </div>

      <table class="table table-bordered invoice-details" style="border: 0">
        <thead>
          <tr class="table-head">
            <th class="description">Description</th>
            <th class="Weight text-right">Weight (grams)</th>
            <th class="Amount text-right">Amount</th>
          </tr>
        </thead>
        <tbody>
          @foreach($items as $item)
          <tr>
            <td>{{$item->category}} {{$item->metal_type}}</td>
            <td class="text-right">{{$item->item_weight}}</td>
            <td class="text-right">{{$item->sale_amount}}</td>
          </tr>
			@endforeach
        </tbody>
      </table>
      <div class="row invoice-total justify-content-end">
        <div
          class="col-md-2 col-sm-3 col-6 py-3"
          style="padding-right: 0; border-top: 1.5px solid #000"
        >
          <p>Subtotal</p>
          <p>VAT 20%</p>
          <p class="mb-1">Invoice Total GBP</p>
          <p class="">Deposit Paid</p>
          <p class="border-top  border-2 border-dark" style="margin-top: 2rem;">
            <strong>Amount Due GBP:</strong>
          </p>
        </div>
        <div
          class="col-md-2 col-sm-2 col-6 text-end py-3"
          style="padding-left: 0; border-top: 1.5px solid #000"
        >
          <p>{{ number_format($invoice->total_amount, 2) }}</p>
          <p>{{ number_format($invoice->total_amount * 0.20, 2) }}</p>
          <p class="mb-1">{{ number_format($invoice->total_amount + ($invoice->total_amount * 0.20), 2) }}</p>
          <p class="">{{ number_format($invoice->paid_amount, 2) }}</p>
          <p class="border-top  border-2 border-dark" style="margin-top: 2rem;">
            <strong>{{ number_format($invoice->due_amount, 2) }}</strong>
          </p>
        </div>
      </div>

      <div class="terms">
        <p>
          <strong>Terms:</strong> Goods supplied remain property of Raman
          Jewellers and balance outstanding will be charged at 4% a month until
          paid in full. No claims of damage or discrepancies will be entertained
          after the date of purchase. <br />
          Hollow jewellery due to damage cannot be exchanged or refunded Ear
          wear and nose pin jewellery is non refundable due to hygienic reasons
          Any item refunded will incur restocking charge of 30% of the value.
        </p>
      </div>
      <div class="signature">
        <p><strong>Signed:</strong></p>
        <div class="signature-line"></div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
