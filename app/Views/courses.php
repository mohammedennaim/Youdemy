<?php
require_once "../../vendor/autoload.php";
use App\Controllers\Courses\CourseController;
use App\Controllers\Admin\CategorieControllers;
use App\Controllers\Admin\TagControllers;

$categorie = new CategorieControllers();
$categories = $categorie->allCategories();

$tag = new TagControllers();
$tags = $tag->allTags();

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
	<title>Courses</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Academy project">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="./etudiant/styles/bootstrap4/bootstrap.min.css">
	<link href="./etudiant/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="./etudiant/plugins/colorbox/colorbox.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="./etudiant/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="./etudiant/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
	<link rel="stylesheet" type="text/css" href="./etudiant/plugins/OwlCarousel2-2.2.1/animate.css">
	<link rel="stylesheet" type="text/css" href="./etudiant/styles/courses.css">
	<link rel="stylesheet" type="text/css" href="./etudiant/styles/main_styles.css">
	<link rel="stylesheet" type="text/css" href="./etudiant/styles/courses_responsive.css">
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
										<li class="active"><a href="courses.php">Courses</a></li>
										<li><a href="blog.php">Blog</a></li>
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
			<div class="menu_close_container">
				<div class="menu_close">
					<div></div>
					<div></div>
				</div>
			</div>
			<div class="search">
				<form action="#" class="header_search_form menu_mm">
					<input type="search" class="search_input menu_mm" placeholder="Search" required="required">
					<button
						class="header_search_button d-flex flex-column align-items-center justify-content-center menu_mm">
						<i class="fa fa-search menu_mm" aria-hidden="true"></i>
					</button>
				</form>
			</div>

		</div>


		<!-- Courses -->
		<br>
		<br>
		<br>
		<br>

		<div class="courses">
			<div class="container">
				<div class="row">

					<!-- Courses Main Content -->
					<div class="col-lg-8">
						<div class="courses_search_container">
							<form action="#" method="GET" id="courses_search_form"
								class="courses_search_form d-flex flex-row align-items-center justify-content-start">
								<input type="search" name="search" class="courses_search_input"
									placeholder="Search Courses" required>
								<select id="courses_search_select" name="search_category"
									class="courses_search_select courses_search_input">
									<option value="">All Categories</option>
									<?php foreach ($categories as $category) { ?>
										<option value="<?php echo $category->getId(); ?>">
											<?php echo $category->getName(); ?>
										</option>
									<?php } ?>
								</select>
								<select id="courses_search_select" name="search_category"
									class="courses_search_select courses_search_input">
									<option value="">All Tags</option>
									<?php foreach ($tags as $tag) { ?>
										<option value="<?php echo $tag->getId(); ?>">
											<?php echo $tag->getName(); ?>
										</option>
									<?php } ?>
								</select>
								<button type="submit" class="courses_search_button ml-auto">search now</button>
							</form>
						</div>
						<div class="courses_container">
							<div class="row courses_row">

								<div class="courses">
									<div class="section_background parallax-window" data-parallax="scroll"
										data-image-src="./etudiant/images/courses_background.jpg" data-speed="0.8">
									</div>
									<div class="container">
										<div class="row">
											<div class="col">
												<div class="section_title_container text-center">
													<h2 class="section_title">Popular Online Courses</h2>
													<div class="section_subtitle">
														<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
															Donec vel gravida arcu. Vestibulum feugiat, sapien ultrices
															fermentum congue, quam velit venenatis sem</p>
													</div>
												</div>
											</div>
										</div>

										<div class="row courses_row">
											<?php
											$courseInstance = new CourseController();
											$courses = $courseInstance->getAllCourses();

											foreach ($courses as $course) {
												?>

												<div class="course-card">

													<video controls autoplay class="style-video">
														<source src="./assets/videos/video.mp4" type="video/mp4">
													</video>
													<div class="course-info">
														<div class="course-title"><?= $course['title']; ?></div>
														<div class="course-instructor"><?= $course['teacher_name']; ?>
														</div>
														<div class="course-description"><?= $course['description']; ?>
														</div>
													</div>
													<div class="course-footer">
														<div class="span">
															<p>🎓 <?= $course['user_count']; ?> Student</p>
														</div>
														<div>
															<button
																class="header_search_button d-flex flex-column align-items-center justify-content-center">
																<div class="enroll_button trans_200"><a
																		href="./course.php">En Plus</a></div>
															</button>
														</div>
													</div>
												</div>
												<br>
												<?php
											}
											?>

										</div>

									</div>
								</div>


							</div>
							<div class="row pagination_row">
								<div class="col">
									<div
										class="pagination_container d-flex flex-row align-items-center justify-content-start">
										<ul class="pagination_list">
											<li class="active"><a href="#">1</a></li>
											<li><a href="#">2</a></li>
											<li><a href="#">3</a></li>
											<li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
											</li>
										</ul>
										<div class="courses_show_container ml-auto clearfix">
											<div class="courses_show_text">Showing <span
													class="courses_showing">1-6</span> of <span
													class="courses_total">26</span> results:</div>
											<div class="courses_show_content">
												<span>Show: </span>
												<select id="courses_show_select" class="courses_show_select">
													<option>06</option>
													<option>12</option>
													<option>24</option>
													<option>36</option>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Courses Sidebar -->
					<div class="col-lg-4">
						<div class="sidebar">

							<!-- Categories -->
							<div class="sidebar_section">
								<div class="sidebar_section_title">Categories</div>
								<div class="sidebar_categories">
									<ul>
										<?php foreach ($categories as $category) { ?>
											<li><a href=""><?php echo $category->getName(); ?></a></li>
										<?php } ?>
									</ul>
								</div>
							</div>

							<!-- Latest Course -->
							<div class="sidebar_section">
								<div class="sidebar_section_title">Latest Courses</div>
								<div class="sidebar_latest">

									<!-- Latest Course -->
									<div class="latest d-flex flex-row align-items-start justify-content-start">
										<div class="latest_image">
											<div><img src="./etudiant/images/latest_1.jpg" alt=""></div>
										</div>
										<div class="latest_content">
											<div class="latest_title"><a href="course.html">How to Design a Logo a
													Beginners Course</a></div>
											<div class="latest_price">Free</div>
										</div>
									</div>

									<!-- Latest Course -->
									<div class="latest d-flex flex-row align-items-start justify-content-start">
										<div class="latest_image">
											<div><img src="./etudiant/images/latest_2.jpg" alt=""></div>
										</div>
										<div class="latest_content">
											<div class="latest_title"><a href="course.html">Photography for Beginners
													Masterclass</a></div>
											<div class="latest_price">$170</div>
										</div>
									</div>

									<!-- Latest Course -->
									<div class="latest d-flex flex-row align-items-start justify-content-start">
										<div class="latest_image">
											<div><img src="./etudiant/images/latest_3.jpg" alt=""></div>
										</div>
										<div class="latest_content">
											<div class="latest_title"><a href="course.html">The Secrets of Body
													Language</a></div>
											<div class="latest_price">$220</div>
										</div>
									</div>

								</div>
							</div>

							<!-- Gallery -->
							<div class="sidebar_section">
								<div class="sidebar_section_title">Instagram</div>
								<div class="sidebar_gallery">
									<ul
										class="gallery_items d-flex flex-row align-items-start justify-content-between flex-wrap">
										<li class="gallery_item">
											<div
												class="gallery_item_overlay d-flex flex-column align-items-center justify-content-center">
												+</div>
											<a class="colorbox" href="./etudiant/images/gallery_1_large.jpg">
												<img src="./etudiant/images/gallery_1.jpg" alt="">
											</a>
										</li>
										<li class="gallery_item">
											<div
												class="gallery_item_overlay d-flex flex-column align-items-center justify-content-center">
												+</div>
											<a class="colorbox" href="./etudiant/images/gallery_2_large.jpg">
												<img src="./etudiant/images/gallery_2.jpg" alt="">
											</a>
										</li>
										<li class="gallery_item">
											<div
												class="gallery_item_overlay d-flex flex-column align-items-center justify-content-center">
												+</div>
											<a class="colorbox" href="./etudiant/images/gallery_3_large.jpg">
												<img src="./etudiant/images/gallery_3.jpg" alt="">
											</a>
										</li>
										<li class="gallery_item">
											<div
												class="gallery_item_overlay d-flex flex-column align-items-center justify-content-center">
												+</div>
											<a class="colorbox" href="./etudiant/images/gallery_4_large.jpg">
												<img src="./etudiant/images/gallery_4.jpg" alt="">
											</a>
										</li>
										<li class="gallery_item">
											<div
												class="gallery_item_overlay d-flex flex-column align-items-center justify-content-center">
												+</div>
											<a class="colorbox" href="./etudiant/images/gallery_5_large.jpg">
												<img src="./etudiant/images/gallery_5.jpg" alt="">
											</a>
										</li>
										<li class="gallery_item">
											<div
												class="gallery_item_overlay d-flex flex-column align-items-center justify-content-center">
												+</div>
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
										<?php foreach ($tags as $tag) { ?>
											<li><a href=""><?php echo $tag->getName(); ?></a></li>
										<?php } ?>
									</ul>
								</div>
							</div>

							<!-- Banner -->
							<div class="sidebar_section">
								<div
									class="sidebar_banner d-flex flex-column align-items-center justify-content-center text-center">
									<div class="sidebar_banner_background"
										style="background-image:url(./etudiant/images/banner_1.jpg)"></div>
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
			<div class="newsletter_background parallax-window" data-parallax="scroll"
				data-image-src="./etudiant/images/newsletter.jpg" data-speed="0.8"></div>
			<div class="container">
				<div class="row">
					<div class="col">
						<div
							class="newsletter_container d-flex flex-lg-row flex-column align-items-center justify-content-start">

							<!-- Newsletter Content -->
							<div class="newsletter_content text-lg-left text-center">
								<div class="newsletter_title">sign up for news and offers</div>
								<div class="newsletter_subtitle">Subcribe to lastest smartphones news & great deals we
									offer</div>
							</div>

							<!-- Newsletter Form -->
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
												<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
												</li>
												<li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
												</li>
												<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
												</li>
												<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
												</li>
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
												<li>Phone: +(88) 111 555 666</li>
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
												<li><a href="index.html">Home</a></li>
												<li><a href="about.html">About</a></li>
												<li><a href="contact.html">Contact</a></li>
												<li><a href="#">Features</a></li>
												<li><a href="courses.html">Courses</a></li>
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
						<div class="copyright d-flex flex-lg-row flex-column align-items-center justify-content-start">
							<div class="cr_text">
								<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
								Copyright &copy;
								<script>document.write(new Date().getFullYear());</script> All rights reserved | This
								template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a
									href="https://colorlib.com" target="_blank">Colorlib</a>
								<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
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
	<script src="./etudiant/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
	<script src="./etudiant/plugins/easing/easing.js"></script>
	<script src="./etudiant/plugins/parallax-js-master/parallax.min.js"></script>
	<script src="./etudiant/plugins/colorbox/jquery.colorbox-min.js"></script>
	<script src="./etudiant/js/courses.js"></script>

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