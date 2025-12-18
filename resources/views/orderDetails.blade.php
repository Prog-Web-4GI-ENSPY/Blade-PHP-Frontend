

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="{{ asset('assets/css/orderDetailsMain.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/header.css') }}">

  <!-- Utilisation de Font Awesome pour les icônes -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script defer src="{{ asset('assets/js/newsletter.js') }}"></script>
  <script src="{{ asset('assets/js/header.js') }}"></script>
</head>
@extends('layouts.app')

@section('title', 'OrderDetails- Shopecart')

@section('content')
<body>

  <main>

    <div class="section_list">

      <div class="Order_Details">Order Details</div>
      <i class="fas fa-angle-right" style="    height: 15px;
    color: #1e40af"></i>

      <div class="Review">Review</div>
      <i class="fas fa-angle-right" style="    height: 15px;
    color: #1e40af"></i>
      <div class="Payment">Payment</div>


    </div>


    <div class="personal_info">
      <h1>Personal Information</h1>
      <div class="person_fields">
        <div class="info">
          <div class="description">First Name
            <span class="important">*</span>
          </div>
          <input type="text" class="firstname" placeholder="first Name">
        </div>
        <div class="info">
          <div class="description">Last Name
            <span class="important">*</span>
          </div>
          <input type="text" class="lastname" placeholder="last name">
        </div>
        <div class="info">
          <div class="description">Email
            <span class="important">*</span>
          </div>
          <input type="text" class="email" placeholder="email@gmail.com">
        </div>
        <div class="info">
          <div class="description">Phone Number
            <span class="important">*</span>
          </div>
          <div class="phone_field">
            <select name="country_code">
              <option value="+237">+237</option>
              <option value="+234">+234</option>
              <option value="+1">+1</option>
            </select>
            <input type="tel" class="phoneNumber" placeholder="6XXXXXXXX ">
          </div>

        </div>
      </div>
    </div>



    <div class="Delivery_info">
      <h1>Delivery Information</h1>

      <div class="DeliveryOptions">
        <div class="description">Delivery Type</div>

        <div class="delivery_options">
          <div class="delivery_option">
            <input type="radio" value="Pick_up" name="delivery_option">
            <div>Pick Up</div>
          </div>
          <div class="delivery_option">
            <input type="radio" value="Home Delivery" name="delivery_option">
            <div>Home Delivery</div>
          </div>
        </div>



      </div>
    </div>

    <div class="address">

      <h1>Address Information</h1>
      <div class="fields">

        <div class="info">
          <div class="description">Country
            <span class="important">*</span>
          </div>
          <input type="text" class="country" placeholder="Cameroon">
        </div>
        <div class="info">
          <div class="description">City
            <span class="important">*</span>
          </div>
          <input type="text" class="city" placeholder="Yaounde">
        </div>

        <div class="info">
          <div class="description">State


          </div>
          <input type="text" class="state" placeholder="Center">

        </div>

        <div class="info">
          <div class="description">Zip Code


          </div><input type="number" class="zipCode" placeholder="Center">
        </div>

      </div>

    </div>

    <div class="Payment_Info">

      <h1>Payment Details</h1>
      <div class="description">Payment Method</div>
      <div class="payment_methods">


        <label class="payment_method">
          <input type="radio" name="payment" value="mtn mobile money">
          <img src="./assets/images/mtn.png" alt="mobile money">
        </label>
        <label class="payment_method">
          <input type="radio" name="payment" value="orange money">
          <img src="./assets/images/orange.png" alt="orange money">
        </label>
        <label class="payment_method">
          <input type="radio" name="payment" value="card" required>

          <div class="cards">
            <img src="./assets/images/mastercard.png" alt="mastercard">
            <img src="./assets/images/paypal.jpg" alt="paypal">
          </div>
        </label>

      </div>

    </div>
    <button type="submit" class="review">Proceed to Review</button>

  </main>


</body>

@endsection