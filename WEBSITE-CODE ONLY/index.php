
<?php

require 'header.php';

?>

<style>
        .gride {
            justify-content: center;
            align-items: center;
            display: flex;
            flex-direction: row;
          height: -webkit-fill-available
        }

        .grid1 {
            width: 80%;
        }
		
		/* Media query for screens smaller than 768px (e.g., tablets and mobile devices) */
    @media (max-width: 768px) {
        
		.gride {
            flex-direction: column; /* Stacks items vertically */
            padding: 10px; /* Adds padding for smaller screens */
        }

        .grid1 {
            width: 100%; /* Makes the image take full width */
            max-width: 300px; /* Optional: limits the maximum size */
            margin-bottom: 15px; /* Adds space between images */

        }
    }
	.modal-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.modal-body {
  padding: 1.5rem; /* Optional for better spacing */
}

.modal-footer {
  padding: 1rem; /* Optional for consistent padding */
}
    </style>

<body class="home-blue">


<!-- rts banner area start -->
<div class="rts-banner-area-two">
    <div class="swiper mySwiperh2_banner">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="banner-two">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="banner-two-content text-center">
                                    <div class="wrapper">
                                        <span class="sub">20+ Years In Business</span>
                                        <h1 class="title">
                                            <span>Leave</span> the<br>
                                            <span class="highlighted-word">Books</span>  to us
                                        </h1>
                                        <a class="rts-btn btn-primary-2" href="#">View Solution</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="banner-two slide-2">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="banner-two-content text-center">
                                    <div class="wrapper">
                                        <span class="sub">20+ Years In Business</span>
                                        <h1 class="title">
                                            <span>Leave</span> the <br>
                                            <span class="highlighted-word">Finance</span>  to us
                                        </h1>
                                        <a class="rts-btn btn-primary-2" href="#">View Solution</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="banner-two slide-3">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="banner-two-content text-center">
                                    <div class="wrapper">
                                        <span class="sub">20+ Years In Business</span>
                                        <h1 class="title">
                                            <span>Leave</span> the <br>
                                            <span class="highlighted-word">Taxes</span> to us
                                        </h1>
                                        <a class="rts-btn btn-primary-2" href="#">View Solution</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- rts banner area end -->



<!-- ANNOUNCEMENT START -->
<div id="announcementModal" class="modal fade" tabindex="-1" aria-labelledby="announcementModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="announcementModalLabel">Announcement</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="announcementBody">
        <!-- Dynamic content will be inserted here -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- ANNOUNCEMENT END -->

<br>

<br><br><br>
  
    <!--<Muddassar yahan ajao>-->
	
	
	 <!-- rts service post area  Start-->
    <div class="rts-service-area rts-section-gapBottom">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="rts-title-area service text-center">
                        <p class="pre-title">
                            Our Services
                        </p>
                        <h2 class="title">High Quality Services</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid service-main plr--120-service mt--50 plr_md--0 pl_sm--0 pr_sm--0">
            <div class="background-service row">
                <!-- start single Service -->
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="service-one-inner one">
                        <div class="thumbnail">
                            <img src="assets/images/service/icon/01.webp" alt="finbiz_service">
                        </div>
                        <div class="service-details">
                            <a href="#">
                                <h5 class="title">Bookkeeping & Accounting </h5>
                            </a>
                            <p class="disc">
                                From bookkeeping to accrual accounting, we have the expertise to get your books done right and on time!
                            </p>
                            <a class="rts-read-more btn-primary" href="#"><i
                                    class="far fa-arrow-right"></i>Read
                                More</a>
                        </div>
                    </div>
                </div>
                <!-- end single Services -->
                <!-- start single Service -->
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="service-one-inner two">
                        <div class="thumbnail">
                            <img src="assets/images/service/icon/02.webp" alt="finbiz_service">
                        </div>
                        <div class="service-details">
                            <a href="#">
                                <h5 class="title">CFO Services</h5>
                            </a>
                            <p class="disc">
                                A fractional C-level business partner to guide key business and financial decisions.
                            </p>
                            <a class="rts-read-more btn-primary" href="#"><i
                                    class="far fa-arrow-right"></i>Read
                                More</a>
                        </div>
                    </div>
                </div>
                <!-- end single Services -->
                <!-- start single Service -->
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="service-one-inner three">
                        <div class="thumbnail">
                            <img src="assets/images/service/icon/03.webp" alt="finbiz_service">
                        </div>
                        <div class="service-details">
                            <a href="#">
                                <h5 class="title">Tax Planning & Preparation</h5>
                            </a>
                            <p class="disc">
                                Expert tax planning, optimization, and filing for small business owners.
                            </p>
                            <a class="rts-read-more btn-primary" href="#"><i
                                    class="far fa-arrow-right"></i>Read
                                More</a>
                        </div>
                    </div>
                </div>
                <!-- end single Services -->
                <!-- start single Service -->
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="service-one-inner four">
                        <div class="thumbnail">
                            <img src="assets/images/service/icon/04.webp" alt="finbiz_service">
                        </div>
                        <div class="service-details">
                            <a href="#">
                                <h5 class="title">Financial Operating System</h5>
                            </a>
                            <p class="disc">
                                DJ Books is the first licensee of The Financial Operating System to help small business owners take control over their business finances and put their businesses to work for them.
                            </p>
                            <a class="rts-read-more btn-primary" href="#"><i
                                    class="far fa-arrow-right"></i>Read
                                More</a>
                        </div>
                    </div>
                </div>
                <!-- end single Services -->
                <!-- start single Service -->
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="service-one-inner five">
                        <div class="thumbnail">
                            <img src="assets/images/service/icon/05.svg" alt="finbiz_service">
                        </div>
                        <div class="service-details">
                            <a href="#">
                                <h5 class="title">Audit & Evaluation</h5>
                            </a>
                            <p class="disc">
                                We Provide businesses with an in-depth analysis of their operations, finances, and performance metrics to ensure compliance, efficiency, and sustainability. By identifying strengths, weaknesses, and areas for improvement, these services enable organizations to make informed decisions, reduce risks, and achieve long-term success. 
                            </p>
                            <a class="rts-read-more btn-primary" href="#"><i
                                    class="far fa-arrow-right"></i>Read
                                More</a>
                        </div>
                    </div>
                </div>
                <!-- end single Services -->
                <!-- start single Service -->
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="service-one-inner six">
                        <div class="thumbnail">
                            <img src="assets/images/service/icon/06.svg" alt="finbiz_service">
                        </div>
                        <div class="service-details">
                            <a href="#">
                                <h5 class="title">Consultancy & Advice</h5>
                            </a>
                            <p class="disc">
                                Empower businesses with expert insights and tailored strategies to overcome challenges and capitalize on opportunities. From financial planning to operational optimization, these services deliver actionable recommendations that drive growth and innovation.
                            </p>
                            <a class="rts-read-more btn-primary" href="#"><i
                                    class="far fa-arrow-right"></i>Read
                                More</a>
                        </div>
                    </div>
                </div>
                <!-- end single Services -->
            </div>
            <div class="row">
                <div class="cta-one-bg col-12">
                    <div class="cta-one-inner">
                        <div class="cta-left">
                            <h3 class="title">Let’s discuss about how we can help
                                make your business better</h3>
                        </div>
                        <div class="cta-right">
                            <a class="rts-btn btn-white" href="Appoinment.php">Lets Work Together</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- rts service post area ENd -->



    <!-- latest service area -->
    <div class="rts-service-area rts-section-gap bg-service-h2">
        <div class="container">
            <div class="row">
                <div class="title-area service-h2">
                    <span>Our Latest Services</span>
                    <h2 class="title">Who We Serve</h2>
					<p>At DJBOOKS, we provide tailored accounting services to meet the diverse needs of our clients across various industries. Our expertise spans multiple sectors, ensuring personalized solutions and exceptional results.</p> </br></br>
                </div>
				
				<div class="title-area service-h2">
                    <h4 class="titles">We proudly Serve</h4>
                </div>
            </div>
            <div class="row g-5 mt--10">
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                    <!-- single service start -->
                    <div class="rts-single-service-h2">
                        <a href="#" class="thumbnail">
                            <img src="assets/images/service/10.jpg" alt="Service_image">
                        </a>
                        <div class="body">
                            <a href="#">
                                <h5 class="title">Small and Medium Businesses (SMBs)</h5>
                            </a>
                            <p class="disc">
                                Streamlining financial operations for growing enterprises.
                            </p>
                            <a href="#" class="btn-red-more">Learn More<i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <!-- single service End -->
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                    <!-- single service start -->
                    <div class="rts-single-service-h2">
                        <a href="#" class="thumbnail">
                            <img src="assets/images/service/11.jpg" alt="Service_image">
                        </a>
                        <div class="body">
                            <a href="#">
                                <h5 class="title">IT and Tech Companies</h5>
                            </a>
                            <p class="disc">
                                Supporting innovation-driven businesses with specialized accounting and tax solutions.
                            </p>
                            <a href="#" class="btn-red-more">Learn More<i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <!-- single service End -->
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                    <!-- single service start -->
                    <div class="rts-single-service-h2">
                        <a href="#" class="thumbnail">
                            <img src="assets/images/service/12.jpg" alt="Service_image">
                        </a>
                        <div class="body">
                            <a href="#">
                                <h5 class="title">Construction and Real Estate Firms</h5>
                            </a>
                            <p class="disc">
                                Managing project finances, payroll, and compliance.
                            </p>
                            <a href="#" class="btn-red-more">Learn More<i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <!-- single service End -->
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                    <!-- single service start -->
                    <div class="rts-single-service-h2">
                        <a href="#" class="thumbnail">
                            <img src="assets/images/service/13.jpg" alt="Service_image">
                        </a>
                        <div class="body">
                            <a href="#">
                                <h5 class="title">Professional Services Providers</h5>
                            </a>
                            <p class="disc">
                                Including law firms, consulting agencies, and medical practices.
                            </p>
                            <a href="#" class="btn-red-more">Learn More<i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <!-- single service End -->
                </div>
				
				<div class="row g-5 mt--10">
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                    <!-- single service start -->
                    <div class="rts-single-service-h2">
                        <a href="#" class="thumbnail">
                            <img src="assets/images/service/10.jpg" alt="Service_image">
                        </a>
                        <div class="body">
                            <a href="#">
                                <h5 class="title">Indigenous Businesses</h5>
                            </a>
                            <p class="disc">
                                Offering expertise and guidance to support Indigenous entrepreneurs.
                            </p>
                            <a href="#" class="btn-red-more">Learn More<i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <!-- single service End -->
                </div>
				<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                    <!-- single service start -->
                    <div class="rts-single-service-h2">
                        <a href="#" class="thumbnail">
                            <img src="assets/images/service/10.jpg" alt="Service_image">
                        </a>
                        <div class="body">
                            <a href="#">
                                <h5 class="title">E-commerce and Retail Businesses</h5>
                            </a>
                            <p class="disc">
							Ensuring accurate financial tracking and tax compliance.                            </p>
                            <a href="#" class="btn-red-more">Learn More<i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <!-- single service End -->
                </div>
				<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                    <!-- single service start -->
                    <div class="rts-single-service-h2">
                        <a href="#" class="thumbnail">
                            <img src="assets/images/service/10.jpg" alt="Service_image">
                        </a>
                        <div class="body">
                            <a href="#">
                                <h5 class="title">Renewable Energy Companies</h5>
                            </a>
                            <p class="disc">
							Assisting businesses focused on sustainability and clean energy.                            </p>
                            <a href="#" class="btn-red-more">Learn More<i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <!-- single service End -->
                </div>
				<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                    <!-- single service start -->
                    <div class="rts-single-service-h2">
                        <a href="#" class="thumbnail">
                            <img src="assets/images/service/10.jpg" alt="Service_image">
                        </a>
                        <div class="body">
                            <a href="#">
                                <h5 class="title">Startups</h5>
                            </a>
                            <p class="disc">
							Helping new ventures with budgeting, tax planning, and financial growth strategies.                            </p>
                            <a href="#" class="btn-red-more">Learn More<i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <!-- single service End -->
                </div>
            </div>
        </div>
    </div>
    <!-- latest service area End -->

   <br><br>

    <!-- start about our company -->
    <div class="rts-about-our-company-h2 rts-section-gap">
        <div class="container">
            <div class="row">
                <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 order-xl-1 order-lg-1 order-md-2 order-sm-2 order-2 mt_sm--30">
                    <div class="about-company">
                        <span>About Our Company</span>
                        <h2 class="title">Professional And Dedicated <br>
                            Consulting Services</h2>
                    </div>
                    <div class="about-company-wrapper">
                        <p class="disc">
                            We are licensed and insured with over 14 years of experience in providing <br> United States
                            with
                            top-rated USA business services
                        </p>
                        <div class="rts-tab-style-one">
                            <div class="d-flex align-items-start contoler-company">
                                <div class="nav flex-column nav-pills me-3 button-area" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">01. The Great Mission</button>
                                    <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">02. Amazing Vision</button>
                                    <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">03. Our Destination</button>
                                </div>
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                        <!-- start tab content -->
                                        <div class="rts-tab-content-one">
                                            <p class="disc">
                                               Our mission is to provide professional and dedicated consulting services that empower businesses to achieve excellence. We aim to deliver tailored financial solutions, ensuring precision, compliance, and growth for our clients.
                                            </p>
                                            <a class="rts-btn btn-primary-2 color-h-black" href="Appointment.php">Contact Us</a>
                                        </div>
                                        <!-- start tab content End -->
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                        <!-- start tab content -->
                                        <div class="rts-tab-content-one">
                                            <p class="disc">
                                                We envision becoming a leading consulting firm recognized for innovation, reliability, and unparalleled service quality. Our goal is to inspire confidence and build long-term partnerships by transforming complex financial challenges into opportunities for success.
                                            </p>
                                            <a class="rts-btn btn-primary-2 color-h-black" href="Appointment.php">Contact Us</a>
                                        </div>
                                        <!-- start tab content End -->
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                        <!-- start tab content -->
                                        <div class="rts-tab-content-one">
                                            <p class="disc">
                                                Our ultimate destination is to create a legacy of excellence, where businesses thrive under our guidance. We strive to be the trusted advisor for enterprises seeking sustainable growth, financial clarity, and industry leadership.
                                            </p>
                                            <a class="rts-btn btn-primary-2 color-h-black" href="Appointment.php">Contact Us</a>
                                        </div>
                                        <!-- start tab content End -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 order-xl-1 order-lg-1 order-md-1 order-sm-1 order-1">
                    <div class="about-company-thumbnail">
                        <img src="assets/images/about/01.png" alt="Business_company">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- start about our company End -->

    <!-- our working Process -->
    <div class="working-process-area rts-section-gap working-process-bg">
        <div class="container">
            <div class="row mt--40">
                <div class="title-area text-center working-process">
                    <span>Working Steps</span>
                    <h2 class="title">Our Basic Work Process</h2>
                </div>
            </div>
            <div class="row g-5 mt--20 align-items-center">
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                    <!-- single wirking process -->
                    <div class="rts-working-process-1 text-center">
                        <div class="inner">
                            <div class="icon">
                                <img src="assets/images/working-step/icon/01.svg" alt="Working_process">
                            </div>
                        </div>
                        <div class="content">
                            <h6 class="title">Client Onboarding</h6>
                            <p class="disc">
                                Welcoming clients and  <br> ensuring seamless integration.
                            </p>
                        </div>
                    </div>
                    <!-- single wirking process End -->
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                    <!-- single wirking process -->
                    <div class="rts-working-process-1 process-lg text-center">
                        <div class="inner two">
                            <div class="icon">
                                <img src="assets/images/working-step/icon/02.svg" alt="Working_process">
                            </div>
                        </div>
                        <div class="content">
                            <h6 class="title">Data Collection & Analysis</h6>
                            <p class="disc">
                                Gathering information to  <br> interpret patterns and make decisions.
                            </p>
                        </div>
                    </div>
                    <!-- single wirking process End -->
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                    <!-- single wirking process -->
                    <div class="rts-working-process-1 text-center">
                        <div class="inner three">
                            <div class="icon">
                                <img src="assets/images/working-step/icon/03.svg" alt="Working_process">
                            </div>
                        </div>
                        <div class="content">
                            <h6 class="title">Bookkeeping & Record Management</h6>
                            <p class="disc">
                                Organizing, recording, and maintaining <br> financial and business records.
                            </p>
                        </div>
                    </div>
                    <!-- single wirking process End -->
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                    <!-- single wirking process -->
                    <div class="rts-working-process-1 process-lg text-center">
                        <div class="inner four">
                            <div class="icon">
                                <img src="assets/images/working-step/icon/04.svg" alt="Working_process">
                            </div>
                        </div>
                        <div class="content">
                            <h6 class="title">Financial Reporting</h6>
                            <p class="disc">
                                Preparing and presenting financial data <br> for informed decision-making.
                            </p>
                        </div>
                    </div>
                    <!-- single wirking process End -->
                </div>
            </div>
			
			
			
			
			
			<div class="row g-5 mt--20 align-items-center">
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                    <!-- single wirking process -->
                    <div class="rts-working-process-1 text-center">
                        <div class="inner five">
                            <div class="icon">
                                <img src="assets/images/working-step/icon/01.svg" alt="Working_process">
                            </div>
                        </div>
                        <div class="content">
                            <h6 class="title">Tax Compliance & Filing</h6>
                            <p class="disc">
                                Adhering to tax laws and <br> submitting accurate tax returns.
                            </p>
                        </div>
                    </div>
                    <!-- single wirking process End -->
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                    <!-- single wirking process -->
                    <div class="rts-working-process-1 process-lg text-center">
                        <div class="inner six">
                            <div class="icon">
                                <img src="assets/images/working-step/icon/02.svg" alt="Working_process">
                            </div>
                        </div>
                        <div class="content">
                            <h6 class="title">Advisory Services</h6>
                            <p class="disc">
                                Providing expert guidance to improve <br> decisions and achieve goals.
                            </p>
                        </div>
                    </div>
                    <!-- single wirking process End -->
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                    <!-- single wirking process -->
                    <div class="rts-working-process-1 text-center">
                        <div class="inner seven">
                            <div class="icon">
                                <img src="assets/images/working-step/icon/03.svg" alt="Working_process">
                            </div>
                        </div>
                        <div class="content">
                            <h6 class="title">Continuous Support</h6>
                            <p class="disc">
                                Ongoing assistance to ensure <br> success and address challenges.
                            </p>
                        </div>
                    </div>
                    <!-- single wirking process End -->
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                    <!-- single wirking process -->
                    <div class="rts-working-process-1 process-lg text-center">
                        <div class="inner eight">
                            <div class="icon">
                                <img src="assets/images/working-step/icon/04.svg" alt="Working_process">
                            </div>
                        </div>
                        <div class="content">
                            <h6 class="title">Final Deliverables & Feedback</h6>
                            <p class="disc">
                                Providing completed work and <br> gathering insights for improvement.
                            </p>
                        </div>
                    </div>
                    <!-- single wirking process End -->
                </div>
            </div>
        </div>
    </div>
    <!-- our working Process End -->
	
	

	
 <section class="basic-content padding-medium new-container" style="background-color: #f5f7f7; text-align: center; color: #000000;">
    <div class="container">
        <!-- Heading -->
        <h2 class="basic-content__heading heading" style="color: #005c97;">Our Technology Partners</h2>

        <!-- Description -->
        <div class="basic-content__description description">
            <p>We strive to use technology to cost-efficiently support clients. SmartBooks is committed to being at the forefront of technology and is constantly researching, testing, and implementing new technologies that support client accounting needs.</p>
        </div>

        <!-- Image Grid -->
        <div class="gride">
        <div class="box">
            <img class="grid1" src="assets/images/partners/quickbooks-logo.jpeg">
        </div>
        <div class="box">
            <img class="grid1" src="assets/images/partners/SageAlone.png">
        </div>
        <div class="box">
            <img class="grid1" src="assets/images/partners/xero.png">
        </div>
      <div class="box">
            <img class="grid1" src="assets/images/partners/freshbooks.jpg">
        </div>
    </div>
    </div>
</section>


	
	
	

    <!-- start service area -->
    <div class="rts-service-areah2-im-3 rts-section-gap">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <div class="image-area">
                        <img src="assets/images/service/h2/03.jpg" alt="Service_Image">
                        <img class="two" src="assets/images/service/h2/02.jpg" alt="Service_Image">
                        <img class="three" src="assets/images/service/h2/01.jpg" alt="Service_Image">
                        <div class="ratio-area">
                            <h3 class="ratio">85%</h3>
                            <span>Successful Ratio</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="service-h2-content pl--30">
                        <div class="title-area  service-h2 service">
                            <span>Why Choose Us</span>
                            <h2 class="title">Our Commitment to Excellence</h2>
                        </div>
                        <div class="content-wrapper">
                            <p class="disc">
                               At DJBOOKS, we are dedicated to delivering outstanding performance in every service we provide. Our approach combines precision, innovation, and a client-first mindset to ensure optimal results. We continuously strive to exceed expectations, setting new benchmarks for quality and reliability in the accounting industry.

                            </p>
                            <div class="feature-one-wrapper mt--40">
                                <div class="single-feature-one">
                                    <i class="fal fa-check"></i>
                                    <p>Tailored solutions for your unique business needs.</p>
                                </div>
                                <div class="single-feature-one">
                                    <i class="fal fa-check"></i>
                                    <p>A proactive approach to financial management and compliance.</p>
                                </div>
                                <div class="single-feature-one">
                                    <i class="fal fa-check"></i>
                                    <p>A team of experts committed to your success.</p>
                                </div>
                                <div class="single-feature-one">
                                    <i class="fal fa-check"></i>
                                    <p>Let us help you achieve excellence in your financial goals!</p>
                                </div>
                            </div>
                            <div class="support-team">
                                <a href="team-details.html" class="thumbnail"><img src="assets/images/business-goal/team.png" alt="Image-team"></a>
                                <div class="details">
                                    <span>24/7 Support Team</span>
                                     <a class="rts-btn btn-primary-2 color-h-black" href="Appointment.php">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- start service area End -->



    
    <!-- <div class="loadingpage">
	<div class="counter">
		<h1>100</h1>
	</div>
</div> -->
    <!-- End loader -->


    <!-- progress Back to top -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- progress Back to top End -->


    <!-- scripts start form hear -->
    <script src="assets/js/vendor/jquery.min.js"></script>
    <script src="assets/js/vendor/jqueryui.js"></script>
    <script src="assets/js/vendor/waypoint.js"></script>
    <script src="assets/js/plugins/swiper.js"></script>
    <script src="assets/js/plugins/counterup.js"></script>
    <script src="assets/js/plugins/sal.min.js"></script>
    <script src="assets/js/vendor/bootstrap.min.js"></script>
    <script src="assets/js/plugins/contact.form.js"></script>
    <!-- main Js -->
    <script src="assets/js/main.js"></script>
    <!-- scripts end form hear -->
	
<script>
  document.addEventListener("DOMContentLoaded", function () {
    fetch('announcements_check.php')
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          const announcementModal = new bootstrap.Modal(document.getElementById('announcementModal'));
          const announcementBody = document.getElementById('announcementBody');
          if (data.type === 'text') {
            announcementBody.innerHTML = `<p>${data.content}</p>`; // Added closing backtick and semicolon
          } else if (data.type === 'image') {
            announcementBody.innerHTML = `<img src="${data.content}" alt="Announcement Image" class="img-fluid">`;
            
             // Log the img src value
    const imgElement = announcementBody.querySelector('img');
    console.log(imgElement.src);
          }
          announcementModal.show();
        }
      })
      .catch(error => console.error('Error fetching announcement:', error));
  });
</script>


</body>



</html>



<?php

require 'footer.php';

?>