

const data={
    firstName:"fureh",
    lastName:"mitoto",
    email:"furehmitoto@gmail.com",
    phoneNumber:"+237683456789",
    deliveryType:"Pick Up",
    pickUpStore:"St.Mac Jewelries",
    country:"Cameroon",
    city:"Yaounde",
    state:"Centre",
    zipCode: "11233",
    paymentMethod:"mtn mobile money",
    paymentNumber:6830213842,
    cartItems:[
        {image:"./assets/images/headphone.jpeg",
        name:"HeadPhones Max",
        unitPrice:550.99,
        quantity:4,
        color:"red"},
        {image:"./assets/images/headphone.jpeg",
        name:"HeadPhones Max",
        unitPrice:550.99,
        quantity:4,
        color:"red"},
        ,
        {image:"./assets/images/headphone.jpeg",
        name:"HeadPhones Max",
        unitPrice:550.99,
        quantity:4,
        color:"red"}
    ],
    tax: 200.99,
    delivery: 64.34,
    discount: 25.53

}

document.querySelector(".firstName").textContent = data.firstName;
document.querySelector(".lastName").textContent = data.lastName;
document.querySelector(".email").textContent = data.email;
document.querySelector(".phoneNumber").textContent = data.phoneNumber;
document.querySelector(".deliveryType").textContent = data.deliveryType;
document.querySelector(".pickUpStore").textContent = data.pickUpStore;
document.querySelector(".country").textContent = data.country;
document.querySelector(".city").textContent = data.city;
document.querySelector(".state").textContent = data.state;
document.querySelector(".zipCode").textContent = data.zipCode;
document.querySelector(".paymentMethod").textContent = data.paymentMethod;
document.querySelector(".paymentNumber").textContent = data.paymentNumber;
console.log("loaded")

 let subTotal=0;

let itemdiv=document.querySelector(".items")
data.cartItems.forEach(item =>{
    let div=document.createElement("div")
    div.className="item"
    div.innerHTML=`
                    <img src="${item.image}" alt="${item.image}">
                    <div class=" Details">
                        <div class="top">${item.name}</div>
                        <div>color: ${item.color}</div>
                    </div>
                     <div class=" Details">
                        <div class="top">$${item.unitPrice}</div>
                        <div>Quantity: ${item.quantity}</div>
                    </div>
                `
    itemdiv.appendChild(div)
    subTotal+=item.unitPrice*item.quantity

})

let total=subTotal+data.tax+data.discount+data.delivery

document.querySelector(".subTotal").textContent=subTotal;
document.querySelector(".discount").textContent=data.discount
document.querySelector(".tax").textContent=data.tax
document.querySelector(".delivery").textContent=data.delivery

document.querySelector(".TotalValue").textContent=total