<?php
session_start();
if (!isset($_SESSION["role"]) && !isset($_SESSION["id"]) && !$_SESSION["role"] == "etudiant") {
	header("location:../auth/login.php");
}
if (isset($_POST["logout"])) {
    session_unset();
    session_destroy();
    header("Location: ../auth/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Blog Single</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Academy project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="./etudiant/styles/bootstrap4/bootstrap.min.css">
<link href="./etudiant/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="./etudiant/plugins/colorbox/colorbox.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="./etudiant/styles/blog_single.css">
<link rel="stylesheet" type="text/css" href="./etudiant/styles/blog_single_responsive.css">
</head>
<body>

<div class="super_container">

<header class="header">
			<div class="header_container">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="header_content d-flex flex-row align-items-center justify-content-start">
								<div class="logo_container">
									<a href="#">
										<div class="logo_text"><span>Aca</span>demy</div>
									</a>
								</div>
								<nav class="main_nav_contaner ml-auto">
									<ul class="main_nav">
										<li><a href="home.php">Home</a></li>
										<li><a href="about.php">About</a></li>
										<li><a href="courses.php">Courses</a></li>
										<li class="active"><a href="blog.php">Blog</a></li>
										<li class="dropdown">
											<a href="#" class="dropbtn">Profil</a>
											<div class="dropdown-content">
												<a href="profile.php">Voir le profil</a>
												<a href="settings.php">Paramètres</a>
												<a href="logout.php">Déconnexion</a>
											</div>
										</li>
									</ul>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>
	<div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
		<div class="menu_close_container"><div class="menu_close"><div></div><div></div></div></div>
		<div class="search">
			<form action="#" class="header_search_form menu_mm">
				<input type="search" class="search_input menu_mm" placeholder="Search" required="required">
				<button class="header_search_button d-flex flex-column align-items-center justify-content-center menu_mm">
					<i class="fa fa-search menu_mm" aria-hidden="true"></i>
				</button>
			</form>
		</div>
		<nav class="menu_nav">
			<ul class="menu_mm">
				<li class="menu_mm"><a href="home.php">Home</a></li>
				<li class="menu_mm"><a href="#">About</a></li>
				<li class="menu_mm"><a href="#">Courses</a></li>
				<li class="menu_mm"><a href="#">Blog</a></li>
				<li class="menu_mm"><a href="#">Page</a></li>
				<li class="menu_mm"><a href="contact.php">Contact</a></li>
			</ul>
		</nav>
	</div>
	
	<!-- Home -->

	<div class="home">
		<div class="breadcrumbs_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="breadcrumbs">
							<ul>
								<li><a href="home.php">Home</a></li>
								<li><a href="blog.php">Blog</a></li>
								<li>Blog Single</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>			
	</div>

	<!-- Blog -->

	<div class="blog">
		<div class="container">
			<div class="row">

				<!-- Blog Content -->
				<div class="col-lg-8">
					<div class="blog_content">
						<div class="blog_title">‘I Kept Thinking of Antioch’: Long Before #MeToo, a times Video Journalist Remembered</div>
						<div class="blog_meta">
							<ul>
								<li>Post on <a href="#">May 5, 2018</a></li>
								<li>By <a href="#">admin</a></li>
							</ul>
						</div>
						<div class="blog_image"><img src="./etudiant/images/blog_single.jpg" alt=""></div>
						<p>Times Insider delivers behind-the-scenes insights into how news, features and opinion come together at The New York Times.Before I could spend the night in my younger sister’s dorm room at Antioch College in Yellow Springs, Ohio — before I could read the spines of her textbooks or drink a disgusting but lovingly prepared vodka/sparkling wine/Red Bull — I had to report to security:</p>
						<div class="blog_quote d-flex flex-row align-items-center justify-content-start">
							<i class="fa fa-quote-left" aria-hidden="true"></i>
							<div>“All sexual interactions at Antioch College must be consensual. Consent means verbally asking and verbally giving or denying consent.”</div>
						</div>
						<p>It was 2004, a decade before the phrase “affirmative consent” made it onto news shows or big university campuses. I was 21, a junior at another college. I think it was the first time I had heard people talk about consent as something you could ask for verbally. It was definitely the first time I’d ever seen it written out like that.</p>
						<p>The first-of-its-kind affirmative consent policy was written by students in 1990 as a response to campus rape. But the first thing anyone who was at Antioch in the ’90s wanted to talk to me about was the media mayhem. When The Associated Press ran an article on the policy with the headline “No huggy, no kissy without a ‘yes’ at Antioch College,” it ignited a cultural firestorm.</p>
						<div class="blog_subtitle">All the current students</div>
						<p>I followed up with for the video told me that being sexual with an Antioch student is different from being sexual with someone else. They spoke of a common language everyone is taught beginning at orientation, so that when one student starts asking questions of another student in the midst of sexual activity, it doesn’t seem so out there.</p>
						<div class="blog_images">
							<div class="row">
								<div class="col-lg-6 blog_images_col"><div class="blog_image_small"><img src="./etudiant/images/blog_images_1.jpg" alt=""></div></div>
								<div class="col-lg-6 blog_images_col"><div class="blog_image_small"><img src="./etudiant/images/blog_images_2.jpg" alt=""></div></div>
							</div>
						</div>
						<p>But what is it like to be an 18-year-old and have the expectation set that you will talk during sex? I, for one, have never been part of a community with that expectation. Spending time at Antioch’s orientation, I thought about how that might change your sexual interactions for the rest of your life.</p>
					</div>
					<div class="blog_extra d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-start">
						<div class="blog_tags">
							<span>Tags: </span>
							<ul>
								<li><a href="#">Education</a>, </li>
								<li><a href="#">Math</a>, </li>
								<li><a href="#">Food</a>, </li>
								<li><a href="#">Schools</a>, </li>
								<li><a href="#">Religion</a>, </li>
							</ul>
						</div>
						<div class="blog_social ml-lg-auto">
							<span>Share: </span>
							<ul>
								<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
							</ul>
						</div>
					</div>
					<!-- Comments -->
					<div class="comments_container">
						<div class="comments_title"><span>30</span> Comments</div>
						<ul class="comments_list">
							<li>
								<div class="comment_item d-flex flex-row align-items-start jutify-content-start">
									<div class="comment_image"><div><img src="./etudiant/images/comment_1.jpg" alt=""></div></div>
									<div class="comment_content">
										<div class="comment_title_container d-flex flex-row align-items-center justify-content-start">
											<div class="comment_author"><a href="#">Jennifer Aniston</a></div>
											<div class="comment_rating"><div class="rating_r rating_r_4"><i></i><i></i><i></i><i></i><i></i></div></div>
											<div class="comment_time ml-auto">October 19,2018</div>
										</div>
										<div class="comment_text">
											<p>There are many variations of passages of Lorem Ipsum available, but the majority have alteration in some form, by injected humour.</p>
										</div>
										<div class="comment_extras d-flex flex-row align-items-center justify-content-start">
											<div class="comment_extra comment_likes"><a href="#"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span>108</span></a></div>
											<div class="comment_extra comment_reply"><a href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i><span>Reply</span></a></div>
										</div>
									</div>
								</div>
								<ul>
									<li>
										<div class="comment_item d-flex flex-row align-items-start jutify-content-start">
											<div class="comment_image"><div><img src="./etudiant/images/comment_2.jpg" alt=""></div></div>
											<div class="comment_content">
												<div class="comment_title_container d-flex flex-row align-items-center justify-content-start">
													<div class="comment_author"><a href="#">John Smith</a></div>
													<div class="comment_rating"><div class="rating_r rating_r_4"><i></i><i></i><i></i><i></i><i></i></div></div>
													<div class="comment_time ml-auto">October 19,2018</div>
												</div>
												<div class="comment_text">
													<p>There are many variations of passages of Lorem Ipsum available, but the majority have alteration in some form, by injected humour.</p>
												</div>
												<div class="comment_extras d-flex flex-row align-items-center justify-content-start">
													<div class="comment_extra comment_likes"><a href="#"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span>108</span></a></div>
													<div class="comment_extra comment_reply"><a href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i><span>Reply</span></a></div>
												</div>
											</div>
										</div>
									</li>
								</ul>
							</li>
							<li>
								<div class="comment_item d-flex flex-row align-items-start jutify-content-start">
									<div class="comment_image"><div><img src="./etudiant/images/comment_3.jpg" alt=""></div></div>
									<div class="comment_content">
										<div class="comment_title_container d-flex flex-row align-items-center justify-content-start">
											<div class="comment_author"><a href="#">Jane Austen</a></div>
											<div class="comment_rating"><div class="rating_r rating_r_4"><i></i><i></i><i></i><i></i><i></i></div></div>
											<div class="comment_time ml-auto">October 19,2018</div>
										</div>
										<div class="comment_text">
											<p>There are many variations of passages of Lorem Ipsum available, but the majority have alteration in some form, by injected humour.</p>
										</div>
										<div class="comment_extras d-flex flex-row align-items-center justify-content-start">
											<div class="comment_extra comment_likes"><a href="#"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span>108</span></a></div>
											<div class="comment_extra comment_reply"><a href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i><span>Reply</span></a></div>
										</div>
									</div>
								</div>
							</li>
						</ul>
						<div class="add_comment_container">
							<div class="add_comment_title">Write a comment</div>
							<div class="add_comment_text">Your email address will not be published. Required fields are marked *</div>
							<form action="#" class="comment_form">
								<div>
									<div class="form_title">Review*</div>
									<textarea class="comment_input comment_textarea" required="required"></textarea>
								</div>
								<div class="row">
									<div class="col-md-6 input_col">
										<div class="form_title">Name*</div>
										<input type="text" class="comment_input" required="required">
									</div>
									<div class="col-md-6 input_col">
										<div class="form_title">Email*</div>
										<input type="text" class="comment_input" required="required">
									</div>
								</div>
								<div class="comment_notify">
									<input type="checkbox" id="checkbox_notify" name="regular_checkbox" class="regular_checkbox checkbox_account" checked>
									<label for="checkbox_notify"><i class="fa fa-check" aria-hidden="true"></i></label>
									<span>Notify me of new posts by email</span>
								</div>
								<div>
									<button type="submit" class="comment_button trans_200">submit</button>
								</div>
							</form>
						</div>
					</div>
				</div>

				<!-- Blog Sidebar -->
				<div class="col-lg-4">
					<div class="sidebar">

						<!-- Categories -->
						<div class="sidebar_section">
							<div class="sidebar_section_title">Categories</div>
							<div class="sidebar_categories">
								<ul class="categories_list">
									<li><a href="#" class="clearfix">Art & Design<span>(25)</span></a></li>
									<li><a href="#" class="clearfix">Business<span>(10)</span></a></li>
									<li><a href="#" class="clearfix">IT & Software<span>(22)</span></a></li>
									<li><a href="#" class="clearfix">Languages<span>(12)</span></a></li>
									<li><a href="#" class="clearfix">Programming<span>(18)</span></a></li>
								</ul>
							</div>
						</div>

						<!-- Latest News -->
						<div class="sidebar_section">
							<div class="sidebar_section_title">Latest Courses</div>
							<div class="sidebar_latest">

								<!-- Latest Course -->
								<div class="latest d-flex flex-row align-items-start justify-content-start">
									<div class="latest_image"><div><img src="./etudiant/images/latest_1.jpg" alt=""></div></div>
									<div class="latest_content">
										<div class="latest_title"><a href="course.php">How to Design a Logo a Beginners Course</a></div>
										<div class="latest_date">november 11, 2017</div>
									</div>
								</div>

								<!-- Latest Course -->
								<div class="latest d-flex flex-row align-items-start justify-content-start">
									<div class="latest_image"><div><img src="./etudiant/images/latest_2.jpg" alt=""></div></div>
									<div class="latest_content">
										<div class="latest_title"><a href="course.php">Photography for Beginners Masterclass</a></div>
										<div class="latest_date">november 11, 2017</div>
									</div>
								</div>

								<!-- Latest Course -->
								<div class="latest d-flex flex-row align-items-start justify-content-start">
									<div class="latest_image"><div><img src="./etudiant/images/latest_3.jpg" alt=""></div></div>
									<div class="latest_content">
										<div class="latest_title"><a href="course.php">The Secrets of Body Language</a></div>
										<div class="latest_date">november 11, 2017</div>
									</div>
								</div>

							</div>
						</div>

						<!-- Gallery -->
						<div class="sidebar_section">
							<div class="sidebar_section_title">Instagram</div>
							<div class="sidebar_gallery">
								<ul class="gallery_items d-flex flex-row align-items-start justify-content-between flex-wrap">
									<li class="gallery_item">
										<div class="gallery_item_overlay d-flex flex-column align-items-center justify-content-center">+</div>
										<a class="colorbox" href="./etudiant/images/gallery_1_large.jpg">
											<img src="./etudiant/images/gallery_1.jpg" alt="">
										</a>
									</li>
									<li class="gallery_item">
										<div class="gallery_item_overlay d-flex flex-column align-items-center justify-content-center">+</div>
										<a class="colorbox" href="./etudiant/images/gallery_2_large.jpg">
											<img src="./etudiant/images/gallery_2.jpg" alt="">
										</a>
									</li>
									<li class="gallery_item">
										<div class="gallery_item_overlay d-flex flex-column align-items-center justify-content-center">+</div>
										<a class="colorbox" href="./etudiant/images/gallery_3_large.jpg">
											<img src="./etudiant/images/gallery_3.jpg" alt="">
										</a>
									</li>
									<li class="gallery_item">
										<div class="gallery_item_overlay d-flex flex-column align-items-center justify-content-center">+</div>
										<a class="colorbox" href="./etudiant/images/gallery_4_large.jpg">
											<img src="./etudiant/images/gallery_4.jpg" alt="">
										</a>
									</li>
									<li class="gallery_item">
										<div class="gallery_item_overlay d-flex flex-column align-items-center justify-content-center">+</div>
										<a class="colorbox" href="./etudiant/images/gallery_5_large.jpg">
											<img src="./etudiant/images/gallery_5.jpg" alt="">
										</a>
									</li>
									<li class="gallery_item">
										<div class="gallery_item_overlay d-flex flex-column align-items-center justify-content-center">+</div>
										<a class="colorbox" href="./etudiant/images/gallery_6_large.jpg">
											<img src="./etudiant/images/gallery_6.jpg" alt="">
										</a>
									</li>
								</ul>
							</div>
						</div>

						<!-- Tags -->
						<div class="sidebar_section">
							<div class="sidebar_section_title">Tags</div>
							<div class="sidebar_tags">
								<ul class="tags_list">
									<li><a href="#">creative</a></li>
									<li><a href="#">unique</a></li>
									<li><a href="#">photography</a></li>
									<li><a href="#">ideas</a></li>
									<li><a href="#">wordpress</a></li>
									<li><a href="#">startup</a></li>
								</ul>
							</div>
						</div>

						<!-- Banner -->
						<div class="sidebar_section">
							<div class="sidebar_banner d-flex flex-column align-items-center justify-content-center text-center">
								<div class="sidebar_banner_background" style="background-image:url(./etudiant/images/banner_1.jpg)"></div>
								<div class="sidebar_banner_overlay"></div>
								<div class="sidebar_banner_content">
									<div class="banner_title">Free Book</div>
									<div class="banner_button"><a href="#">download now</a></div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Newsletter -->

	<div class="newsletter">
		<div class="newsletter_background" style="background-image:url(./etudiant/images/newsletter_background.jpg)"></div>
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="newsletter_container d-flex flex-lg-row flex-column align-items-center justify-content-start">

						<!-- Newsletter Content -->
						<div class="newsletter_content text-lg-left text-center">
							<div class="newsletter_title">sign up for news and offers</div>
							<div class="newsletter_subtitle">Subcribe to lastest smartphones news & great deals we offer</div>
						</div>

						<!-- Newsletter Form -->
						<div class="newsletter_form_container ml-lg-auto">
							<form action="#" id="newsletter_form" class="newsletter_form d-flex flex-row align-items-center justify-content-center">
								<input type="email" class="newsletter_input" placeholder="Your Email" required="required">
								<button type="submit" class="newsletter_button">subscribe</button>
							</form>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Footer -->

	<footer class="footer">
		<div class="footer_background" style="background-image:url(./etudiant/images/footer_background.png)"></div>
		<div class="container">
			<div class="row footer_row">
				<div class="col">
					<div class="footer_content">
						<div class="row">

							<div class="col-lg-3 footer_col">
					
								<!-- Footer About -->
								<div class="footer_section footer_about">
									<div class="footer_logo_container">
										<a href="#">
											<div class="footer_logo_text"><span>Aca</span>demy</div>
										</a>
									</div>
									<div class="footer_about_text">
										<p>Lorem ipsum dolor sit ametium, consectetur adipiscing elit.</p>
									</div>
									<div class="footer_social">
										<ul>
											<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
										</ul>
									</div>
								</div>
								
							</div>

							<div class="col-lg-3 footer_col">
					
								<!-- Footer Contact -->
								<div class="footer_section footer_contact">
									<div class="footer_title">Contact Us</div>
									<div class="footer_contact_info">
										<ul>
											<li>Email: Info.deercreative@gmail.com</li>
											<li>Phone:  +(88) 111 555 666</li>
											<li>40 Baria Sreet 133/2 New York City, United States</li>
										</ul>
									</div>
								</div>
								
							</div>

							<div class="col-lg-3 footer_col">
					
								<!-- Footer links -->
								<div class="footer_section footer_links">
									<div class="footer_title">Contact Us</div>
									<div class="footer_links_container">
										<ul>
											<li><a href="home.php">Home</a></li>
											<li><a href="about.php">About</a></li>
											<li><a href="contact.php">Contact</a></li>
											<li><a href="#">Features</a></li>
											<li><a href="courses.php">Courses</a></li>
											<li><a href="#">Events</a></li>
											<li><a href="#">Gallery</a></li>
											<li><a href="#">FAQs</a></li>
										</ul>
									</div>
								</div>
								
							</div>

							<div class="col-lg-3 footer_col clearfix">
					
								<!-- Footer links -->
								<div class="footer_section footer_mobile">
									<div class="footer_title">Mobile</div>
									<div class="footer_mobile_content">
										<div class="footer_image"><a href="#"><img src="./etudiant/images/mobile_1.png" alt=""></a></div>
										<div class="footer_image"><a href="#"><img src="./etudiant/images/mobile_2.png" alt=""></a></div>
									</div>
								</div>
								
							</div>

						</div>
					</div>
				</div>
			</div>

			<div class="row copyright_row">
				<div class="col">
					<div class="copyright d-flex flex-lg-row flex-column align-items-center justify-content-start">
						<div class="cr_text"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></div>
						<div class="ml-lg-auto cr_links">
							<ul class="cr_list">
								<li><a href="#">Copyright notification</a></li>
								<li><a href="#">Terms of Use</a></li>
								<li><a href="#">Privacy Policy</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
</div>

<script src="./etudiant/js/jquery-3.2.1.min.js"></script>
<script src="./etudiant/styles/bootstrap4/popper.js"></script>
<script src="./etudiant/styles/bootstrap4/bootstrap.min.js"></script>
<script src="./etudiant/plugins/easing/easing.js"></script>
<script src="./etudiant/plugins/parallax-js-master/parallax.min.js"></script>
<script src="./etudiant/plugins/colorbox/jquery.colorbox-min.js"></script>
<script src="./etudiant/js/blog_single.js"></script>
</body>
</html>