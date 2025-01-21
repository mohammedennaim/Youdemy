<?php
require_once "../../vendor/autoload.php";
use App\Controllers\Courses\CourseController;
session_start();
$courseInstance = new CourseController();
$courses = $courseInstance->getAllCourses();

if (isset($_POST["logout"])) {
    $role = $_SESSION["role"];
    session_name('session_' . $role);
    session_unset();
    session_destroy();
    header("Location: ../../../auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Academy</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Academy project">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="./etudiant/styles/bootstrap4/bootstrap.min.css">
	<link href="./etudiant/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="./etudiant/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="./etudiant/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
	<link rel="stylesheet" type="text/css" href="./etudiant/plugins/OwlCarousel2-2.2.1/animate.css">
	<link rel="stylesheet" type="text/css" href="./etudiant/styles/main_styles.css">
	<link rel="stylesheet" type="text/css" href="./etudiant/styles/responsive.css">

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
										<li class="active"><a href="home.php">Home</a></li>
										<li><a href="about.php">About</a></li>
										<li><a href="courses.php">Courses</a></li>
										<li><a href="blog.php">Blog</a></li>
										<?php if (isset($_SESSION["id"]) && isset($_SESSION["role"])): ?>
											<li class="dropdown">
												<a href="#" class="dropbtn">Profil</a>
												<div class="dropdown-content">
													<a href="profile.php">Voir le profil</a>
													<a href="settings.php">Paramètres</a>
													<form method="post">
														<button type="submit" name="logout"
															class="logout-button">Déconnexion</button>
													</form>
												</div>
											</li>
										<?php else: ?>
											<li><a href="./auth/login.php">Login</a></li>
											<li><a href="./auth/signup.php">Register</a></li>
										<?php endif; ?>
									</ul>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>

		<div class="home">
			<div class="home_slider_container">
				<div class="owl-carousel owl-theme home_slider">
					<div class="owl-item">
						<div class="home_slider_background"
							style="background-image:url(./etudiant/images/home_slider_1.jpg)">
						</div>
						<div class="home_slider_content">
							<div class="container">
								<div class="row">
									<div class="col text-center">
										<div class="home_slider_title">The Premium System Education</div>
										<div class="home_slider_subtitle">Future Of Education Technology</div>
										<div class="home_slider_form_container">
											<form action="#" id="home_search_form_1"
												class="home_search_form d-flex flex-lg-row flex-column align-items-center justify-content-between">
												<div class="d-flex flex-row align-items-center justify-content-start">
													<input type="search" class="home_search_input"
														placeholder="Keyword Search" required="required">
													<select class="dropdown_item_select home_search_input">
														<option>Category Courses</option>
														<option>Category</option>
														<option>Category</option>
													</select>
													<select class="dropdown_item_select home_search_input">
														<option>Select Price Type</option>
														<option>Price Type</option>
														<option>Price Type</option>
													</select>
												</div>
												<button type="submit" class="home_search_button">search</button>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="owl-item">
						<div class="home_slider_background"
							style="background-image:url(./etudiant/images/home_slider_1.jpg)">
						</div>
						<div class="home_slider_content">
							<div class="container">
								<div class="row">
									<div class="col text-center">
										<div class="home_slider_title">The Premium System Education</div>
										<div class="home_slider_subtitle">Future Of Education Technology</div>
										<div class="home_slider_form_container">
											<form action="#" id="home_search_form_2"
												class="home_search_form d-flex flex-lg-row flex-column align-items-center justify-content-between">
												<div class="d-flex flex-row align-items-center justify-content-start">
													<input type="search" class="home_search_input"
														placeholder="Keyword Search" required="required">
													<select class="dropdown_item_select home_search_input">
														<option>Category Courses</option>
														<option>Category</option>
														<option>Category</option>
													</select>
													<select class="dropdown_item_select home_search_input">
														<option>Select Price Type</option>
														<option>Price Type</option>
														<option>Price Type</option>
													</select>
												</div>
												<button type="submit" class="home_search_button">search</button>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="owl-item">
						<div class="home_slider_background"
							style="background-image:url(./etudiant/images/home_slider_1.jpg)">
						</div>
						<div class="home_slider_content">
							<div class="container">
								<div class="row">
									<div class="col text-center">
										<div class="home_slider_title">The Premium System Education</div>
										<div class="home_slider_subtitle">Future Of Education Technology</div>
										<div class="home_slider_form_container">
											<form action="#" id="home_search_form_3"
												class="home_search_form d-flex flex-lg-row flex-column align-items-center justify-content-between">
												<div class="d-flex flex-row align-items-center justify-content-start">
													<input type="search" class="home_search_input"
														placeholder="Keyword Search" required="required">
													<select class="dropdown_item_select home_search_input">
														<option>Category Courses</option>
														<option>Category</option>
														<option>Category</option>
													</select>
													<select class="dropdown_item_select home_search_input">
														<option>Select Price Type</option>
														<option>Price Type</option>
														<option>Price Type</option>
													</select>
												</div>
												<button type="submit" class="home_search_button">search</button>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="home_slider_nav home_slider_prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
			<div class="home_slider_nav home_slider_next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
		</div>
		<div class="features">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="section_title_container text-center">
							<h2 class="section_title">Welcome To Academy E-Learning</h2>
							<div class="section_subtitle">
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel gravida arcu.
									Vestibulum feugiat, sapien ultrices fermentum congue, quam velit venenatis sem</p>
							</div>
						</div>
					</div>
				</div>
				<div class="row features_row">
					<div class="col-lg-3 feature_col">
						<div class="feature text-center trans_400">
							<div class="feature_icon"><img src="./etudiant/images/icon_1.png" alt=""></div>
							<h3 class="feature_title">The Experts</h3>
							<div class="feature_text">
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
							</div>
						</div>
					</div>
					<div class="col-lg-3 feature_col">
						<div class="feature text-center trans_400">
							<div class="feature_icon"><img src="./etudiant/images/icon_2.png" alt=""></div>
							<h3 class="feature_title">Book & Library</h3>
							<div class="feature_text">
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
							</div>
						</div>
					</div>
					<div class="col-lg-3 feature_col">
						<div class="feature text-center trans_400">
							<div class="feature_icon"><img src="./etudiant/images/icon_3.png" alt=""></div>
							<h3 class="feature_title">Best Courses</h3>
							<div class="feature_text">
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
							</div>
						</div>
					</div>
					<div class="col-lg-3 feature_col">
						<div class="feature text-center trans_400">
							<div class="feature_icon"><img src="./etudiant/images/icon_4.png" alt=""></div>
							<h3 class="feature_title">Award & Reward</h3>
							<div class="feature_text">
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="courses">
			<div class="section_background parallax-window" data-parallax="scroll"
				data-image-src="./etudiant/images/courses_background.jpg" data-speed="0.8"></div>
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="section_title_container text-center">
							<h2 class="section_title">Popular Online Courses</h2>
							<div class="section_subtitle">
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel gravida arcu.
									Vestibulum feugiat, sapien ultrices fermentum congue, quam velit venenatis sem</p>
							</div>
						</div>
					</div>
				</div>
				<div class="row courses_row">
					<?php
					$courseInstance = new CourseController();
					$courses = $courseInstance->getAllCourses();
					for ($i = 0; $i < 3; $i++) {
						// var_dump($courses[0]['content']);
						?>
						<div class="course-card">
							<video controls autoplay class="style-video">
								<source src="./etudiant/<?= $courses[$i]['content']; ?>" type="video/mp4">
							</video>
							<div class="course-info">
								<div class="course-title"><?= $courses[$i]['title']; ?></div>
								<div class="course-instructor"><?= $courses[$i]['teacher_name']; ?></div>
								<div class="course-description"><?= $courses[$i]['description']; ?></div>
							</div>
							<div class="course-footer">
								<div class="span">
									<p>🎓 <?= $courses[$i]['user_count']; ?> Etudiant</p>
								</div>
								<div>
									<button
										class="header_search_button d-flex flex-column align-items-center justify-content-center">
										<div class="enroll_button trans_200"><a href="./course.php">En Plus</a></div>
									</button>
								</div>
							</div>
						</div>
						<?php
					}
					?>
				</div>
				<div class="row">
					<div class="col">
						<div class="courses_button trans_200"><a href="./courses.php">view all courses</a></div>
					</div>
				</div>
			</div>
			<div class="counter">
				<div class="counter_background" style="background-image:url(./etudiant/images/counter_background.jpg)">
				</div>
				<div class="container">
					<div class="row">
						<div class="col-lg-6">
							<div class="counter_content">
								<div class="counter_text">
									<p>Simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
										the
										industry’s standard dumy text ever since the 1500s, when an unknown printer took
										a
										galley of type and scrambled it to make a type specimen book.</p>
								</div>
								<div
									class="milestones d-flex flex-md-row flex-column align-items-center justify-content-between">
									<div class="milestone">
										<div class="milestone_counter" data-end-value="15">0</div>
										<div class="milestone_text">Teacher</div>
									</div>
									<div class="milestone">
										<div class="milestone_counter" data-end-value="120" data-sign-after="k">0</div>
										<div class="milestone_text">Etudiants</div>
									</div>
									<div class="milestone">
										<div class="milestone_counter" data-end-value="670" data-sign-after="+">0</div>
										<div class="milestone_text">Courses</div>
									</div>
									<div class="milestone">
										<div class="milestone_counter" data-end-value="320">0</div>
										<div class="milestone_text">years</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="counter_form">
						<div class="row fill_height">
							<div class="col fill_height">
								<form
									class="counter_form_content d-flex flex-column align-items-center justify-content-center"
									action="#">
									<div class="counter_form_title">courses now</div>
									<input type="text" class="counter_input" placeholder="Your Name:"
										required="required">
									<input type="tel" class="counter_input" placeholder="Phone:" required="required">
									<select name="counter_select" id="counter_select"
										class="counter_input counter_options">
										<option>Choose Subject</option>
										<option>Subject</option>
										<option>Subject</option>
										<option>Subject</option>
									</select>
									<textarea class="counter_input counter_text_input" placeholder="Message:"
										required="required"></textarea>
									<button type="submit" class="counter_form_button">submit now</button>
								</form>
							</div>
						</div>
					</div>

				</div>
			</div>
			<div class="events">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="section_title_container text-center">
								<h2 class="section_title">Upcoming events</h2>
								<div class="section_subtitle">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel gravida arcu.
										Vestibulum feugiat, sapien ultrices fermentum congue, quam velit venenatis sem
									</p>
								</div>
							</div>
						</div>
					</div>
					<div class="row events_row">
						<div class="col-lg-4 event_col">
							<div class="event event_left">
								<div class="event_image"><img src="./etudiant/images/event_1.jpg" alt=""></div>
								<div class="event_body d-flex flex-row align-items-start justify-content-start">
									<div class="event_date">
										<div
											class="d-flex flex-column align-items-center justify-content-center trans_200">
											<div class="event_day trans_200">21</div>
											<div class="event_month trans_200">Aug</div>
										</div>
									</div>
									<div class="event_content">
										<div class="event_title"><a href="#">Which Country Handles Student Debt?</a>
										</div>
										<div class="event_info_container">
											<div class="event_info"><i class="fa fa-clock-o"
													aria-hidden="true"></i><span>15.00 - 19.30</span></div>
											<div class="event_info"><i class="fa fa-map-marker"
													aria-hidden="true"></i><span>25 New York City</span></div>
											<div class="event_text">
												<p>Policy analysts generally agree on a need for reform, but not on
													which
													path...</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 event_col">
							<div class="event event_mid">
								<div class="event_image"><img src="./etudiant/images/event_2.jpg" alt=""></div>
								<div class="event_body d-flex flex-row align-items-start justify-content-start">
									<div class="event_date">
										<div
											class="d-flex flex-column align-items-center justify-content-center trans_200">
											<div class="event_day trans_200">27</div>
											<div class="event_month trans_200">Aug</div>
										</div>
									</div>
									<div class="event_content">
										<div class="event_title"><a href="#">Repaying your student loans (Winter
												2017-2018)</a></div>
										<div class="event_info_container">
											<div class="event_info"><i class="fa fa-clock-o"
													aria-hidden="true"></i><span>09.00 - 17.30</span></div>
											<div class="event_info"><i class="fa fa-map-marker"
													aria-hidden="true"></i><span>25 Brooklyn City</span></div>
											<div class="event_text">
												<p>This Consumer Action News issue covers topics now being debated
													before...
												</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 event_col">
							<div class="event event_right">
								<div class="event_image"><img src="./etudiant/images/event_3.jpg" alt=""></div>
								<div class="event_body d-flex flex-row align-items-start justify-content-start">
									<div class="event_date">
										<div
											class="d-flex flex-column align-items-center justify-content-center trans_200">
											<div class="event_day trans_200">01</div>
											<div class="event_month trans_200">Sep</div>
										</div>
									</div>
									<div class="event_content">
										<div class="event_title"><a href="#">Alternative data and financial
												inclusion</a>
										</div>
										<div class="event_info_container">
											<div class="event_info"><i class="fa fa-clock-o"
													aria-hidden="true"></i><span>13.00 - 18.30</span></div>
											<div class="event_info"><i class="fa fa-map-marker"
													aria-hidden="true"></i><span>25 New York City</span></div>
											<div class="event_text">
												<p>Policy analysts generally agree on a need for reform, but not on
													which
													path...</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="team">
				<div class="team_background parallax-window" data-parallax="scroll"
					data-image-src="./etudiant/images/team_background.jpg" data-speed="0.8"></div>
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="section_title_container text-center">
								<h2 class="section_title">The Best Teacher in School</h2>
								<div class="section_subtitle">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel gravida arcu.
										Vestibulum feugiat, sapien ultrices fermentum congue, quam velit venenatis sem
									</p>
								</div>
							</div>
						</div>
					</div>
					<div class="row team_row">
						<?php
						for ($i = 0; $i < 4; $i++) {
							?>
							<div class="col-lg-3 col-md-6 team_col">
								<div class="team_item">
									<div class="team_image"><img src="./etudiant/images/team_2.jpg" alt=""></div>
									<div class="team_body">

										<div class="team_title"><a href="#"><?= $courses[$i]['teacher_name']; ?></a></div>
										<div class="team_subtitle"><?= $courses[$i]['title']; ?></div>
										<div class="social_list">
											<ul>
												<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
												<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
												<li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<?php
						}
						?>
					</div>
				</div>
			</div>
			<div class="news">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="section_title_container text-center">
								<h2 class="section_title">Latest News</h2>
								<div class="section_subtitle">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel gravida arcu.
										Vestibulum feugiat, sapien ultrices fermentum congue, quam velit venenatis sem
									</p>
								</div>
							</div>
						</div>
					</div>
					<div class="row news_row">
						<div class="col-lg-7 news_col">
							<div class="news_post_large_container">
								<div class="news_post_large">
									<div class="news_post_image"><img src="./etudiant/images/news_1.jpg" alt=""></div>
									<div class="news_post_large_title"><a href="blog_single.php">Here’s What You Need to
											Know About Online Testing for the ACT and SAT</a></div>
									<div class="news_post_meta">
										<ul>
											<li><a href="#">admin</a></li>
											<li><a href="#">november 11, 2017</a></li>
										</ul>
									</div>
									<div class="news_post_text">
										<p>Policy analysts generally agree on a need for reform, but not on which path
											policymakers should take. Can America learn anything from other nations...
										</p>
									</div>
									<div class="news_post_link"><a href="blog_single.php">read more</a></div>
								</div>
							</div>
						</div>
						<div class="col-lg-5 news_col">
							<div class="news_posts_small">
								<div class="news_post_small">
									<div class="news_post_small_title"><a href="blog_single.php">Home-based business
											insurance issue (Spring 2017 - 2018)</a></div>
									<div class="news_post_meta">
										<ul>
											<li><a href="#">admin</a></li>
											<li><a href="#">november 11, 2017</a></li>
										</ul>
									</div>
								</div>
								<div class="news_post_small">
									<div class="news_post_small_title"><a href="blog_single.php">2018 Fall Issue: Credit
											Card Comparison Site Survey (Summer 2018)</a></div>
									<div class="news_post_meta">
										<ul>
											<li><a href="#">admin</a></li>
											<li><a href="#">november 11, 2017</a></li>
										</ul>
									</div>
								</div>
								<div class="news_post_small">
									<div class="news_post_small_title"><a href="blog_single.php">Cuentas de cheques
											gratuitas una encuesta de Consumer Action</a></div>
									<div class="news_post_meta">
										<ul>
											<li><a href="#">admin</a></li>
											<li><a href="#">november 11, 2017</a></li>
										</ul>
									</div>
								</div>
								<div class="news_post_small">
									<div class="news_post_small_title"><a href="blog_single.php">Troubled borrowers have
											fewer repayment or forgiveness options</a></div>
									<div class="news_post_meta">
										<ul>
											<li><a href="#">admin</a></li>
											<li><a href="#">november 11, 2017</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="newsletter">
				<div class="newsletter_background parallax-window" data-parallax="scroll"
					data-image-src="./etudiant/images/newsletter.jpg" data-speed="0.8"></div>
				<div class="container">
					<div class="row">
						<div class="col">
							<div
								class="newsletter_container d-flex flex-lg-row flex-column align-items-center justify-content-start">
								<div class="newsletter_content text-lg-left text-center">
									<div class="newsletter_title">sign up for news and offers</div>
									<div class="newsletter_subtitle">Subcribe to lastest smartphones news & great deals
										we
										offer</div>
								</div>
								<div class="newsletter_form_container ml-lg-auto">
									<form action="#" id="newsletter_form"
										class="newsletter_form d-flex flex-row align-items-center justify-content-center">
										<input type="email" class="newsletter_input" placeholder="Your Email"
											required="required">
										<button type="submit" class="newsletter_button">subscribe</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<footer class="footer">
				<div class="footer_background" style="background-image:url(./etudiant/images/footer_background.png)">
				</div>
				<div class="container">
					<div class="row footer_row">
						<div class="col">
							<div class="footer_content">
								<div class="row">
									<div class="col-lg-3 footer_col">
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
													<li><a href="#"><i class="fa fa-facebook"
																aria-hidden="true"></i></a>
													</li>
													<li><a href="#"><i class="fa fa-google-plus"
																aria-hidden="true"></i></a>
													</li>
													<li><a href="#"><i class="fa fa-instagram"
																aria-hidden="true"></i></a>
													</li>
													<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
													</li>
												</ul>
											</div>
										</div>
									</div>
									<div class="col-lg-3 footer_col">
										<div class="footer_section footer_contact">
											<div class="footer_title">Contact Us</div>
											<div class="footer_contact_info">
												<ul>
													<li>Email: Info.deercreative@gmail.com</li>
													<li>Phone: +(88) 111 555 666</li>
													<li>40 Baria Sreet 133/2 New York City, United States</li>
												</ul>
											</div>
										</div>
									</div>
									<div class="col-lg-3 footer_col">
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
										<div class="footer_section footer_mobile">
											<div class="footer_title">Mobile</div>
											<div class="footer_mobile_content">
												<div class="footer_image"><a href="#"><img
															src="./etudiant/images/mobile_1.png" alt=""></a></div>
												<div class="footer_image"><a href="#"><img
															src="./etudiant/images/mobile_2.png" alt=""></a></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row copyright_row">
						<div class="col">
							<div
								class="copyright d-flex flex-lg-row flex-column align-items-center justify-content-start">
								<div class="cr_text">
									Copyright &copy;
									<script>document.write(new Date().getFullYear());</script> All rights reserved |
									This
									template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a
										href="https://colorlib.com" target="_blank">Colorlib</a>
								</div>
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
		<script src="./etudiant/plugins/greensock/TweenMax.min.js"></script>
		<script src="./etudiant/plugins/greensock/TimelineMax.min.js"></script>
		<script src="./etudiant/plugins/scrollmagic/ScrollMagic.min.js"></script>
		<script src="./etudiant/plugins/greensock/animation.gsap.min.js"></script>
		<script src="./etudiant/plugins/greensock/ScrollToPlugin.min.js"></script>
		<script src="./etudiant/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
		<script src="./etudiant/plugins/easing/easing.js"></script>
		<script src="./etudiant/plugins/parallax-js-master/parallax.min.js"></script>
		<script src="./etudiant/js/custom.js"></script>

		<script>
			const profileMenuButton = document.getElementById('profileMenuButton');
			const profileMenu = document.getElementById('profileMenu');

			profileMenuButton.addEventListener('click', () => {
				profileMenu.classList.toggle('hidden');
			});

			window.addEventListener('click', (e) => {
				if (!profileMenuButton.contains(e.target) && !profileMenu.contains(e.target)) {
					profileMenu.classList.add('hidden');
				}
			});
		</script>
</body>

</html>