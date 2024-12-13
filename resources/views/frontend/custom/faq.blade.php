@extends('frontend.layouts.app')

@section('content')

<section class="pt-5 pb-9 dark-orange-bg balsamiq_font faq_section">
    
    <div class="mainhed text-center pb-4">
        <h4 class="heading_one heading_font1 green_color text-capitalize text-center">Frequently Asked 
<span class="yellow_color"> Questions</span></h4>
    </div>
    <div class="container">
         <div class="row justify-content-center">
        <div class="col-md-8" style="position: relative;
    z-index: 1;">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
               
                 <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                 How do I take care of cut flowers?
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            <p>Trim the stems at a 45-degree angle before placing them in water. Change the water every two to three days and re-cut the stems to maintain water absorption. Keep the flowers away from direct sunlight, drafts, and fruit as they can shorten the lifespan of the blooms. </p>
                        </div>
                    </div>
                </div>
                
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingTwo">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                               How long do cut flowers usually last?
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                        <div class="panel-body">
                            <p>The lifespan of cut flowers can vary depending on the type of flower, but on average, they can last anywhere from a few days to a couple of weeks. Proper care, such as regular water changes and trimming stems, can help prolong their freshness. </p>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingThree">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                               What are some popular flowers for different occasions? 
                            </a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                        <div class="panel-body">
                            <p>Roses are commonly associated with romance and are popular for anniversaries or Valentine's Day. Lilies are often used for funerals or sympathy arrangements. Sunflowers and daisies are great for cheerful occasions like birthdays or get-well wishes. Tulips and daffodils are popular for spring celebrations, and orchids are often given as elegant gifts.</p>
                        </div>
                    </div>
                </div>
                
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingFour">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                What flowers are best for indoor houseplants?
                            </a>
                        </h4>
                    </div>
                    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                        <div class="panel-body">
                            <p>Some popular flowers that thrive as indoor houseplants include peace lilies, spider plants, pothos, African violets, and orchids. These plants generally tolerate indoor conditions well and can add beauty to your living space.</p>
                        </div>
                    </div>
                </div>
                
                
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingFive">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                How do I make fresh flowers last longer in a vase?
                            </a>
                        </h4>
                    </div>
                    <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                        <div class="panel-body">
                            <p>To extend the life of fresh flowers in a vase, add flower food to the water, as it contains nutrients that nourish the blooms. Keep the water clean by changing it every two to three days and cutting the stems at an angle. Remove any leaves that would be submerged in water as they can promote bacterial growth.</p>
                        </div>
                    </div>
                </div>
                
                
            </div>
            
            <div class="shape shape-1">
						<img src="{{ static_asset('assets/img/faq-shape.png') }}" alt="Image">
					</div>
					<div class="shape shape-2">
						<img src="{{ static_asset('assets/img/faq-shape.png') }}" alt="Image">
					</div>
        </div>
    </div>
    </div>
</section>

@endsection