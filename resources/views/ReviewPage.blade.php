
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/Review.css') }}">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inria+Serif&display=swap');
  </style>
</head>
@extends('layouts.app')

@section('title', 'Review- Shopecart')

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

 <div class="sections">
    <section class="Information">
        <div class="info">
            <div class="title">Personal Information</div>
            <div class="info_box">
                <div class="field">First Name</div>
                <div class="content">Fureh </div>
            </div>
            <div class="info_box">
                <div class="field">Last Name</div>
                <div class="content">Mitoto</div>
            </div>
            <div class="info_box">
                <div class="field">Email</div>
                <div class="content">furehmitoto323@gmail.com</div>
            </div>
            <div class="info_box">
                <div class="field">Phone Number</div>
                <div class="content">+237643234576</div>
            </div>
        </div>

        <div class="info">
            <div class="title">Delivery Information</div>
            <div class="info_box">
                <div class="field">Delivery Type</div>
                <div class="content">Pick Up </div>
            </div>
            <div class="info_box">
                <div class="field">Pick Up Store</div>
                <div class="content">St. Mac Factory</div>
            </div>
          
        </div>
        <div class="info">
            <div class="title">Address</div>
            <div class="info_box">
                <div class="field">Country</div>
                <div class="content">Cameroon</div>
            </div>
            <div class="info_box">
                <div class="field">City</div>
                <div class="content">Yaounde</div>
            </div>
            <div class="info_box">
                <div class="field">State</div>
                <div class="content">Centre</div>
            </div>
            <div class="info_box">
                <div class="field">Zip Code</div>
                <div class="content">11235</div>
            </div>
        </div>

        <div class="info">
            <div class="title">Payment Information</div>
            <div class="info_box">
                <div class="field">Payment Method</div>
                <div class="content">MTN-MObile Money </div>
            </div>
            <div class="info_box">
                <div class="field">Phone Number</div>
                <div class="content">643234576</div>
            </div>
            
        </div>
        <div class="edit">
            <div>Edit</div>
           
        </div>
    </section>

    <section class="Order_summary">
        <div class="order_items">
            <div class="title">Order Summary</div>
            <div class="items">
                <div class="item">
                    <img src="./assets/images/headphone.jpeg" alt="headphone image">
                    <div class=" Details">
                        <div class="top">HeadPhones-Max</div>
                        <div>color: red</div>
                    </div>
                     <div class=" Details">
                        <div class="top">$550.99</div>
                        <div>Quantity: 04</div>
                    </div>
                </div>
                <div class="item">
                    <img src="./assets/images/headphone.jpeg" alt="headphone image">
                    <div class=" Details">
                        <div class="top">HeadPhones-Max</div>
                        <div>color: red</div>
                    </div>
                     <div class=" Details">
                        <div class="top">$550.99</div>
                        <div>Quantity: 04</div>
                    </div>
                </div>
            </div>
        </div>
       
        <div class="Total">
            <div class="total_field">
                <div>Sub Total</div>
                <div>$751.99</div>
            </div>
              <div class="total_field">
                <div>Discount</div>
                <div>$40</div>
            </div>
              <div class="total_field">
                <div>Tax</div>
                <div>$15.23</div>
            </div>
              <div class="total_field">
                <div>Delivery</div>
                <div>$5.99</div>
            </div>
              <div class="total_field">
                <div class="total"> Total</div>
                <div class="total">$1598.23</div>
            </div>


        </div>
        <div class="payment">Proceed To Payment</div>

    </section>
 </div>
  

        
    </main>


 
</body>
@endsection