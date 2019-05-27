<!DOCTYPE html>
<html>
<head>
    <style>

        table {
            border-collapse: collapse;
            width: 100%;
        }

        tr {
            border-bottom: 1px solid #ccc;
        }

        th {
            text-align: left;
        }
    </style>
</head>

<body>


<div class="container">
    <h3> Hi! </h3>

    <h4> You've subscribed to receive more info about {{ $product->name }}. Here it is. </h4>

    <table>
        <tr>
            <td> <strong> Name </strong> </td>
            <td> {{ $product->name }} </td>
        </tr>
        <tr>
            <td> <strong> Image </strong> </td>
            <td> <img src="{{ $product->image }}" alt="{{ $product->name }}"> </td>
        </tr>
        <tr>
            <td> <strong> Price </strong> </td>
            <td> $ {{ $product->price }} </td>
        </tr>
        <tr>
            <td> <strong> Description </strong></td>
            <td> {{ $product->description }} </td>
        </tr>
        <tr>
            <td> <strong> Sold by </strong> </td>
            <td>
                <a href="{{ url('/') . $product->retailer->path() }}">
                    {{ $product->retailer->name }}
                </a>
            </td>
        </tr>
    </table>
</div>

</body>

</html>
