function readFields() {
  const firstname = document.querySelector(".firstname")?.value;
  const lastname = document.querySelector(".lastname")?.value;
  const email = document.querySelector(".email")?.value;
  const country_code = document.querySelector(".country_code")?.value || "";
  const phoneNumber = country_code + (document.querySelector(".phoneNumber")?.value);

  let deliveryOption = document.querySelector("input[name='delivery_option']:checked");
  if (deliveryOption) deliveryOption = deliveryOption.value;

  const state = document.querySelector(".state")?.value;
  const city = document.querySelector(".city")?.value;
  const zipCode = document.querySelector(".zipCode")?.value;

  let paymentMethod = document.querySelector("input[name='payment']:checked");
  if (paymentMethod) paymentMethod = paymentMethod.value;
  let paymentInfo;
  if(paymentMethod=="mtn mobile money" || paymentMethod=="orange money"){
    paymentInfo={phoneNumber:document.querySelector(".paymentNumber").value}

  }
  else if(paymentMethod=="card"){
    paymentInfo={
      cardType:document.getElementById("cardType").value,
      cardHolder:document.querySelector(".cardHolder").value,
      cardNumber:document.querySelector(".cardNumber").value,
      CCV:document.querySelector(".CCV").value,
      ExpDate:document.querySelector(".expiryDate").value


    }
  }

  return {
    firstname,
    lastname,
    email,
    country_code,
    phoneNumber,
    deliveryOption,
    state,
    city,
    zipCode,
    paymentMethod,
    paymentInfo
  };
}

const form = document.getElementById("form");
form.addEventListener("submit", (e) => {
  e.preventDefault();
  const data = readFields();
  console.log(data);
});

const cardPayment=document.getElementById("Card_payment")
const numberPayment=document.getElementById("Number_payment")

let clicked;
 let deliveryOption = document.querySelectorAll("input[name='payment']");
 
deliveryOption.forEach(option =>{
 option.addEventListener("click",()=>{
  hide()
  if(option.value=="mtn mobile money"){
    numberPayment.className="Number_payment"
  }
  else if(option.value=="orange money"){
    numberPayment.className="Number_payment"
  }
 else if(option.value=="card"){
  cardPayment.className="Card_payment"
 }
  
 })
})

const hide=()=>{
  cardPayment.className="disappear"
  numberPayment.className="disappear"
}