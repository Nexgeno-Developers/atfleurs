@extends('frontend.layouts.app')

@section('content')

<style>


    .services_items {
  margin-top: 4rem;
}
.image {
  width: 600px;
  height: 500px;
}

.imgContainer img {
  width: 100%;
  border-radius: 0 150px 0 150px;
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

.content_container{
    background:#fbeede;
    padding:1rem 1rem;
    transition:all 0.3s ease;
    height: 22rem;
    margin-top: 2rem;
    border-bottom:4px solid #fbeede;
    
    
}

.content_container:hover{
    border-bottom:4px solid black;
}

.content_container .heading{
    font-size: 16px;
    font-weight: 700;
    margin-top: 1rem;
    margin-bottom: 20px;
}
.content_container .desc{
    font-size: 14px;
    line-height: 2;
}

/*.career_box{*/
/*    padding:0 3rem;*/
/*}*/
.career_box_1{
    padding: 2.5rem 4rem;
     background:#fbeede;
    
    
}

.button_career{
    border: none;
    padding: 15px 20px;
    border-radius: 10px;
    background: black;
    color: white;
    font-size: 20px;
    font-weight: 600;
    transition:all 0.3s ease;
    border:1px solid black;
    
}

.button_career:hover{
    background:transparent;
    border:1px solid black;
    color:black;
}

.balsamiq_font{
    background:white;
}

</style>

<section class="career_page">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="pt-5 text-center position_relative align-items-">
                   <h3 class="h2 fw-700 mb-0 heading_font1">
                            <span class="border-bottom border-primary border-width-2 pb-2 d-inline-block">Careers</span>
                        </h3>
                    
                            
                </div>
        </div>
        <div class="row">
            <div class="col-md-12 textContainer pb-5">
              <p class="pt-4 text-center">Welcome to At Fleurs, Mumbai's one-stop destination for all things floral. We are glad that you are considering joining our team. We foster a dynamic and inclusive work environment that ensures our team members thrive and grow to the best of their potential. 
</p>


<p class="text-center">If you are passionate about flowers and are committed to exceptional customer service experience, then we are looking for you. </p>
        
        <p class="text-center">Please email us at <a href="mailto:atfleurss@gmail.com">atfleurss@gmail.com</a>, and we will get back to you. </p>      
            </div>
          
          </div>
        
    </div>
 
</section>

@endsection