<!-- @extends('layouts.app') -->

@section('styles')
<style>
    body{
        display: flex;
flex-flow: column-reverse;
    }
    .StripeElement {
        background-color: white;
        padding: 8px 12px;
        border-radius: 4px;
        border: 1px solid transparent;
        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }
    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }
    .StripeElement--invalid {
        border-color: #fa755a;
    }
    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }
</style>
@endsection

@section('content')
<div class="row">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a class="" href="{{ url('productlist')}}">Product List</a>
            <div class="card">
               <!--  <div class="card-header">Product detail</div> -->

                <div class="card-body">
                    @if (session('alert-success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('alert-success') }}
                        </div>
                    @endif
                     <div class="thumbnail card">
                               
                                <div class="caption card-body">
                                     <div class="card-block">
                                                     <h4 class="sub-title">Product Details</h4>
                                                     <p>Product Id :{{ $product->id }}</p>
                                                     <p>Product Name :{{ $product->name }}</p>
                                                     <p>Product Description :{{ $product->description }}</p>
                                                    
                                     </div>
                                </div>
                    </div>

                    @if(session('message'))
                        <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
                    @endif
                    <form action="{{ route('single.charge') }}" method="POST" id="checkout-form">
                        @csrf
                       
                        <!-- <label for="price">Product Price</label> <br> -->
                        <input type="hidden" name="amount" value="{{ $product->price }}"> <br>
                  
                        <label for="card-holder-name">Card Holder Name</label> <br>
                        <input id="card-holder-name" type="text" class="form-control" value="Sabari Giri">

                        <div class="form-row">
                            <label for="card-element">Credit or debit card</label>
                            <div id="card-element" class="form-control">
                            </div>
                            <!-- Used to display form errors. -->
                            <div id="card-errors" role="alert"></div>
                        </div>
                        <div class="stripe-errors"></div>
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                            @endforeach
                        </div>
                        @endif
                        <br>
                        <div class="form-group text-center">
                            <button id="card-button" class="btn btn-dark" type="submit" data-secret="{{ $intent->client_secret }}"> Pay </button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
</div>

@section('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
    var stripe = Stripe('{{ env('STRIPE_KEY') }}');
    var elements = stripe.elements();
    var style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };
    var card = elements.create('card', {hidePostalCode: true,
        style: style});
    card.mount('#card-element');
    card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });
    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');
    const clientSecret = cardButton.dataset.secret;
    cardButton.addEventListener('click', async (e) => {
        e.preventDefault();
        console.log("attempting");
        const { setupIntent, error } = await stripe.confirmCardSetup(
            clientSecret, {
                payment_method: {
                    card: card,
                    billing_details: { name: cardHolderName.value }
                }
            }
            );
        if (error) {
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = error.message;
        } else {
            paymentMethodHandler(setupIntent.payment_method);
        }
    });
    function paymentMethodHandler(payment_method) {
        var form = document.getElementById('checkout-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'text');
        hiddenInput.setAttribute('name', 'payment_method');
        hiddenInput.setAttribute('value', payment_method);
        form.appendChild(hiddenInput);
        form.submit();
    }
</script>
@endsection