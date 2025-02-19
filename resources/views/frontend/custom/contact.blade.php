@extends('frontend.layouts.app')

@section('content')
<script src="https://kit.fontawesome.com/4a1e1e10cb.js" crossorigin="anonymous"></script>
<style>
   #contactus-intro section.contact-media.bg-offwhite {
        padding: 45px 0;
    }

    #contactus-intro {
    background-color: rgb(255 255 255);
}

   #contactus-intro section.contact-media h2:before {
        content: "";
        border-bottom: 3px solid #34ccff;
        width: 50px;
        display: none;
        margin-bottom: 33px;
        border-radius: 2px;
        margin-bottom: 35px;
    }

   #contactus-intro .row.contactus h2:before {
        /* margin-top: 30px; */
        content: "";
        border-bottom: 3px solid #34ccff;
        width: 50px;
        display: none;
        margin-bottom: 33px;
        border-radius: 2px;
        margin-bottom: 35px;
    }

   #contactus-intro .row.contactus p {
        font-size: 16px !important;
        font-style: normal;
        margin-bottom: 16px;
        line-height: 26px;
        color:black;
    }

    #contactus-intro .row.contactus {
        height: auto;
        padding: 0px 10px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

   #contactus-intro .col-md-12.first-coloum-of-form {
        line-height: 26px;

    }

   #contactus-intro .col-md-12.second-coloum-of-form {
        line-height: 10px;

    }

   #contactus-intro .row.contactus .form-button.col-md-12 button {
    color: rgb(255 255 255);
    border-radius: 5px;
    border: 0px solid #d4540c;
    padding: 15px 40px;
    background-color: rgb(213, 148, 60);
    background: #32533D;
    color: #fff !important;
    padding: 14px 30px;
    border-radius: 50px;
    font-size: 16px;


    }

   #contactus-intro  .row.contactus .form-button.col-md-12 button:hover {
color: #333 !important;
    background-color: #E1C259;
    transition: ease-in-out 0.4s;
    }

   #contactus-intro  .form-button.col-md-12 {
        margin: 20px 0px;

    }
   #contactus-intro .form-control:hover {
    border: 1px solid RGB(253 74 24);
    /* border: 1px solid black; */
}
#contactus-intro .form-control {
    padding: 30px 30px 30px 15px;
    font-size: 16px;
    height: calc(1.3125rem + 1.2rem + 2px);
    border: 1px solid transparent;
    color: #898b92;
    background: rgb(247 247 247);
}

    #contactus-intro .form-check {
        display: flex;
        min-height: 1.5rem;
        padding-left: 1.5em;
        margin-bottom: 0.125rem;
        flex-direction: row;
        align-items: center;
        flex-wrap: nowrap;
        align-content: flex-end;
        justify-content: flex-start;
    }

    #contactus-intro .form-check .form-check-input {
        margin: 0px 10px;
        float: left;
        margin-left: -1.5em;
    }

    #contactus-intro .row.contactus .text-center.form-button.col-md-12 {
        padding: 19px 0px;
    }

    #contactus-intro .second-coloum-of-GET-IN-TOUCH {
        padding-left: 35px;
        background: rgb(0, 0, 0);
        color: rgb(255 255 255);
        display: flex;
        flex-direction: column;
        flex-wrap: nowrap;
        justify-content: center;
        background:url("/public/assets/img/con_bg.png");
        background-size: 379px 394px;
        background-repeat: no-repeat;
        background-position: 214px 155px;
        border-radius: 10px;
        border:1px solid #bbbbbb40;



    }

    #contactus-intro .second-coloum-of-GET-IN-TOUCH ul {
    margin: 0;
    list-style: none;
    line-height: 30px;
    padding: 20px 15px 0px 0px;
    color:black;
    }

   #contactus-intro  .second-coloum-of-GET-IN-TOUCH h2 {
        font-size: 32px;
        color:black;

    }

    #contactus-intro .second-coloum-of-GET-IN-TOUCH .row img {
        width: 25px;
        height: 60%;
        object-fit: contain;
    }

   #contactus-intro  .second-coloum-of-GET-IN-TOUCH .row h3 {
        font-weight: 600;
        font-size: 18px;
        color:black;
        margin-bottom:0;
    }

    #contactus-intro .container-form h2 {
        font-size: 32px !important;
        font-weight: 500;
        text-transform: capitalize;
    }

    #contactus-intro .container-form {
        color: black;
        padding: 0px 0px 0px 70px;
        background-color: #fff;
        /* box-shadow: 0px 0px 15px 1px #d7d7d7; */
    }

    #contactus-intro .col-lg-6.col-md-6.col-sm-12.col-xs-12.align-self-center.second-coloum-of-GET-IN-TOUCH {
        padding: 0px 35px;
    }

    #contactus-intro .form-label {
        color: black;
        margin-bottom: 0.5rem;
        font-size: 16px;
        font-family: 'Rubik', sans-serif;
    }

    #contactus-intro .form-select {
        border: 0px !important;
        border-radius: 0px !important;
    }

    #contactus-intro .col-md-1.img-align i {
        font-size: 28px;
        padding: 20px 0px 0px 0px;
    }

    #contactus-intro .second-coloum-of-GET-IN-TOUCH ul a {
        color: rgb(255, 255, 255);
        font-size: 14px;
    }
#contactus-intro .all-text {
    padding: 0px 15px;
    color:black;
}
#contactus-intro .all-text ul a{

    color:black;
}

    #contactus-intro input {

        border-radius: 0px !important;
    }

    #exampleFormControlTextarea1 {
        border-radius: 0px;
    }


    @media(max-width:767px)
    {
        #contactus-intro .container-form {
    color: black;
    padding: 0px 0px 0px 18px;
    background-color: #fff;
    /* box-shadow: 0px 0px 15px 1px #d7d7d7; */
}#contactus-intro .second-coloum-of-GET-IN-TOUCH {
    padding-left: 16px !important;

    margin: 0px 18px;
    padding-top: 17px;
    padding-bottom: 20px;
}
#contactus-intro .second-coloum-of-GET-IN-TOUCH ul {
    margin: 0;
    list-style: none;
    line-height: 30px;
    padding: 10px 0px 0px 0px;
    color: black;
}
#contactus-intro .second-coloum-of-GET-IN-TOUCH .row h3 {
    font-size: 16px;
}
#contactus-intro .container-form h2 {
    font-size: 24px !important;
    font-weight: 500;
    text-transform: capitalize;
    margin-bottom: 0px;
    padding-top: 25px;
    padding-left: 14px;
}


#contactus-intro .second-coloum-of-GET-IN-TOUCH {
    background-size: 256px 252px;
    background-position: 144px 143px;

}

#contactus-intro .form-control {
    padding: 18px 25px 18px 12px;
    font-size: 14px;
}

.form_boxex input {
    margin-bottom: 0 !important;
}

#contactus-intro .row.contactus .form-button.col-md-12 button {
    padding: 10px 20px;

}

.contact_map{
    padding: 10px 10px;
}

.form_boxex .heading_font1{
    text-align:center;
}
    }
</style>

<section class="intro pt-5 pb-5 balsamiq_font" id="contactus-intro">

    <div class="container">
        <div class="row contactus ">

            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 d-flex justify-content-center second-coloum-of-GET-IN-TOUCH">

                     <h4 class="heading_one heading_font1 green_color text-capitalize text-left">Our<span class="yellow_color"> Contacts</span></h4>
                    <div class="row">
                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 img-align col-2">
                            <i class="fa-solid fa-location-dot yellow_color"></i>
                        </div>
                        <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11 all-text col-10">
                            <ul>
                                <h3>Address</h3>
                                <a >
                                    <li>Ground Floor, Title Waves, Road No.24, Opp Duruelo Convent School, Bandra West, Mumbai - 400050</li>
                                </a>




                            </ul>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 img-align col-2">
                            <i class="fa-regular fa-envelope yellow_color"></i>
                        </div>
                        <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11 all-text col-10">

                            <ul>
                                <h3> Email Address </h3>
                                <a onclick="return gtag_report_conversion('mailto: atfleurss@gmail.com');" href="mailto: atfleurss@gmail.com">atfleurss@gmail.com</a>

                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 img-align col-2">
                            <i class="fa-solid fa-phone yellow_color"></i>
                        </div>
                        <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11 all-text col-10">
                            <ul>
                                <h3> Phone Number </h3>
                                <a onclick="return gtag_report_conversion('tel:+91 7070070716');" href="tel:+91 7070070716">+91 7070070716</a> <br>
                               <a onclick="return gtag_report_conversion('tel:+91 9808867777');" href="tel:+91 9808867777">+91 9808867777</a>

                            </ul>
                        </div>
                    </div>

                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pl-md-5 d-flex justify-content-center ">


                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="form_boxex">
                            <form id="contact-form" action="{{ url('/email') }}" method="POST" class="">
                            <!--<form action="{{ route('custom-pages.sendemail') }}" method="POST" class="">-->
                                @csrf
                                <h4 class="heading_one heading_font1 green_color text-capitalize text-left">Request A <span class="yellow_color"> Quote</span></h4>

                                    <div class="row">
                                            <div class="col-md-6 mt-3">

                                                <input required type="name" name="name" placeholder="Your Name" class="form-control"
                                                    id="inputEmail4">
                                            </div>
                                            <div class="col-md-6 mt-3">

                                                <input required type="email" name="email" class="form-control" id="exampleFormControlInput1"
                                                    placeholder="Email">
                                            </div>

                                            <div class="col-md-6 mt-3">

                                                <input required type="number" name="phone" placeholder="Cell Phone" class="form-control"
                                                    id="inputEmail4">
                                            </div>
                                            <div class="col-md-6 mt-3">

                                                <input type="text" name="subject" class="form-control" id="exampleFormControlInput1"
                                                    placeholder="Subject">
                                            </div>

                                             <div class="col-md-12 mt-3 ">

                                            <textarea class="form-control" name="message" id="exampleFormControlTextarea1" placeholder="Your Message"
                                                rows="6"></textarea>
                                        </div>

                                            <!-- 🔹 Google reCAPTCHA Checkbox -->
                                            <div class="col-md-12 mt-3">
                                                <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_SITE_KEY') }}"></div>
                                            </div>

                                        <div class="form-button col-md-12">
                                            <button type="submit"> Send Message
                                                </button>
                                        </div>
                                        </div>

                            </form>
                            </div>
                        </div>

                    </div>

                </div>
            </div>





        </div>

    </div>


</section>

<div class="contact_map">
    <iframe width="1800" height="500" class="location-map" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15084.25208185381!2d72.8323181!3d19.0609666!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c99caa232659%3A0x874a5876bb847733!2sAtfleurs%20%7C%20Hamper%20Gifting%20%7C%20Floral%20Decoration%20%7C%20Flowers%20Gifting%20Shop%20In%20Mumbai!5e0!3m2!1sen!2sin!4v1722921898410!5m2!1sen!2sin" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>




@endsection
@section('script2')
    <!-- 🔹 Load Google reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    {{-- <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("contact-form").addEventListener("submit", function (event) {
                var recaptcha = document.querySelector(".g-recaptcha-response").value;
                if (!recaptcha) {
                    event.preventDefault(); // Stop form submission
                    // alert("Please verify that you are not a robot!"); // Show alert
                    AIZ.plugins.notify('danger', 'Please verify that you are not a robot!');
                }
            });
        });
    </script> --}}

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("contact-form").addEventListener("submit", function (event) {
                var errors = [];
                var name = document.querySelector("[name='name']").value.trim();
                var email = document.querySelector("[name='email']").value.trim();
                var phone = document.querySelector("[name='phone']").value.trim();
                var recaptcha = document.querySelector(".g-recaptcha-response").value;

                // Validate name
                if (!name) {
                    errors.push("Name is required.");
                }

                // Validate email
                if (!email) {
                    errors.push("Email is required.");
                } else if (!/^\S+@\S+\.\S+$/.test(email)) {
                    errors.push("Enter a valid email address.");
                }

                // Validate phone
                if (!phone) {
                    errors.push("Phone number is required.");
                }
                // else if (!/^\d{10}$/.test(phone)) { // Adjust regex as needed
                //     errors.push("Enter a valid 10-digit phone number.");
                // }

                // Set minimum and maximum phone number lengths
                // var minPhoneLength = 7;  // Minimum digits (e.g., UAE, Qatar: 7 digits)
                // var maxPhoneLength = 15; // Maximum digits (e.g., International format: 15 digits)

                // if (!phone) {
                //     errors.push("Phone number is required.");
                // } else if (!/^\d+$/.test(phone)) {
                //     errors.push("Phone number should contain only digits.");
                // } else if (phone.length < minPhoneLength || phone.length > maxPhoneLength) {
                //     errors.push(`Enter a valid phone number (${minPhoneLength}-${maxPhoneLength} digits).`);
                // }

                // Validate reCAPTCHA
                if (!recaptcha) {
                    errors.push("Please verify that you are not a robot!");
                }

                // If errors exist, prevent form submission and show notifications
                if (errors.length > 0) {
                    event.preventDefault();

                    if (typeof AIZ !== 'undefined' && typeof AIZ.plugins !== 'undefined' && typeof AIZ.plugins.notify === 'function') {
                        errors.forEach(function (error) {
                            AIZ.plugins.notify('danger', error);
                        });
                    } else {
                        alert(errors.join("\n")); // Fallback alert
                    }
                }
            });
        });
    </script>


@endsection
