<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Order Notification</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background-color: #f8f9fa; padding: 20px; border-radius: 5px; margin-bottom: 20px;">
        <h1 style="color: #2c3e50; margin-bottom: 20px;">New Order Received</h1>
        <p>Hello Admin,</p>
        <p>A new order has been placed with the following details:</p>
    </div>

    <div style="background-color: #ffffff; padding: 20px; border: 1px solid #dee2e6; border-radius: 5px;">
        <h2 style="color: #2c3e50; font-size: 18px;">Order Details</h2>
        <p><strong>Order ID:</strong> {{ $order->id }}</p>
        <p><strong>Customer Name:</strong> {{ $order->name }}</p>
        <p><strong>Invoice ID:</strong> {{ $order->invoice_id }}</p>
        <p><strong>Email:</strong> {{ $order->email }}</p>
        <p><strong>Phone:</strong> {{ $order->phone }}</p>
        <p><strong>Total Amount:</strong> ${{ number_format($order->total, 2) }}</p>

    </div>

    <div style="margin-top: 20px; padding: 20px; background-color: #f8f9fa; border-radius: 5px;">
        <p style="margin: 0;">Best regards,<br>{{ companyInfo()->title }}</p>
    </div>
</body>
</html>
