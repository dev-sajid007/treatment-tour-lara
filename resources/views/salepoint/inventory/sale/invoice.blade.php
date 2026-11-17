<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $sale->id }}</title>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="3">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="{{ Storage::url('img/' . $settings->logo) }}" style="width:40%;">
                            </td>
                            
                            <td>
                                Invoice #: {{ $sale->id }}<br>
                                Created: {{ $sale->created_at->format('d-M-Y') }}<br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="3">
                    <table>
                        <tr>
                            <td>
                                @if(isset($customer->name))
                                {{ $customer->name }}<br>
                                @endif
                            @if(isset($customer->address))
                                {{ $customer->address }}<br>
                                @endif
                            @if(isset($customer->phone))
                                {{ $customer->phone }}<br>
                            @endif
                            </td>
                            <td>
                              
                            </td>
                            <td>
                                {{$settings->website_name}}<br>
                                {{$settings->address}}<br>
                                {{$settings->business_phone}}
                                {{$settings->business_email}}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td>
                    Item
                </td>
                <td>
                    Per Item Price
                </td>
                <td>
                    Price
                </td>
            </tr>

            @foreach($products as $product)
            <tr class="item">
                <td>
                    {{ $product->name }} (x{{ $product->quantity }})
                </td>
                <td>
                    {{$settings->currency}}{{ number_format($product->salePrice, 2) }}
                </td>
                <td>
                    {{$settings->currency}}{{ number_format($product->amount, 2) }}
                </td>
            </tr>
            @endforeach
            <tr class="total">
                <td></td>
                <td></td>
                <td>
                   Subtotal: {{$settings->currency}}{{ number_format($sale->subtotal, 2) }}
                </td>
            </tr>
            <tr class="total">
                <td></td>
                <td></td>
                <td>
                   Tax: {{$settings->currency}}{{ number_format($sale->tax, 2) }}
                </td>
            </tr>
            <tr class="total">
                <td></td>
                <td></td>
                <td>
                   Discount: {{$settings->currency}}{{ number_format($sale->discount, 2) }}
                </td>
            </tr>
            <tr class="total">
                <td></td>
                <td></td>
                <td>
                   Total: {{$settings->currency}}{{ number_format($sale->final_amount, 2) }}
                </td>
            </tr>
            <tr class="total">
                <td></td>
                <td></td>
                <td>
                   
                
                  Total Pay Amount: {{$settings->currency}}{{$sale->final_amount - $sale->remaining_amount}}
                
                </td>
            </tr>
            @if ($sale->remaining_amount < 0)
            @else
            <tr class="total">
                <td></td>
                <td></td>
                <td>
                    Remaining Ammount: {{$settings->currency}}  
                       <span class="">{{$sale->remaining_amount}}</span>
                </td>
            </tr>
            @endif
            @if ($sale->remaining_amount == 0)
            <tr class="total">
                <td></td>
                <td></td>
                <td>
                   Payment Status:   
                       <span class="text-success"><b>Full Paid</b></span>
                </td>
            </tr>
        @elseif ($sale->remaining_amount < $sale->final_amount)
            <tr class="total">
                <td></td>
                <td></td>
                <td>
                   Payment Status:   
                       <span class="text-warning"><b>Some Paid</b></span>
                </td>
            </tr>
        @else
            <tr class="total">
                <td></td>
                <td></td>
                <td>
                   Payment Status:   
                       <span class="text-danger"><b>Full Due</b></span>
                </td>
            </tr>
        @endif
        
        </table>
    </div>
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>
