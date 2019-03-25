<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "logincontroller";
$route['user-login'] = "logincontroller";
$route['user-validation'] = "receivedatacontroller/receivedata";
$route['user-registration'] = "logincontroller/user_registration";
$route['public-articles/(:num)'] = "logincontroller/publicarticle/$1";
$route['public-articles'] = "logincontroller/publicarticle";
$route['download-article/(:num)'] = "logincontroller/download/$1";
$route['get-single-article/(:num)'] = "logincontroller/get_single_data/$1";
$route['user-registration-submit'] = "logincontroller/receive_data";
$route['user-dashboard'] = "welcomecontroller/welcome";
$route['user-dashboard/(:num)'] = "welcomecontroller/welcome/$1";
$route['logout'] = "logincontroller/logout";
$route['add-articles'] = "welcomecontroller/addarticles";
$route['your-story'] = "welcomecontroller/your_story";
$route['story-submit'] = "welcomecontroller/story_submit";
$route['change-password'] = "welcomecontroller/change_password";
$route['download-photo/(:num)'] = "welcomecontroller/download_photo/$1";
$route['edit-article/(:num)'] = "welcomecontroller/edit_articles/$1";
$route['delete-article/(:num)'] = "welcomecontroller/delete_articles/$1";
$route['change-password-submit'] = "welcomecontroller/change_pwd_submit";
$route['add-article-submit'] = "welcomecontroller/receiveaddarticles";
$route['print-pdf/(:num)'] = "welcomecontroller/print_pdf/$1";
$route['article-list-for-ratings'] = "ratingcontroller/article_list_for_ratings";
$route['article-photo-rating/(:num)'] = "ratingcontroller/article_photo_rating/$1";
$route['article-rating-submit'] = "ratingcontroller/article_rating_submit";
$route['article-rating-details/(:num)'] = "ratingcontroller/article_rating_details/$1";
$route['forget-password'] = "logincontroller/forget_password";
$route['forget-password-submit'] = "logincontroller/forget_password_submit";
$route['email-check-for-forget-password'] = "logincontroller/email_check_for_forget_password";
$route['check-security-question'] = "logincontroller/check_security_question";
$route['check-answer'] = "logincontroller/check_answer";
$route['password-recovery-submit'] = "logincontroller/password_recovery_submit";
$route['change-profile-picture'] = "profile/change_profile_picture";
$route['profile-picture-submit'] = "profile/profile_picture_submit";
$route['user-registration-details'] = "user_details/user_registration_details";
$route['user-registration-details/(:num)'] = "user_details/user_registration_details/$1";
$route['user-registration-chart'] = "user_details/user_registration_chart";
$route['user-article-chart'] = "user_details/user_article_chart";
$route['article-average-rating-chart'] = "user_details/article_average_rating_chart";
$route['view-user-details/(:num)'] = "user_details/view_user_details/$1";
$route['edit-user-details/(:num)'] = "user_details/edit_user_details/$1";
$route['user-details-submit/(:num)'] = "user_details/user_details_submit/$1";
$route['change-user-profile/(:num)'] = "user_details/change_user_profile/$1";
$route['change-user-profile-submit/(:num)'] = "user_details/change_user_profile_submit/$1";
$route['delete-user-details/(:num)'] = "user_details/delete_user_details/$1";
$route['view-user-articles/(:num)'] = "user_details/view_user_articles/$1";
$route['view-user-articles/(:num)/(:num)'] = "user_details/view_user_articles/$1/$2";
$route['edit-user-article/(:num)'] = "user_details/edit_user_article/$1";
$route['edit-article-submit/(:num)'] = "user_details/edit_article_submit/$1";
$route['delete-user-article/(:num)'] = "user_details/delete_user_article/$1";
$route['user-article-list'] = "user_details/user_article_list";
$route['user-article-list/(:num)'] = "user_details/user_article_list/$1";
$route['change-user-status'] = "user_details/change_user_status";
$route['view-article-gallery/(:num)'] = "user_details/view_article_gallery/$1";
$route['user-overview'] = "user_details/user_overview";
$route['all-user-story'] = "user_details/all_user_story";

$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */