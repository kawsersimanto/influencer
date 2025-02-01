<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Section\Entities\SliderOne;
use Modules\Page\Entities\HomePage;
use Modules\Section\Entities\OurFeature;
use Modules\Section\Entities\WorkingProccess;
use Modules\Section\Entities\Partner;
use Modules\Page\Entities\Faq;
use Modules\Blog\Entities\Blog;
use Modules\Blog\Entities\BlogCategory;
use Modules\Blog\Entities\BlogComment;
use Modules\Page\Entities\AboutUs;
use Modules\Section\Entities\Testimonial;
use Modules\Page\Entities\ContactUs;
use App\Models\ContactMessage;
use Modules\Page\Entities\TermAndCondition;
use Modules\Page\Entities\PrivacyPolicy;
use Modules\Page\Entities\CustomPage;
use Modules\Service\Entities\Service;
use Modules\Service\Entities\AdditionalService;
use Modules\Service\Entities\Category;
use Modules\Section\Entities\WhyChooseUs;
use Modules\Language\Entities\Language;
use App\Models\Review;
use App\Models\SeoSetting;
use App\Models\CustomPagination;
use App\Models\Setting;
use App\Models\EmailConfiguration;
use App\Models\EmailTemplate;
use App\Models\User;
use App\Models\AppointmentSchedule;
use App\Models\Order;
use App\Models\MultiCurrency;

use App\Helpers\MailHelper;
use App\Mail\SendContactMessage;
use App\Models\Platform;
use Str, Mail, Hash, Auth, Session, Config;

use App\Rules\Captcha;

use App\Models\Portfolio;

class HomeController extends Controller
{
  public function index(Request $request)
  {
    $seo_setting = SeoSetting::where('id', 1)->first();
    $slider = SliderOne::first();
    $our_feature = OurFeature::first();
    $working_proccess = WorkingProccess::first();
    $partners = Partner::all();
    $blogs = Blog::with('author')->where('show_homepage', 'yes')->orderBy('id', 'desc')->get();
    $featured_services = Service::with('category', 'influencer', 'platform')->where(['status' => 'active', 'approve_by_admin' => 'enable', 'is_banned' => 'disable'])->orderBy('id', 'desc')->get();
    $categories = Category::where('status', 'active')->get();
    $why_choose_us = WhyChooseUs::first();
    $testimonials = Testimonial::orderBy('id', 'desc')->get();
    $faqs = Faq::orderBy('id', 'desc')->get();
    $influencers = User::where(['status' => 'enable', 'is_banned' => 'no', 'is_influencer' => 'yes'])->where('email_verified_at', '!=', null)->orderBy('id', 'desc')->select('id', 'name', 'username', 'designation', 'total_follower', 'total_following', 'image', 'status', 'is_banned', 'is_influencer')->get()->take(8);
    $platforms = Platform::all();

    return view('new_home')->with([
      'seo_setting' => $seo_setting,
      'slider' => $slider,
      'categories' => $categories,
      'our_feature' => $our_feature,
      'influencers' => $influencers,
      'featured_services' => $featured_services,
      'working_proccess' => $working_proccess,
      'why_choose_us' => $why_choose_us,
      'testimonials' => $testimonials,
      'partners' => $partners,
      'faqs' => $faqs,
      'blogs' => $blogs,
      "platforms" => $platforms
    ]);
  }


  public function about_us()
  {
    $seo_setting = SeoSetting::where('id', 3)->first();

    $our_feature = OurFeature::first();

    $about_us = AboutUs::first();

    $working_proccess = WorkingProccess::first();

    $partners = Partner::all();

    $testimonials = Testimonial::where('status', 'enable')->orderBy('id', 'desc')->get();

    return view('about_us')->with([
      'seo_setting' => $seo_setting,
      'our_feature' => $our_feature,
      'about_us' => $about_us,
      'working_proccess' => $working_proccess,
      'partners' => $partners,
      'testimonials' => $testimonials,
    ]);
  }


  public function contact_us()
  {
    $seo_setting = SeoSetting::where('id', 4)->first();

    $contact_us = ContactUs::first();

    return view('contact_us')->with([
      'seo_setting' => $seo_setting,
      'contact_us' => $contact_us,
    ]);
  }

  public function store_contact_message(Request $request)
  {
    $rules = [
      'name' => 'required',
      'email' => 'required',
      'subject' => 'required',
      'message' => 'required',
      'g-recaptcha-response' => new Captcha()
    ];
    $customMessages = [
      'name.required' => trans('admin_validation.Name is required'),
      'email.required' => trans('admin_validation.Email is required'),
      'subject.required' => trans('admin_validation.Subject is required'),
      'message.required' => trans('admin_validation.Message is required')
    ];
    $this->validate($request, $rules, $customMessages);

    $setting = Setting::first();

    if ($setting->save_contact_message == 'enable') {
      $contact_message = new ContactMessage();
      $contact_message->name = $request->name;
      $contact_message->email = $request->email;
      $contact_message->phone = $request->phone;
      $contact_message->subject = $request->subject;
      $contact_message->message = $request->message;
      $contact_message->save();
    }

    if ($setting->send_contact_message == 'enable') {

      MailHelper::setMailConfig();

      $template = EmailTemplate::find(2);
      $message = $template->description;
      $subject = $template->subject;
      $message = str_replace('{{name}}', $request->name, $message);
      $message = str_replace('{{email}}', $request->email, $message);
      $message = str_replace('{{phone}}', $request->phone, $message);
      $message = str_replace('{{subject}}', $request->subject, $message);
      $message = str_replace('{{message}}', $request->message, $message);

      Mail::to($setting->contact_message_mail)->send(new SendContactMessage($message, $subject, $request->email, $request->name));
    }

    $notification = trans('admin_validation.Your message has send successfully');
    $notification = array('messege' => $notification, 'alert-type' => 'success');
    return redirect()->back()->with($notification);
  }

  public function blogs(Request $request)
  {

    $seo_setting = SeoSetting::where('id', 2)->first();

    $paginate_info = CustomPagination::where('id', 1)->first();

    $blogs = Blog::with('author')->orderBy('id', 'desc')->where('status', 1);

    if ($request->category) {
      $blog_category = BlogCategory::where('slug', $request->category)->first();
      $blogs = $blogs->where('blog_category_id', $blog_category->id);
    }

    if ($request->search) {
      $blogs = $blogs->whereHas('translations', function ($query) use ($request) {
        $query->where('title', 'like', '%' . $request->search . '%')
          ->orWhere('description', 'like', '%' . $request->search . '%');
      })
        ->orWhere(function ($query) use ($request) {
          $query->whereJsonContains('tags', ['value' => $request->search]);
        });
    }

    $blogs = $blogs->paginate($paginate_info->qty);

    $popular_blogs = Blog::where('is_popular', 'yes')->where('status', 1)->orderBy('id', 'desc')->get();

    $categories = BlogCategory::where('status', 1)->get();

    return view('blog')->with([
      'seo_setting' => $seo_setting,
      'blogs' => $blogs,
      'popular_blogs' => $popular_blogs,
      'categories' => $categories,
    ]);
  }

  public function blog_show(Request $request, $slug)
  {
    $blog = Blog::where('status', 1)->where(['slug' => $slug])->first();

    $blog_comments = BlogComment::orderBy('id', 'desc')->where('blog_id', $blog->id)->where('status', 1)->get();

    $popular_blogs = Blog::where('is_popular', 'yes')->where('status', 1)->orderBy('id', 'desc')->get();

    $categories = BlogCategory::where('status', 1)->get();

    return view('blog_show')->with([
      'blog' => $blog,
      'blog_comments' => $blog_comments,
      'popular_blogs' => $popular_blogs,
      'categories' => $categories,
    ]);
  }

  public function store_comment(Request $request)
  {
    $rules = [
      'blog_id' => 'required',
      'name' => 'required',
      'email' => 'required',
      'comment' => 'required',
      'g-recaptcha-response' => new Captcha()
    ];
    $customMessages = [
      'name.required' => trans('admin_validation.Name is required'),
      'email.required' => trans('admin_validation.Email is required'),
      'comment.required' => trans('admin_validation.Comment is required')
    ];
    $this->validate($request, $rules, $customMessages);

    $blog_comment = new BlogComment();
    $blog_comment->blog_id = $request->blog_id;
    $blog_comment->name = $request->name;
    $blog_comment->email = $request->email;
    $blog_comment->comment = $request->comment;
    $blog_comment->save();

    $notification = trans('admin_validation.Blog comment has submited');
    $notification = array('messege' => $notification, 'alert-type' => 'success');
    return redirect()->back()->with($notification);
  }

  public function faq()
  {
    $seo_setting = SeoSetting::where('id', 5)->first();

    $faqs = Faq::get();

    $testimonials = Testimonial::where('status', 'enable')->orderBy('id', 'desc')->get();

    return view('faq')->with([
      'seo_setting' => $seo_setting,
      'faqs' => $faqs,
      'testimonials' => $testimonials,
    ]);
  }

  public function terms_conditions()
  {
    $seo_setting = SeoSetting::where('id', 6)->first();

    return view('terms_conditions')->with([
      'seo_setting' => $seo_setting,
    ]);
  }

  public function privacy_policy()
  {
    $seo_setting = SeoSetting::where('id', 7)->first();

    return view('privacy_policy')->with([
      'seo_setting' => $seo_setting
    ]);
  }

  public function custom_page($slug)
  {

    $custom_page = CustomPage::where('slug', $slug)->first();

    return view('custom_page')->with([
      'custom_page' => $custom_page,
    ]);
  }

  public function services(Request $request)
  {

    $seo_setting = SeoSetting::where('id', 8)->first();

    $paginate_info = CustomPagination::where('id', 2)->first();

    $services = Service::with('category', 'influencer')->where(['status' => 'active', 'approve_by_admin' => 'enable', 'is_banned' => 'disable']);

    if ($request->categories) {
      $filter_category = array();

      foreach ($request->categories as $req_category) {
        $find_cat = Category::where('slug', $req_category)->first();
        if ($find_cat) {
          $filter_category[] = $find_cat->id;
        }
      }

      $services = $services->whereIn('category_id', $filter_category);
    }

    if ($request->min_amount && $request->max_amount) {
      $services = $services->where('price', '>=', $request->min_amount)->where('price', '<=', $request->max_amount);
    }

    if ($request->search) {
      $services = $services->whereHas('translations', function ($query) use ($request) {
        $query->where('title', 'like', '%' . $request->search . '%')
          ->orWhere('description', 'like', '%' . $request->search . '%');
      })
        ->orWhere(function ($query) use ($request) {
          $query->whereJsonContains('tags', ['value' => $request->search]);
        });
    }



    $services = $services->orderBy('id', 'desc')->paginate($paginate_info->qty);

    $categories = Category::where('status', 'active')->get();

    $max_amount = Service::orderBy('price', 'desc')->first();

    $max_amount = $max_amount ? $max_amount->price : 0;
    $req_max_amount = $request->max_amount ? $request->max_amount : $max_amount;
    $req_min_amount =  $request->min_amount ? $request->min_amount : 0;

    return view('service')->with([
      'seo_setting' => $seo_setting,
      'services' => $services,
      'categories' => $categories,
      'max_amount' => $max_amount,
      'req_max_amount' => $req_max_amount,
      'req_min_amount' => $req_min_amount,
    ]);
  }


  public function service_show($slug)
  {
    $service = Service::with('category', 'influencer')->where(['status' => 'active', 'approve_by_admin' => 'enable', 'is_banned' => 'disable', 'slug' => $slug])->first();

    if (!$service) abort(404);

    $related_services = Service::with('category', 'influencer')->where(['status' => 'active', 'approve_by_admin' => 'enable', 'is_banned' => 'disable', 'category_id' => $service->category_id])->where('id', '!=', $service->id)->get()->take(10);

    $service_author = User::where(['status' => 'enable', 'is_banned' => 'no', 'is_influencer' => 'yes'])->where('email_verified_at', '!=', null)->orderBy('id', 'desc')->select('id', 'name', 'username', 'designation', 'total_follower', 'total_following', 'image', 'status', 'is_banned', 'is_influencer')->where('id', $service->influencer_id)->first();

    if (!$service_author) abort(404);

    $days = array(
      'Sunday',
      'Monday',
      'Tuesday',
      'Wednesday',
      'Thursday',
      'Friday',
      'Saturday'
    );

    $schedule_list = array();

    foreach ($days as $day_item) {
      $schedule_item = AppointmentSchedule::where('user_id', $service->influencer_id)->where('day', $day_item)->orderBy('start_time', 'asc')->first();

      if ($schedule_item) {
        $start_time = strtoupper(date('h:i A', strtotime($schedule_item->start_time)));

        $schedule_item = AppointmentSchedule::where('user_id', $service->influencer_id)->where('day', $day_item)->orderBy('end_time', 'desc')->first();
        $end_time = strtoupper(date('h:i A', strtotime($schedule_item->end_time)));

        $schedule = array(
          'day' => $day_item,
          'start_time' => $start_time,
          'end_time' => $end_time
        );

        $schedule_list[] = $schedule;
      }
    }

    $reviews = Review::with('user')->orderBy('id', 'desc')->where('status', 1)->where('service_id', $service->id)->paginate(10);

    return view('service_show')->with([
      'service' => $service,
      'service_author' => $service_author,
      'schedule_list' => $schedule_list,
      'related_services' => $related_services,
      'reviews' => $reviews,

    ]);
  }

  public function influencers()
  {

    $seo_setting = SeoSetting::where('id', 9)->first();

    $paginate_info = CustomPagination::where('id', 3)->first();

    $influencers = User::where(['status' => 'enable', 'is_banned' => 'no', 'is_influencer' => 'yes'])->where('email_verified_at', '!=', null)->orderBy('id', 'desc')->select('id', 'name', 'username', 'designation', 'total_follower', 'total_following', 'image', 'status', 'is_banned', 'is_influencer')->paginate($paginate_info->qty);

    return view('influencers')->with([
      'seo_setting' => $seo_setting,
      'influencers' => $influencers,

    ]);
  }


  public function influencer(Request $request, $username)
  {

    $portfolios = Portfolio::orderBy('id', 'desc')->where('status', 1)->get();

    $influencer = User::where(['status' => 'enable', 'is_banned' => 'no', 'is_influencer' => 'yes'])->where('email_verified_at', '!=', null)->orderBy('id', 'desc')->select('id', 'name', 'username', 'designation', 'total_follower', 'total_following', 'image', 'status', 'is_banned', 'is_influencer', 'tags', 'created_at', 'about_me', 'varsity_name', 'varsity_year', 'school_name', 'school_year', 'phone', 'email', 'address', 'facebook', 'tiktok', 'twitter', 'instagram')->where('username', $username)->first();

    if (!$influencer) abort(404);

    $services = Service::with('category', 'influencer')->where(['status' => 'active', 'approve_by_admin' => 'enable', 'is_banned' => 'disable'])->where('influencer_id', $influencer->id)->orderBy('id', 'desc')->get();

    $total_review = Review::where('status', 1)->where('influencer_id', $influencer->id)->count();

    $total_pending = Order::where('order_status', 'awaiting_for_influencer_approval')->where('influencer_id', $influencer->id)->count();

    $active_booking = Order::where('order_status', 'approved_by_influencer')->where('influencer_id', $influencer->id)->count();

    $complete_booking = Order::where('order_status', 'complete')->where('influencer_id', $influencer->id)->count();

    $cancel_booking = Order::where('influencer_id', $influencer->id)->where('order_status', 'order_decliened_by_influencer')->orWhere('order_status', 'order_decliened_by_client')->count();

    return view('influencer')->with([
      'influencer' => $influencer,
      'services' => $services,
      'total_review' => $total_review,
      'active_booking' => $active_booking,
      'total_pending' => $total_pending,
      'cancel_booking' => $cancel_booking,
      'complete_booking' => $complete_booking,
      'portfolios' => $portfolios,

    ]);
  }

  public function download_file($file)
  {
    $filepath = public_path() . "/uploads/custom-images/" . $file;
    return response()->download($filepath);
  }

}
