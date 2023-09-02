<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Invoice</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        table{
            font-size: x-small;
        }
        tfoot tr td{
            font-weight: bold;
            font-size: x-small;
        }
        .gray {
            background-color: lightgray
        }
        .font{
            font-size: 15px;
        }
        .authority {
            /*text-align: center;*/
            float: right
        }
        .authority h5 {
            margin-top: -10px;
            color: #263068;
            /*text-align: center;*/
            margin-left: 35px;
        }
        .thanks p {
            color: #263068;;
            font-size: 16px;
            font-weight: normal;
            font-family: serif;
            margin-top: 20px;
        }
    </style>

</head>
<body>

<table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
    <tr>
        <td valign="top">
            <!-- {{-- <img src="" alt="" width="150"/> --}} -->
            <h2 style="color: #263068; font-size: 26px;"><strong>Homes</strong></h2>
        </td>
        <td align="right">
            <pre class="font" >
               Homes Head Office
               Email:support_homes@gmail.com <br>
               Mob: 676 11 31 89 <br>
               Douala, Makepe :#4 <br>

            </pre>
        </td>
    </tr>

</table>


<table width="100%" style="background:white; padding:2px;"></table>

<table width="100%" style="background: #F7F7F7; padding:0 5 0 5px;" class="font">
    <tr>
        <td>
            <p class="font" style="margin-left: 20px;">
                <strong>Name:</strong> {{ $package_plan->user->name }} <br>
                <strong>Email:</strong> {{ $package_plan->user->email }} <br>
                <strong>Phone:</strong> {{ $package_plan->user->phone }} <br>

                <strong>Address:</strong>{{ $package_plan->user->address }}

            </p>
        </td>
        <td>
            <p class="font">
            <h3><span style="color: #263068;">Invoice:</span> #{{ $package_plan->invoice }}</h3>
            Order Date: {{ $package_plan->created_at }} <br>
            Payment Type : COD </span>
            </p>
        </td>
    </tr>
</table>
<br/>
<h3>Property Package <code>({{$package_plan->name}})</code> </h3>




<table width="100%">
    <thead style="background-color: #263068; color:#FFFFFF;">
    <tr class="font">

        <th>Package Name </th>
        <th class="text-end">Property Quantity</th>
        <th class="text-end">Unit cost</th>
        <th class="text-end">Total</th>
    </tr>
    </thead>
    <tbody>


    <tr class="font">
        <td align="center"> {{ $package_plan->name }}</td>
        <td align="center"> {{ $package_plan->credit }}</td>
        <td align="center">$ {{ $package_plan->amount }}</td>
        <td align="center">$ {{ $package_plan->amount }}</td>

    </tr>

    </tbody>
</table>


<div class="thanks mt-3">
    <p>Thanks For Buying Package..!!</p>
</div>
<div class="authority float-right mt-5">
    <p>-----------------------------------</p>
    <h5>Authority Signature:</h5>
</div>
</body>
</html>
