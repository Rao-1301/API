<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>INVOICE</title>
    <style>
        .whiteBorder {
            border-top: 1px solid white;
            border-left: 1px solid white;
            border-right: 1px solid white;
        }

        table,
        td {
            border-collapse: collapse;
            border-left: 1px solid black;
        }

        table {
            border-left: 1px solid black;
            border-right: 1px solid black;
            border-bottom: 1px solid black;
        }

        body {
            width: 100%;
            margin: 0;
            padding: 0;
            font-size: 12px;
        }

        .border-top {
            border-top: 1px solid black;
        }

        .border-bottom {
            border-bottom: 1px solid black;
        }

        .page {
            width: 100%;
        }

        .header-text {
            text-align: center;
            font-size: 14px;
            font-weight: 500;
        }
        .rbl{
            border-left: 0px !important;
        }
    </style>
</head>

<body>
    <section class="page">
        <div style="text-align: center; font-size: 22px; font-weight:600">INVOICE</div>
        <table width="100%" border="0" cellpadding="3">
            <tr class=" whiteBorder">
                <th width="10%"></th>
                <th width="10%"></th>
                <th width="10%"></th>
                <th width="10%"></th>
                <th width="10%"></th>
                <th width="10%"></th>
                <th width="10%"></th>
                <th width="10%"></th>
                <th width="10%"></th>
                <th width="10%"></th>
            </tr>

            <tr class="border-top">
                <td colspan="1">M/s.</td>
                <td colspan="5" class="rbl"><b>: </b> {{ $order->customer->name }}</td>
                <td colspan="1">Invice No</td>
                <td colspan="3" class="rbl"><b>: </b>{{ $order->id }}</td>
            </tr>
            <tr class="">
                <td colspan="1"></td>
                <td colspan="5" class="rbl" style="padding-left: 12px"> <?php echo nl2br(str_replace('\r', '', $order->customer->address)); ?></td>
                <td colspan="1">Date</td>
                <td colspan="3" class="rbl"> <b>: </b> {{ $order->created_at->format('d/m/Y') }}</td>
            </tr>
            <tr class="">
                <td colspan="1"></td>
                <td colspan="5" class="rbl"></td>
                <td colspan="1">Site Name</td>
                <td colspan="3" class="rbl"><b>:</b> {{ $order->site->title }}</td>
            </tr>
            <tr class="">
                <td colspan="1">Mo.</td>
                <td colspan="5" class="rbl"><b>: </b> {{ $order->customer->mobile }}</td>
                <td colspan="1">Vehicle No</td>
                <td colspan="3" class="rbl"><b>:</b> {{ $order->vehicle_no }}</td>
            </tr>
            <tr class="border-top border-bottom header-text ">
                <td colspan="5">Description</td>
                <td>Nos</td>
                <td>Units</td>
                <td>Rates</td>
                <td>Disc%</td>
                <td>Amount</td>
            </tr>
            @foreach ($order->orderItems as $item)
                <tr>
                    <td colspan="5">{{ $item->product_name }}</td>
                    <td style="text-align: center">{{ $item->nos }}</td>
                    <td style="text-align: center">{{ $item->unit }}</td>
                    <td style="text-align: right">{{ $item->price }}</td>
                    <td style="text-align: center">{{ $item->discount }}</td>
                    <td style="text-align:right">{{ $item->total_price }}</td>
                </tr>
            @endforeach

            <?php for($i = 0; $i < 3; $i++) { ?>
            <tr>
                <td colspan="5"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>&nbsp;</td>
            </tr>
            <?php } ?>

            <tr class="border-top">
                <td colspan="2">Rupess</td>
                <td colspan="4" class="rbl"><b>: </b>{{$totalInWord}}</td>
                <td colspan="2" style="border-bottom:1px solid black;">Sub Total</td>
                <td colspan="2" class="rbl" style="text-align: right; border-bottom:1px solid black;">{{$order->total}}</td>
            </tr>
            <tr >
                <td colspan="2">Previous Balance</td>
                <td colspan="4" class="rbl"><b>:</b> 10000.00</td>
                <td colspan="2"></td>
                <td colspan="2" class="rbl"></td>
            </tr>
            <tr >
                <td colspan="2">Bill Amount</td>
                <td colspan="4" class="rbl"><b>:</b> 5000.00</td>
                <td colspan="2" style="border-bottom:1px solid black;">Rounf Off</td>
                <td colspan="2" style="border-bottom:1px solid black;" class="rbl"></td>
            </tr>
            <tr >
                <td colspan="2">Total Outstanding</td>
                <td colspan="4" class="rbl"><b>:</b> 15000.00</td>
                <td colspan="2">Grand Total</td>
                <td colspan="2" class="rbl" style="text-align: right">{{$order->total}}</td>
            </tr>
            

            <tr class="border-top">
                <td colspan="5" style="text-align: center; padding-top : 30px;">Reciever's Signature</td>
                <td colspan="5" style="text-align: center; padding-top : 30px; " >Authorised Signatory</td>
            </tr>
        </table>
    </section>
</body>

</html>
