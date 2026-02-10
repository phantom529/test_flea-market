<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Stripe決済</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>

<h2>お支払い金額：¥{{ number_format($item->price) }}</h2>

<form id="payment-form" method="POST" action="/stripe/charge">
    @csrf

    <input type="hidden" name="amount" value="{{ $item->price }}">
    <input type="hidden" name="item_id" value="{{ $item->id }}">

    <div id="card-element"></div>

    <button type="submit">支払う</button>
</form>

<script>
const stripe = Stripe("{{ config('services.stripe.key') }}");
const elements = stripe.elements();
const card = elements.create('card');
card.mount('#card-element');

const form = document.getElementById('payment-form');

form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const { paymentMethod, error } = await stripe.createPaymentMethod({
        type: 'card',
        card: card,
    });

    if (error) {
        alert(error.message);
        return;
    }

    const hidden = document.createElement('input');
    hidden.type = 'hidden';
    hidden.name = 'payment_method';
    hidden.value = paymentMethod.id;
    form.appendChild(hidden);

    form.submit();
});
</script>

</body>
</html>
