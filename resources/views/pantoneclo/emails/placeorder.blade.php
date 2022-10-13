@component('mail::message')
Dear {{ $order->user->name }},

Thank you for ordering from Pantoneclo!

We are excited for you to receive your order #{{ $order->order_number }} <br>
and will notify you once its on its way. If you have ordered from <br>
multiple sellers, your items will be delivered in separate packages.<br> 
We hope you had a great shopping experience! <br>
You can check your order status here.

Please note, we are unable to change your delivery address once your order is placed.​<br>
Here's a confirmation of what you bought in your order.

<h3>Delivery Details</h3>
<table class="table table-striped">
    <tr>
        <td>Name: </td>
        <td>{{ $order->shipping()->name }}</td>
    </tr>
    <tr>
        <td>Address: </td>
        <td>{{ $order->shipping()->street }}, {{ $order->shipping()->street2 }}, {{ ($order->shipping()->city != 0 ? $order->shipping()->city->name : '') }}, {{ $order->shipping()->state->name }}, {{ $order->shipping()->country->name }}</td>
    </tr>
    <tr>
        <td>Phone: </td>
        <td>{{ $order->shipping()->phone }}</td>
    </tr>
    <tr>
        <td>Email: </td>
        <td>{{ $order->shipping()->email }}</td>
    </tr>
</table>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Image</th>
      <th scope="col">Name</th>
      <th scope="col">Size|Color</th>
      <th scope="col">Quantity|Price</th>
      <th scope="col">Price</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($order->items as $key => $item)
    <tr>
      <th scope="row">{{ $key+1 }}</th>
      <td><img width="40" src="{{ $item->product->image }}"></td>
      <td>{{ $item->product->name }}</td>
      <td>{{ $item->variation }}</td>
      <td>{{ $item->quantity }}*{{ $item->product_price }}</td>
      <td>{{ $item->total_price }}</td>
    </tr>
    @endforeach
  </tbody>
  <tfoot>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>Total</td>
    <td>{{ $order->total }}</td>
  </tfoot>
</table>

Thanks,<br>
Pantoneclo
@endcomponent
