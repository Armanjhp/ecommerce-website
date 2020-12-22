<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>About Chromerce</title>
	<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
	<link rel="icon" type="image/png" href="images/favicon.png"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="about.css">
	<link rel="stylesheet" type="text/css" href="template.css">
</head>
<body>

	<!---------- navbar ---------->
	<?php
	include("navbar.php");
	?>

	<!---------- testimonial slider ---------->
	<div class="testimonial">
		<div class="container">
			<h2>Testimonials</h2>
			<div class="rbd-core-ui">
			<div class="rbd-review-slider">
				<div class="rbd-review-container">
					<div class="rbd-review review1.1 rbd-curr">
						<h3 class="rbd-heading">Free Shipping</h3>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<div class="rbd-content"><img class="rbd-gravatar" src="images/user-1.png">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever</div>
						<div class="rbd-review-meta">Written by Mark P. on Nov. 10, 2020</div>
					</div>
					<div class="rbd-review review1.2 rbd-next">
						<h3 class="rbd-heading">Best Prices</h3>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star-o"></i>
						<div class="rbd-content"><img class="rbd-gravatar" src="images/user-2.png">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever</div>
						<div class="rbd-review-meta">Written by Alex D. on Nov. 9, 2020</div>
					</div>
					<div class="rbd-review review1.3">
						<h3 class="rbd-heading">Great Customer Service</h3>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<div class="rbd-content"><img class="rbd-gravatar" src="images/user-3.png">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever. on Nov. 8, 2020</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		let options = {
		'speed': 3000,
		'pause': true,
	}

	window.addEventListener('DOMContentLoaded', function() {
		let slider = document.querySelector('.rbd-review-slider');
		let slides = slider.querySelectorAll('.rbd-review');
		let total  = slides.length;
		let pause  = false;
		
		function pauseSlide(){
			slider.onmouseleave = function(){ pause = false; };
			slider.onmouseenter = function(){ pause = true; };
			return pause;
		}
		
		function slide(){
			if( options.pause && pauseSlide() ) return;
			
			let activeSlide = document.querySelector('.rbd-review-slider .rbd-review.rbd-curr');
			let prev, curr, next, soon;		
			
			curr = activeSlide;
			prev = activeSlide.previousElementSibling;
			next = activeSlide.nextElementSibling;
			
			if( next != null ){
				soon = next.nextElementSibling == null ? slides[0] : next.nextElementSibling;
			} else {
				next = slides[0];
				soon = slides[1];
			}
			
			if( prev != null ) prev.classList.remove('rbd-prev', 'rbd-curr', 'rbd-next');
			if( curr != null ) curr.classList.remove('rbd-prev', 'rbd-curr', 'rbd-next'); curr.classList.add('rbd-prev');
			if( next != null ) next.classList.remove('rbd-prev', 'rbd-curr', 'rbd-next'); next.classList.add('rbd-curr');
			if( soon != null ) soon.classList.remove('rbd-prev', 'rbd-curr', 'rbd-next'); soon.classList.add('rbd-next');
		}
		
		let slideTimer = setInterval(function(){
			slide();
		}, options.speed);
	}, true);
	</script>

	<!---------- content ---------->
	<div class="content">
		<div class="container">
			    <div class="hero">
          			<div class="hero-title">
            			Our Story
            			<br>
            			What or Who Chromerce is...
          			</div>
    			</div>
    			<div class="col-2">
					<img src="images/about.jpg">
				</div>
			<div class="intro">
				<p>Chromerce is an all-in-one Marketing Platform for small and large businesses alike. We empower millions of customers around the world to start and grow their businesses with our smart marketing technology, award-winning support, and inspiring content. Founded in 2020 and headquartered in Montreal Chromerce is 100% founder-owned and highly profitable.</p>
			</div>
			<div class="culture">
				<h2>Culture</h2>
				<p>Chromerce strives to create a culture that empowers a humble, creative, and independent workforce. We are passionate about our customers and believe that collaboration and creativity are powerful tools to help them make their dreams a reality.</p>
				<p>We believe that what makes us different makes us stronger. Building a more diverse, inclusive, and equitable organization is good for our teams, our customers, and our community. We empower each other to bring unique perspectives and experiences to work, and we continually seek new ways to do so.</p>
				<img src="images/culture.jpg">
				<p>We help our team members thrive in the Chromerce of today and support them in building the Chromerce of tomorrow. We do this in a number of ways—through leadership development programs, learning resources, and enriching experiences both in and out of the office. With these resources, we work to establish a foundation of consistency and equity to build on so we can continue to adapt, experiment, embrace failure, and create value.</p>
			</div>
			<div class="corporate-citizenship">
				<h2>Corporate Citizenship</h2>
				<p>We love our hometown of Montreal, and we’ve invested more than $7 million in the community since 2020. Each year [Chromerce gives great ideas a platform to get started, and we give effective nonprofit organizations the opportunity to grow.</p>
				<img src="images/community.jpg">
			</div>
		</div>
	</div>

	<!---------- footer ---------->
	<?php
	include("footer.php");
	?>





</body>
</html>