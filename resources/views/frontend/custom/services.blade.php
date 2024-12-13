@extends('frontend.layouts.app')

@section('content')
<style>
.balsamiq_font{
    background: #fff
}
.services_heading {
  display: flex;
  align-items: center;
  justify-content: center;
}

/*.services_heading h2 {*/
/*  margin-bottom: 3rem;*/
/*}*/

.services_items {
  margin-top: 4rem;
}
.image {
  width: 100%;
  height: 100%;
}

.imgContainer img {
  width: 100%;
}

 .textContainer{
display: flex;
justify-content: center;
flex-direction: column;
}

.textContainer .title {
  margin-bottom: 10px;
}
.textContainer .desc {
  margin-bottom: 30px;
  line-height:30px;
}

.textContainer .desc {
  font-size: 16px;
}

@media (max-width:767px){
    .image {
    width: 100%;
    height: 100%;
}

.services_items {
    margin-top: 1rem;
}

.textContainer {
    margin-top: 2rem;
}
}

</style>

 <section class="pt-5 pb-5 balsamiq_font">
      <div class="container">
        <div class="row px-3 px-md-5">
          <div class="col-12 services_heading">
            <div class="align-items-baseline text-center">
                   

                 <h4 class="heading_one heading_font1 green_color text-capitalize text-left">Our<span class="yellow_color"> Services</span></h4>


                </div>
          </div>
          <div class="row services_items mt-lg-4">
            <div class="col-md-5 order-md-1 order-2 textContainer">
              <h3 class="title heading_font1">Online Ordering</h3>
              <p class="desc">
                Flower websites allow customers to conveniently browse through
                their selection of flowers and place orders online. This saves
                time and offers flexibility in choosing the desired
                arrangements.
              </p>
              <h3 class="title heading_font1">Wide Selection of Flowers</h3>
              <p class="desc">
                Flower websites typically offer a diverse variety of flowers to
                suit various occasions and preferences. Customers can find
                everything from classic roses to exotic blooms, seasonal
                flowers, and unique arrangements
              </p>
            </div>
            <div class="col-md-7 order-md-2 order-1 imgContainer d-flex justify-content-end">
              <div class="image">
                  <img class="img-fit" src="{{ static_asset('assets/img/services_img1.jpg') }}">
                
              </div>
            </div>
          </div>
          <div class="row services_items">
            <div class="col-md-7 order-1 imgContainer">
              <div class="image">
                   <img class="img-fit" src="{{ static_asset('assets/img/services_img2.jpg') }}">
                
              </div>
            </div>
            <div class="col-md-5 order-2 textContainer">
              <h3 class="title heading_font1">Customization Options</h3>
              <p class="desc">
                Many flower websites allow customers to customize their orders.
                This may include selecting specific flowers, colors, bouquet
                sizes, vase options, and additional add-ons like balloons,
                chocolates, or greeting cards.
              </p>
              <h3 class="title heading_font1">Delivery Services</h3>
              <p class="desc">
                Flower websites often provide reliable and timely delivery
                services. Customers can specify the delivery date and address,
                ensuring that the flowers reach their intended recipients on a
                specific day or for a special occasion.
              </p>
            </div>
          </div>
          <div class="row services_items">
            <div class="col-md-5 order-md-1 order-2 textContainer">
              <h3 class="title heading_font1">Same-Day Delivery</h3>
              <p class="desc">
                Some flower websites offer same-day delivery services for orders
                placed within a certain time frame. This is especially useful
                for last-minute gifts or surprise arrangements
              </p>
              <h3 class="title heading_font1">Subscriptions</h3>
              <p class="desc">
                Many flower websites provide subscription services where
                customers can sign up for regular flower deliveries. This is an
                excellent option for those who enjoy fresh flowers regularly or
                for corporate clients who want regular floral arrangements for
                their office space
              </p>
            </div>
            <div class="col-md-7 order-md-2 order-1 imgContainer d-flex justify-content-end">
              <div class="image">
                   <img class="img-fit" src="{{ static_asset('assets/img/services_img3.jpg') }}">
                
              </div>
            </div>
          </div>
          <div class="row services_items">
            <div class="col-md-7 imgContainer">
              <div class="image">
                   <img class="img-fit" src="{{ static_asset('assets/img/services_img4.jpg') }}">
                
              </div>
            </div>
            <div class="col-md-5 textContainer">
              <h3 class="title heading_font1">Occasion-specific Collections</h3>
              <p class="desc">
                Occasion-specific Collections: Flower websites may curate
                specific collections for occasions like birthdays,
                anniversaries, weddings, or sympathy flowers. These collections
                help customers quickly find appropriate floral arrangements for
                specific events or sentiments.
              </p>
              <h3 class="title heading_font1">Additional Gifts</h3>
              <p class="desc">
                In addition to flowers, some websites offer a selection of
                additional gifts like gourmet baskets, teddy bears, spa
                products, or wine/champagne to complement the floral
                arrangements.
              </p>
            </div>
          </div>
          <div class="row services_items">
            <div class="col-md-5 order-md-1 order-2 textContainer ">
              <h3 class="title heading_font1">Wedding and Event Services</h3>
              <p class="desc">
                Many flower websites provide specialized services for weddings
                and events. They can work closely with customers to create
                customized floral designs, bouquets, centerpieces, and venue
                decorations to match the desired theme and ambiance.
              </p>
              
            </div>
            <div class="col-md-7 order-md-2 order-1 imgContainer d-flex justify-content-end">
              <div class="image">
                   <img class="img-fit" src="{{ static_asset('assets/img/services_img5.jpg') }}">
               
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

@endsection