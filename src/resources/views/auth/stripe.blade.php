<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Stripe決済</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://js.stripe.com/v3/"></script>
</head>
<body>

<h1>Stripe 決済テスト</h1>

<form id="payment-form" method="POST" action="/stripe/charge">
  @csrf
  <div id="card-element"></div>
  <button type="submit">支払う</button>
</form>

<script>
console.log('Stripe JS loaded');

const stripe = Stripe('{{ config('services.stripe.key') }}');
const elements = stripe.elements();
const card = elements.create('card');
card.mount('#card-element');

const form = document.getElementById('payment-form');

form.addEventListener('submit', async (e) => {
  e.preventDefault();

  console.log('submit clicked');

  const { paymentMethod, error } = await stripe.createPaymentMethod({
    type: 'card',
    card: card,
  });

  if (error) {
    console.error(error);
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
