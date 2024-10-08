<!DOCTYPE html>
<html>

<head>
  <title>Cart Reminder</title>
</head>

<body>
  <!--<p>Click <a href="{{ url('/cart') }}">here</a> to view your cart and complete your purchase.</p>-->
  <!--<p>Dear {{ $user->name }},</p>-->
  <img style="width:100px;margin-left:auto;margin-right:auto;display:block;padding-bottom: 20px;"
    src="https://www.atfleurs.com/public/uploads/all/GlSAfVRZ8L2h63Cd42m12yIbcgOIQ1AduUybmPgn.webp">
  <div style="width: 600px;margin-left:auto;margin-right:auto;display:block;background: #e18a141a;padding: 20px 30px;">
    <p style="text-align:center;padding-bottom: 16px;">Dear {{ $user->name}},</p>
    <img style="width:80px; margin-left:auto; margin-right:auto; display:block;"
      src="https://www.atfleurs.com/public/assets/img/cart_reminder.png">
    <p style="font-size: 30px; text-align: center; padding-bottom: 0px; margin: 0px; color: #e18a14; font-weight: 600; padding-top: 16px;">Still in your cart</p>
    <p style="text-align: center; font-size: 16px; margin: 0; padding-top: 6px; padding-bottom: 22px;">You have items in your cart that are still waiting for you!</p>
    <h3 style="font-size: 24px; text-align: center; margin: 0;">Here are your items</h3>
    <div style="padding: 1.5rem;">
        <table class="padding text-center small" style="width: 100%; border-collapse: collapse; border: 1px solid #ddd;">
            <thead>
                <tr class="gry-color" style="background: #eceff4; text-align: center;">
                    <th width="35%" style="border: 1px solid #ddd; padding: 8px;">{{ translate('Product Name') }}</th>
                    <th width="10%" style="border: 1px solid #ddd; padding: 8px;">{{ translate('Qty') }}</th>
                    <th width="15%" style="border: 1px solid #ddd; padding: 8px;">{{ translate('Unit Price') }}</th>
                </tr>
            </thead>
            <tbody class="strong">
                @foreach ($user->carts as $key => $cartItem)
                    @if ($cartItem->product != null)
                        <tr>
                            <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">
                                {{ $cartItem->product->getTranslation('name') }}
                                @if($cartItem->variation != null) ({{ $cartItem->variation }}) @endif
                            </td>
                            <td style="border: 1px solid #ddd; padding: 8px; text-align: center;" class="gry-color">{{ $cartItem->quantity }}</td>
                            <td style="border: 1px solid #ddd; padding: 8px; text-align: center;" class="gry-color currency">{{ single_price($cartItem->price/$cartItem->quantity) }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <div class style="text-align: center;">
      <a href="{{ route('cart') }}?source=gmail" style="text-align:center;background: #e18a14;color: #fff;padding: 7px 16px;border-radius: 43px;display: inline-block;margin-top: 20px;cursor: pointer; font-size:12px; text-decoration:none; font-weight:600;">Complete Your Order</a>
    </div>
    <p  style="font-size: 24px; text-align:center; padding-top:20px;">Thank you!</p>
  </div>
</body>

</html>