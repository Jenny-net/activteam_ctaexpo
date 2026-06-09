@extends('layouts.main.admin-dashboard')

@section('content')
    <div class="admin-body-area">
        <form action="{{ route('admin.replicatemasscontent.save') }}" method="POST" id="content_form"
            enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">

                        {{-- Step 1: Select Template --}}
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Select Template</label>
                                <select class="form-control" name="template" id="templateSelect">
                                    <option value="">Select Template</option>
                                    <option value="1">Template One</option>
                                    <option value="2">Template Two</option> 
                                </select>
                            </div>
                        </div>

                        {{-- Step 2: Content Title --}}
                        <div class="col-lg-12 col-md-12" id="titleDiv" style="display:none;">
                            <div class="form-group">
                                <label>Content Title</label>
                                <input type="text" class="form-control" name="content_title" id="content_title"
                                    placeholder="Enter Content Title">
                            </div>
                        </div>

                        {{-- Step 3: Add Content Field (CKEditor) --}}
                        <div class="col-lg-12 col-md-12" id="contentDiv" style="display:none;">
                            <div class="form-group">
                                <label>Content Details</label>
                                <textarea class="form-control" name="section_one" id="section_one" placeholder="Enter content details here..."
                                    rows="5"></textarea>
                            </div>
                        </div>

                        {{-- Step 4: Number of Pages --}}
                        <div class="col-lg-12 col-md-12" id="pageDiv" style="display:none;">
                            <div class="form-group">
                                <label>No. of Pages</label>
                                <input type="number" class="form-control" name="no_of_pages" id="no_of_pages"
                                    min="1" placeholder="Enter number of pages">
                                <small id="page-error" style="color:red; display:none;"></small>
                            </div>
                        </div>



                    </div>
                </div>

                {{-- Step 5: Action Buttons --}}
                <div class="card-footer text-right" id="submitDiv" style="display:none;">
                    <button type="button" class="btn btn-secondary btn-lg" id="draft-btn" value="draft"
                        style="border-radius:12px;">Save Draft</button>

                </div>
            </div>
        </form>
    </div>
@stop



@push('script')



    <script>
        $(document).ready(function() {

            // Template One HTML
            const templateOneHTML = `<section class="inrPageOneFirstSec">
	<div class="container">
		<div class="secHdn">&nbsp;
<h1>Exhibition Stand Design Company in Europe</h1>
</div>
<br />
<div class="inrPageOneFirstSecRow">
<div class="inrPageOneFirstSecLeftPrt"><img alt="exhibition stand design" src="https://ctaexpo.com/public/assets/cmsImages/der2_1715328456.JPG" style="width: 576px; height: 360px;" /></div>

<div class="inrPageOneFirstSecRightPrt">
<p><br />
Your exhibition stand design can boost the visibility and highlight the importance of your merchandise and services It help creating a leading image. With a high quality created design, your company gets a higher visitor retention. With award winning designers you will receive solutions with the perfect concept for your exhibitions in Europe from the UK, Germany, France, Netherlands, Switzerland, Italy or Spain.</p>

<p>Our design creation capabilities support any custom design and custom build exhibition Booth concept with the ability to create any complex structure that will show your exhibition presentation unique and impressive.</p>

<p>High level of modernity and aesthetic ensure that your exhibition stand tells the audience your brand importance and brand exposure. We work hard to understand your products and services to make sure your exhibition booth will be an excellent presentation platform to reach your exhibition targets.</p>

<p>We are distinguished in transforming your expectations into an innovative concept. Our motivation is surpassing our client requirements. We offer a whole package: handling each and every need, from idea to project management, manufacturing and setting up your stand, so you can focus on on your event.</p>

<p>Bringing in the right audience is crucial for any exhibition results is the stand can convey your brand message and display your products, it&#39;s pretty important to create an appealing design that gives results.</p>

<p>&nbsp;</p>
</div>
</div>

<section class="projectSec">
<div class="container">
<div class="ourProjectPrt">
<p><img alt="banner1" src="https://ctaexpo.com/public/assets/cmsImages/capture-cta-3_1756194728.png" style="display: block; margin: 0px auto; max-width: 94%; width: 1283px; height: 320px;" /></p>

<p>&nbsp;</p>

<h2 style="text-align: center;"><strong>Benefit from limitless design possibilities and exceptional craftsmanship</strong></h2>

<p>&nbsp;</p>
</div>
</div>
</section>
	</div>
</section>
<!-- ================ Inner Page One First Section End ================ -->


<!-- ================ Inner Page Service Section Start ================ -->
<section class="inrSrvcSec">
	<div class="inrSrvcImgPrt">
<div class="container">
<ul>
	<li><img alt="exhibition stand design" src="https://ctaexpo.com/public/assets/cmsImages/exhibition-stand-cta14_1715587649.jpg" style="width: 326px; height: 500px;" /></li>
	<li><img alt="exhibition stand" src="https://ctaexpo.com/public/assets/cmsImages/exhibition-stand-cta15_1715587855.jpg" style="width: 373px; height: 500px;" /></li>
	<li><img alt="stand-design" src="https://ctaexpo.com/public/assets/cmsImages/exhibition-stand-cta16_1715587892.jpg" style="width: 422px; height: 500px;" /></li>
</ul>
</div>
</div>

<div class="srvcTstmnlRow">
<div class="srvcBenefitLeftPrt">
<div class="srvcBenefitTextArea">
<div class="secHdn">
<h3>Best Design Creation for European Exhibitions</h3>

<p>&nbsp;</p>

<p>- Design an eye-catching and impactful exhibition stand that that get attention. Ensure your display has a distinct character by incorporating a one-of-a-kind design that sets it apart from the rest.<br />
<br />
- Create an engaging and impactful trade show environment.<br />
<br />
- Create an immersive and inviting atmosphere that invites guests to connect with your brand on a personal level. Offer complimentary goods or trials to captivate attendees and build lasting brand awareness.<br />
<br />
- Make sure that the booth&#39;s appearance and communication align well with the brand&#39;s character, principles, and overall reputation.<br />
<br />
- Maximize the arrangement of the booth to make the best use of space visitors through a smooth and easy-to-follow experience.</p>
</div>
</div>
</div>

<div class="rightTestimonialPrt">
<div class="testimonialTextPrt">
<div class="secHdn">
<h2>Design Approach</h2>

<p>&nbsp;</p>
</div>

<p>Our award-winning design team brings innovation and creativity to every project, ensuring that your exhibition presentation will be a success.</p>

<p>We design print and create custom exhibition stands to align perfectly with your brand identity and objectives, to ensure exhibition presentation efficiency and impactful presence.&nbsp;We transform your views and exhibition targets to reality</p>

<p>Providing optimal service across Europe by meeting the detailed requirements of all exhibition stand types</p>

<p>We provide inspiration from our 700+ stand designs. Our designers are aware of the difficulties that exhibitors have to overcome when creating a stand experience for their customers.</p>
</div>
</div>
</div>
</section>
<!-- ================ Inner Page Service Section End ================ -->


<!-- ================ Inner Page Best Service Section Start ================ -->
<section class="inrBestSrvcSec">
	<div class="container">
		<div class="bestSrvcHdnRow">
<div class="secHdn">
<h2>OUR SERVICES</h2>

<h3 class="hdnBrdr">OUR<br />
DESIGN SERVICES</h3>
</div>

<div class="hdnText">
<p>Our design creation capabilities support any custom design and custom build exhibition booth concept with the ability to create any complex structure that will show your exhibition presentation unique and impressive.</p>
</div>
</div>

<div class="bestSrvcItemPrt">
<ul>
	<li><img alt="" class="bestSrvcItmImg" src="https://ctaexpo.com/public/assets/static-images/best-service-item1.webp" />
	<div class="bestSrvcItmText">
	<h4>DESIGN</h4>

	<p>Boost your company&nbsp;exposure and reputation with modern exhibition design, maximize the attention with more efficient, branded design concepts. High level of modernity and aesthetic ensure that your exhibition stand tells the audience your brand importance and brand exposure.</p>
	</div>
	</li>
	<li><img alt="" class="bestSrvcItmImg" src="https://ctaexpo.com/public/assets/static-images/best-service-item2.webp" />
	<div class="bestSrvcItmText">
	<h4>BUILD</h4>

	<p>Utilising the most productive elements, delivering advanced construction abilities with wooden constructions, iron, plexiglass to produce exclusive custom stands. With creation of any forms from wood, iron, plexiglass.</p>
	</div>
	</li>
	<li><img alt="" class="bestSrvcItmImg" src="https://ctaexpo.com/public/assets/static-images/best-service-item3.webp" />
	<div class="bestSrvcItmText">
	<h4>VISUAL &amp; GRAPHICS</h4>

	<p>Visual exhibition marketing starts with graphics&nbsp;to reflect the products in the booth and presentation displays. The purpose is to create a warm, friendly, and approachable atmosphere for customers.<i> </i></p>
	</div>
	</li>
	<li><img alt="" class="bestSrvcItmImg" src="https://ctaexpo.com/public/assets/static-images/best-service-item4.webp" />
	<div class="bestSrvcItmText">
	<h4>FURNITURE</h4>

	<p>Customized furniture and stand decoration solutions provide leading concepts and unique styles.</p>
	</div>
	</li>
	<li><img alt="" class="bestSrvcItmImg" src="https://ctaexpo.com/public/assets/static-images/best-service-item5.webp" />
	<div class="bestSrvcItmText">
	<h4>MULTIMEDIA</h4>

	<p>Incorporating cutting-edge technology, such as large video walls, touchscreens and vibrant digital displays.</p>
	</div>
	</li>
	<li><img alt="" class="bestSrvcItmImg" src="https://ctaexpo.com/public/assets/static-images/best-service-item6.webp" />
	<div class="bestSrvcItmText">
	<h4>Europe Wide Services</h4>

	<p>Total Turnkey Solutions &ndash; From concept to completion, we handle every aspect of your exhibit, including design, construction, shipping, and installation.</p>
	</div>
	</li>
</ul>
&nbsp;

<div class="portfolioItmPrt">
<div class="container-fluid">
<ul>
	<li><strong><strong><img alt="stand" src="https://ctaexpo.com/public/assets/cmsImages/exhibition-stand-1-1_1756198855.jpg" style="width: 504px; height: 403px;" /></strong></strong></li>
	<li><strong><strong><img alt="booth" src="https://ctaexpo.com/public/assets/cmsImages/exhibition-stand-1-2_1756199190.jpg" style="width: 504px; height: 380px;" /></strong></strong></li>
	<li><strong><strong><img alt="stand" src="https://ctaexpo.com/public/assets/cmsImages/exhibition-stand-1-3_1756199424.jpg" style="width: 504px; height: 380px;" /></strong></strong></li>
	<li><strong><strong><img alt="stand" src="https://ctaexpo.com/public/assets/cmsImages/exhibition-stand-1-4_1756199733.jpg" style="width: 504px; height: 380px;" /></strong></strong></li>
	<li><strong><strong><img alt="exhibition booth" src="https://ctaexpo.com/public/assets/cmsImages/exhibition-booth-1_1759902376.jpg" style="width: 504px; height: 380px;" /></strong></strong></li>
	<li><strong><strong><img alt="stand" src="https://ctaexpo.com/public/assets/cmsImages/exhibition-stand-1-5_1756199884.jpg" style="width: 504px; height: 380px;" /></strong></strong></li>
</ul>
</div>
</div>
</div>
	</div>
</section>
<!-- ================ Inner Page Best Service Section End ================ -->

<!-- ================ Inner Page Project Description Section Start ================ -->
<section class="inrProjectDescriptionSec">
	<div class="inrProjectDescriptionRow">
		<div class="inrProjectDescriptionLeftPrt">
<div class="inrProjectDescriptionLeftContentArea">
<div class="secHdn">
<h2>&nbsp;</h2>

<h4 class="hdnBrdr">Complete Exhibition Stand Design &amp; Build Solutions in Europe</h4>
</div>

<p>We design award-winning and engaging custom exhibition stands with an leading image that are attractive and memorable.</p>

<p>Find the best design Solutions. Hiring our stand design company, with in-house designers focusing on creativity, and design doncepts will increase your visibility on the fair. &nbsp;With decades of experience in modern design creation you will find the best concepts to increase your brand reputation.</p>

<p>Our designers are focusing on your exhibition targets to create exhibition stand concepts that effectively communicate your brand message and showcase your products and services.&nbsp;We understand the design that needs to be created to be successful in European exhibitions. Modern design creation with the capacity to attract the audience in Europe is very important.</p>

<p><br />
When searching an exhibition stand design company in Europe you can find our special design creations that will give you exhibition presentation a professional look. Contact our project managers and thank you brief of requirements inclusive your target budget.</p>

<p>&nbsp;</p>
</div>
</div>

<div class="inrProjectDescriptionRightPrt">
<div class="inrProjectDescriptionRightContentArea">
<div class="secHdn">
<h2>EXHIBITION STAND DESIGN</h2>
</div>
&nbsp;

<p>Exhibition stand design creates a unique and creative experience for visitors. Exhibition booth design can attract potential customers, and also create loyal ones. An exhibition design can make a lasting impression on customers, and create a strong brand loyalty.<br />
<br />
To structure an exhibition presentation, creative designers can use progressive designs to find the best design. First impressions are always crucial. It is particularly important for exhibition stands. The balance between the corporate needs and the design of each stand must be struck. Each project is different and requires a custom stand.<br />
<br />
Design and style development includes the consideration of the unique cooperative aspects, the requirements for the products or services, and the marketing objectives.</p>
Exhibition stand design Stand Construction Planning and consulting Graphics/branding Equipment for technical use (audio, video, lighting, data applications etc.). Furniture Hire and Project Management.</div>
</div>
	</div>
</section>
`;


const templateTwoHTML = `<section class="inrBestSrvcSec">
	<div class="container">
		<p>&nbsp;</p>

<h1 style="text-align: center;">Exhibition Stand Builder in Germany for custom Exhibition Booths &amp; Premium Exhibition Rentals</h1>

<p>&nbsp;</p>

<p><br />
<img alt="exhibition stand design for germany" src="https://ctaexpo.com/public/assets/cmsImages/Capture3_1728373240.PNG" style="display: block; margin: 0 auto; max-width: 80%;" /></p>

<p>Looking For an Exhibition Stand Builder in Germany? CTA EXPO Exhibitions is a prime exhibition stand builder in Germany.&nbsp;&nbsp;</p>

<p>With our Europe wide presence, ability to provide custom design and build complex booths, developing exhibition stands that are very unique drives the audience in with the high creativity and industry-specific expertise. With the most modern booth designs and substantial knowledge as a well-known exhibition stand contractor, we guarantee a trade show experience with top results.</p>

<p>Our experienced team creates premium exhibition booth designs using our in-house production facility.&nbsp;&nbsp;CTA Expo Stand Services is a specialist exhibition stand builder in Germany with a recognized and unique identity and constantly strives to produce projects with an unforgettable visual appearance.&nbsp;&nbsp;</p>

<p>&nbsp;</p>
		<div class="portfolioItmPrt">
			<div class="container-fluid">
				<ul>
										
				</ul>
			</div>
		</div>
	</div>
</section>

<section class="inrPageTwoSecondSec">
	<div class="container">
<div class="secHdn">
<p>At CTA EXPO stand contractor in Germany, exhibitions are invested in delivering innovative and stand that is sophisticated that align along with your brand&rsquo;s objectives. With all the dynamic trade fair landscape in Europe, an engaging exhibition stand is essential for effective branding and gaining a competitive edge.</p>

<p>An engaging exhibition stand is crucial for effective branding and gaining a competitive edge with the dynamic trade fair landscape in Germany.</p>

<p>We provide comprehensive, all-in-one solutions throughout the European market. With a full range of in-house aspect of the process, from initial design to final installation, creating bespoke exhibition stands that showcase our clients&#39; brands in a distinctly European style.</p>

<p>Our European presence is extensive, with production facilities strategically positioned in close proximity to key markets in Germany, Italy, Switzerland, France, and the United Kingdom. This prime location enables us to deliver exhibition stands to more than 30 major cities across the continent.</p>

<p>&nbsp;</p>

<ul>
	<li>Get a tailored exhibition booth design concept and detailed cost estimate that perfectly aligns with your unique brand identity.</li>
	<li>Our services cover all aspects of your project, starting from the initial idea and creating 3D models to final delivery, installation, and continued upkeep. Handling every part of the project internally streamlines the process, reduces expenses, and ensures that the project is completed on schedule, enabling you to focus on engaging and reaching out to your desired audience.</li>
	<li>Reliable partner for successful exhibitions.</li>
	<li>Whether you need a customized exhibit for a trade show or adaptable, skilfully designed solutions that cater to your specific needs.</li>
	<li>Comprehensive Exhibit Management overseeing every detail of your project, from initial concept to final setup, encompassing design development, fabrication, logistics, and on-site installation.</li>
	<li>Compliance with Venue Requirements, handling all necessary permits and applications, including utilities such as power, water, and internet connectivity, to ensure a smooth event setup.</li>
	<li>Exhibition construction across Europe, find comprehensive exhibition solutions, encompassing bespoke stand design and complete trade show booth hire services. Our expert team ensures seamless execution, from timely setup regional exhibition regulations, ultimately delivering a exiting custom stand that perfectly reflects your brand&#39;s identity.</li>
</ul>

<p>&nbsp;</p>

<h3 class="hdnBrdr">&nbsp;</h3>
</div>
</div>
	<div class="portfolioItmPrt">
		<div class="container-fluid">
			<ul>
								
			</ul>
		</div>
	</div>
</section>

<section class="inrPageOneFirstSec">
	<div class="container">
		<div class="secHdn">
			<h3>Build an Exhibition stand in Germany</h3>

<p>&nbsp;</p>

<p>To make a lasting impression at a European exhibition, consider innovative exhibition stand design solutions that effectively reflect your brand&#39;s identity. By crafting a visually engaging atmosphere that prominently features interactive features and inviting lounge areas, you can create a captivating booth that draws in and holds the attention of potential customers.</p>

<p>Through examining the online collection of exclusive, designs, you have access to more than 500 design ideas that are customisable. With our understanding of the specific exhibition venues, rules, and customs, we offer trade show booth construction services locally to save you money. Our track record of reliability in the service process and industry-specific expertise help us tailor our approach to meet your objectives and target audience effectively.</p>

<div class="portfolioItmPrt">
<div class="container-fluid">
<ul>
	<li><img alt="exhibition stand" src="https://ctaexpo.com/public/assets/cmsImages/exhibition-stand-1-7_1756206166.jpg" style="width: 477px; height: 473px; float: right;" /></li>
	<li><img alt="both design" src="https://ctaexpo.com/public/assets/cmsImages/exhibition-stand-1-8_1756206318.jpg" style="width: 477px; height: 473px;" /></li>
	<li><img alt="booth" src="https://ctaexpo.com/public/assets/cmsImages/exhibition-stand-1-9_1756206371.jpg" style="width: 477px; height: 473px;" /></li>
</ul>
</div>
</div>

<p>&nbsp;</p>

<p>&nbsp;</p>

<div class="secHdn">
<p>With construction and logistics in Germany, you can expect turnkey exhibition stand design and construction services in Germany and also across Europe. From concept to commissioning, we handle everything in-house, crafting over 300 bespoke exhibition stands annually for diverse industries.</p>

<p>Exhibiting in German requires special designs to get awareness concerning the products, and also make networks with selected customers.&nbsp;&nbsp;To attract visitors at industry events&nbsp;&nbsp;we provide the right design concepts highlighting the brand name and to produce a leading image.&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>

<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p>

<p>With comprehensive service solutions, exhibition booth builder company in Germany, we deliver innovative design and all around exhibition services build and delivering stands of high quality because of the highest precision and technical specifications. solutions that align along with your exhibition objectives when exhibiting in Germany and across Europe.</p>

<p>&nbsp;</p>

<p><img alt="banner" src="https://ctaexpo.com/public/assets/cmsImages/capture-cta-1a_1756274902.png" style="display: block; margin: 0px auto; max-width: 80%; width: 1294px; height: 365px;" /></p>

<p>&nbsp;</p>

<p>Check out key options that come with our exhibition booth builder and exhibition stand contractor services in Germany:</p>

<p>&nbsp;</p>

<ul>
	<li>Custom Exhibition stands, wood made.&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</li>
	<li>Fabrics banners that are hanging.</li>
	<li>Metal fabrication.</li>
	<li>Backlighted logos.</li>
	<li>Product displays.</li>
	<li>Multimedia and large video walls.</li>
	<li>Plexiglas lighted logos and panels.</li>
</ul>
</div>

<p>&nbsp;</p>

<p>&nbsp;</p>
			<div class="portfolioItmPrt">
				<div class="container-fluid">
					<ul>
												
					</ul>
				</div>
			</div>
			
		</div>
		<br>
		
		<div class="inrPageOneFirstSecRow">
			<div class="inrPageOneFirstSecRow">
<div class="inrPageOneFirstSecLeftPrt"><img alt="trade show stand" src="https://ctaexpo.com/public/assets/cmsImages/imm-exhibition-stand-light_1746726777.jpg" style="width: 500px; height: 451px;" /></div>

<div class="inrPageOneFirstSecRightPrt">
<h3>We help our customers in utilizing our custom exhibition design and build services. for experiential marketing opportunities.</h3>

<p>Offering the right solutions, all varieties of exhibition stand styles and custom solutions to boost exhibition presentation effectiveness and visualization of products and services in German fairs. Drawing on in-depth understanding of exhibition presentation methods. With reliable and continuous method of getting exhibition services while keeping exhibition expenditures stable. All-inclusive exhibition services to greatly help optimize any exhibition presentation.</p>

<p>Exhibitions are a major platform and stand design is a visual treat for visitors before examining this products of an exhibitor. Our tailoring that is comprehensive of solutions, undergoes layers of assessment into the team. Each design &amp; build division is&nbsp;&nbsp;built to increase visibility, leading image.</p>

<p>With customized applications architectural, manufacturing, exhibition marketing support, experience building customized solutions for global exhibition needs, we now have the fit-for-motive solution you need.</p>

<p>In line with the experience and know-how of 20 years in operation, a comprehensive portfolio of top-notch expo booth design and build, in addition to conceptual strength of a full-service partner, CTA EXPO offers tailor-made solutions for successful events in Germany.</p>
</div>
</div>

<p>&nbsp;</p>

<p>&nbsp;</p>

<div class="container">
<div class="secHdn">
<h3><strong>How to Create a Striking Custom Build Booth</strong></h3>
&nbsp;

<p>Before designing, establish clear goals and objectives to guide the development of your exhibition stand.</p>

<p><strong>Craft a Layout:</strong></p>

<p>- Before designing, establish clear goals and objectives to guide the development of your exhibition stand.<br />
- Organize the setup in a way that naturally directs visitors through the booth, creating specific areas for various interactions.<br />
- Enhance engagement by integrating interactive elements such as touchscreens, product demos, or video walls to captivate interest and encourage interaction.</p>

<p>&nbsp;</p>

<p><strong>Organize a Seamless Experience:</strong></p>

<p>- Design the booth layout in a way that naturally directs visitors through different sections, allowing for varied interactions.<br />
-Incorporate interactive features such as screens, product samples, or demonstrations to engage attendees.<br />
-Create a cozy meeting space with comfortable seating to facilitate deeper conversations.</p>

<p>&nbsp;</p>

<p><strong>Ensure Practicality and Follow-Up:</strong></p>

<p><br />
- Choose materials that are lightweight and durable for easy setup and transportation. Prior to the event, test the booth to guarantee stability, security, and visual appeal.<br />
- Develop a strategy for gathering leads through giveaways or sign-ups, enabling you to maintain connections post-event.</p>

<p>&nbsp;</p>

<p><strong>Incorporate Engagement:</strong></p>

<p>- Integrate interactive features such as screens, product samples, or demonstrations to attract individuals and promote participation.</p>

<p>&nbsp;</p>

<p><strong>Ensure Comfort:</strong></p>

<p>- Establish a warm gathering space with a comfort seating for more meaningful conversations with guests.<br />
- Tailor the design to suit your target audience, providing an experience that is both comfortable and valuable to them.<br />
- Establish different areas with specific purposes, like a showcase section, a consultation zone, or a demo space, to enhance the overall visitor experience.<br />
- Prevent congestion by ensuring there is ample space around popular attractions, allowing for a smooth flow of foot traffic.<br />
- Create an inviting ambiance by incorporating comfortable areas like lounges or designated meeting spots to entice visitors to stay longer.<br />
- Strategically position key products or features prominently to attract attention and effectively showcase your offerings.</p>
</div>
</div>
		</div>
		<div class="portfolioItmPrt">
			<div class="container-fluid">
				<ul>
										
				</ul>
			</div>
		</div>
	</div>
</section>`;





            // Template select logic
            $('#templateSelect').on('change', function() {
                const val = $(this).val();

                $('#titleDiv').toggle(val !== '');
                $('#contentDiv').toggle(val !== '');

                // Recreate CKEditor fresh
                if (CKEDITOR.instances.section_one) {
                    CKEDITOR.instances.section_one.destroy(true);
                }

                CKEDITOR.replace('section_one', {
                    filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
                    filebrowserUploadMethod: 'form',
                    allowedContent: true
                });

                // Load the correct HTML template
                setTimeout(() => {
                    if (val == '1') {
                        CKEDITOR.instances.section_one.setData(templateOneHTML);
                    } else if (val == '2') {
                        CKEDITOR.instances.section_one.setData(templateTwoHTML);
                    } else {
                        CKEDITOR.instances.section_one.setData('');
                    }
                }, 400);
            });

            $('#content_title').on('input', function() {
                $('#pageDiv').toggle(this.value.trim() !== '');
            });

            $('#no_of_pages').on('input', function() {
                let val = parseInt(this.value);

                if (val === 0) {
                    $('#page-error').remove();
                    $(this).after(
                        '<small id="page-error" style="color:red;">Enter a number greater than 0</small>'
                    );
                    this.value = "";
                    $('#submitDiv').hide();
                    return;
                }

                $('#page-error').remove();
                $('#submitDiv').toggle(val > 0);
            });


            // Handle Save Draft
            $('#draft-btn').on('click', function() {
                for (instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement();
                }
                $('<input>').attr({
                    type: 'hidden',
                    name: 'save_action',
                    value: 'draft'
                }).appendTo('#content_form');
                $('#content_form').submit();
            });
        });
    </script>
@endpush
