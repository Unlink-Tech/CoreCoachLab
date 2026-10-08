<?php

namespace App\Http\Controllers;
use App;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use App\Models\PostTag;
use App\Models\PostCategory;
use App\Models\Post;
use App\Models\Cart;
use App\Models\Brand;
use App\Models\Pages;
use App\User;
use Auth;
use Session;
use Newsletter;
use DB;
use Hash;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterMail;
use App\Mail\RegisterCodeMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use App\Services\PhoneNumber;
use App\Services\SmsSender;
use App\Services\VerificationCode;
class FrontendController extends Controller
{
   
    public function index(Request $request){
        return redirect()->route($request->user()->role);
    }

    public function home(){
        $featured=Product::where('status','active')->where('is_featured',1)->orderBy('price','DESC')->limit(3)->get();
        $posts=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        $banners=Banner::where('status','active')->limit(3)->orderBy('id','DESC')->get();
        // return $banner;
        $products=Product::where('status','active')->orderBy('id','DESC')->get();
        $category=Category::where('status','active')->where('is_parent',1)->orderBy('title','ASC')
        ->withCount('products')->get();
        // return $category;
        return view('frontend.index')
                ->with('featured',$featured)
                ->with('posts',$posts)
                ->with('banners',$banners)
                ->with('product_lists',$products)
                ->with('category_lists',$category);
    }   

    public function aboutUs(){
        return view('frontend.pages.about-us');
    }

    public function contact(){
        return view('frontend.pages.contact');
    }

    public function productDetail($slug){
        $product_detail= Product::getProductBySlug($slug);
        $categories = Category::all();
          //return $product_detail;
        return view('frontend.pages.product_detail')
        ->with('product_detail',$product_detail)
        ->with('categories',$categories);
    }

    public function productGrids(){
        $products=Product::query();
        
        if(!empty($_GET['category'])){
            $slug=explode(',',$_GET['category']);
            // dd($slug);
            $cat_ids=Category::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
            // dd($cat_ids);
            $products->whereIn('cat_id',$cat_ids);
            // return $products;
        }
        if(!empty($_GET['brand'])){
            $slugs=explode(',',$_GET['brand']);
            $brand_ids=Brand::select('id')->whereIn('slug',$slugs)->pluck('id')->toArray();
            return $brand_ids;
            $products->whereIn('brand_id',$brand_ids);
        }
        if(!empty($_GET['sortBy'])){
            if($_GET['sortBy']=='title'){
                $products=$products->where('status','active')->orderBy('title','ASC');
            }
            if($_GET['sortBy']=='price'){
                $products=$products->orderBy('price','ASC');
            }
        }

        if(!empty($_GET['price'])){
            $price=explode('-',$_GET['price']);
            // return $price;
            // if(isset($price[0]) && is_numeric($price[0])) $price[0]=floor(Helper::base_amount($price[0]));
            // if(isset($price[1]) && is_numeric($price[1])) $price[1]=ceil(Helper::base_amount($price[1]));
            
            $products->whereBetween('price',$price);
        }

        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        // Sort by number
        if(!empty($_GET['show'])){
            $products=$products->where('status','active')->paginate($_GET['show']);
        }
        else{
            $products=$products->where('status','active')->paginate(9);
        }
        // Sort by name , price, category

      
        return view('frontend.pages.product-grids')->with('products',$products)->with('recent_products',$recent_products);
    }
    public function productLists($slug = null) {
        //$products = Product::query();

        $currentLocale = App::getLocale();

        $currency = session('currency', 'USD');

        if($currentLocale == "ja") {
            if($currency == "USD") {
                $products = Product::select(
                    'id',
                    'title_jp as title',
                    'summary_jp as summary',
                    'description_jp as description',
                    'slug',
                    'photo',
                    'stock',
                    'size',
                    'condition',
                    'status',
                    'price',
                    'price_jp',
                    'price_hk',
                    'discount',
                    'is_featured',
                    'extra_description_jp as extra_description',
                    'cat_id',
                    'child_cat_id',
                    'brand_id',
                    'created_at',
                    'updated_at'
                    );
            }
            else if($currency == "HKD") {
                $products = Product::select(
                    'id',
                    'title_jp as title',
                    'summary_jp as summary',
                    'description_jp as description',
                    'slug',
                    'photo',
                    'stock',
                    'size',
                    'condition',
                    'status',
                    'price_jp',
                    'price_hk as price',
                    'discount',
                    'is_featured',
                    'extra_description_jp as extra_description',
                    'cat_id',
                    'child_cat_id',
                    'brand_id',
                    'created_at',
                    'updated_at'
                    );
            }
            else {
                $products = Product::select(
                    'id',
                    'title_jp as title',
                    'summary_jp as summary',
                    'description_jp as description',
                    'slug',
                    'photo',
                    'stock',
                    'size',
                    'condition',
                    'status',
                    'price_jp as price',
                    'price_hk',
                    'discount',
                    'is_featured',
                    'extra_description_jp as extra_description',
                    'cat_id',
                    'child_cat_id',
                    'brand_id',
                    'created_at',
                    'updated_at'
                    );
            }
        }
        else {
            //return Product::with(['cat_info','rel_prods','getReview'])->where('slug',$slug)->first();

            if($currency == "USD") {
                $products = Product::select(
                    'id',
                    'title',
                    'summary',
                    'description',
                    'slug',
                    'photo',
                    'stock',
                    'size',
                    'condition',
                    'status',
                    'price',
                    'price_jp',
                    'price_hk',
                    'discount',
                    'is_featured',
                    'extra_description',
                    'cat_id',
                    'child_cat_id',
                    'brand_id',
                    'created_at',
                    'updated_at'
                    );
            }
            else if($currency == "HKD") {
                $products = Product::select(
                    'id',
                    'title',
                    'summary',
                    'description_jp as description',
                    'slug',
                    'photo',
                    'stock',
                    'size',
                    'condition',
                    'status',
                    'price_jp',
                    'price_hk as price',
                    'discount',
                    'is_featured',
                    'extra_description',
                    'cat_id',
                    'child_cat_id',
                    'brand_id',
                    'created_at',
                    'updated_at'
                    );
            }
            else {
                $products = Product::select(
                    'id',
                    'title',
                    'summary',
                    'description',
                    'slug',
                    'photo',
                    'stock',
                    'size',
                    'condition',
                    'status',
                    'price_jp as price',
                    'price_hk',
                    'discount',
                    'is_featured',
                    'extra_description',
                    'cat_id',
                    'child_cat_id',
                    'brand_id',
                    'created_at',
                    'updated_at'
                    );
            }
        }
        
        $category = null;

        // Handle category slug from URL parameter
        if(!empty($slug)){
            $cat_ids = Category::select('id')->where('slug', $slug)->pluck('id')->toArray();
            if(!empty($cat_ids)){
                $products = $products->whereIn('cat_id', $cat_ids);
                // Get category details for header
                $category = Category::where('slug', $slug)->first();
            }
        }
        // Handle category from query parameter (for backward compatibility)
        elseif(!empty($_GET['category'])){
            $slugArray = explode(',',$_GET['category']);
            // dd($slugArray);
            $cat_ids = Category::select('id')->whereIn('slug', $slugArray)->pluck('id')->toArray();
            // dd($cat_ids);
            if(!empty($cat_ids)){
                $products = $products->whereIn('cat_id', $cat_ids);
                // Get category details for header
                $category = Category::whereIn('slug', $slugArray)->first();
            }
        }
        if(!empty($_GET['brand'])){
            $slugs=explode(',',$_GET['brand']);
            $brand_ids=Brand::select('id')->whereIn('slug',$slugs)->pluck('id')->toArray();
            return $brand_ids;
            $products->whereIn('brand_id',$brand_ids);
        }
        if(!empty($_GET['sortBy'])){
            if($_GET['sortBy']=='title'){
                $products=$products->where('status','active')->orderBy('title','ASC');
            }
            if($_GET['sortBy']=='price'){
                $products=$products->orderBy('price','ASC');
            }
        }

        if(!empty($_GET['price'])){
            $price=explode('-',$_GET['price']);
            // return $price;
            // if(isset($price[0]) && is_numeric($price[0])) $price[0]=floor(Helper::base_amount($price[0]));
            // if(isset($price[1]) && is_numeric($price[1])) $price[1]=ceil(Helper::base_amount($price[1]));
            
            $products->whereBetween('price',$price);
        }

        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        // Sort by number
        if(!empty($_GET['show'])){
            $products=$products->where('status','active')->with(['levels' => function($query) {
                if (App::getLocale() == 'ja') {
                    $query->select('id', 'course_id', 'skill_level_jp as skill_level', 'purpose_jp as purpose', 'learn_info_jp as learn_info', 'outcome_jp as outcome', 'price', 'price_jp', 'price_hk', 'price_in_points');
                } else {
                    $query->select('id', 'course_id', 'skill_level', 'purpose', 'learn_info', 'outcome', 'price', 'price_jp', 'price_hk', 'price_in_points');
                }
            }])->paginate($_GET['show']);
        }
        else{
            $products=$products->where('status','active')->with(['levels' => function($query) {
                if (App::getLocale() == 'ja') {
                    $query->select('id', 'course_id', 'skill_level_jp as skill_level', 'purpose_jp as purpose', 'learn_info_jp as learn_info', 'outcome_jp as outcome', 'price', 'price_jp', 'price_hk', 'price_in_points');
                } else {
                    $query->select('id', 'course_id', 'skill_level', 'purpose', 'learn_info', 'outcome', 'price', 'price_jp', 'price_hk', 'price_in_points');
                }
            }])->paginate(50);
        }
        // Sort by name , price, category

// return $products;
// $category = Category::where('slug', $request->slug)->first();       
$sub_cat = Category::whereNotNull('parent_id')->get();
            // return $sub_cat;
            // $catphoto=$category->photo;

        return view('frontend.pages.product-lists')
        ->with('products',$products)
        ->with('sub_cat',$sub_cat)
        ->with('recent_products',$recent_products)
        ->with('category',$category);
    }
    public function productFilter(Request $request){
            $data= $request->all();
            // return $data;
            $showURL="";
            if(!empty($data['show'])){
                $showURL .='&show='.$data['show'];
            }

            $sortByURL='';
            if(!empty($data['sortBy'])){
                $sortByURL .='&sortBy='.$data['sortBy'];
            }

            $catURL="";
            if(!empty($data['category'])){
                foreach($data['category'] as $category){
                    if(empty($catURL)){
                        $catURL .='&category='.$category;
                    }
                    else{
                        $catURL .=','.$category;
                    }
                }
            }

            $brandURL="";
            if(!empty($data['brand'])){
                foreach($data['brand'] as $brand){
                    if(empty($brandURL)){
                        $brandURL .='&brand='.$brand;
                    }
                    else{
                        $brandURL .=','.$brand;
                    }
                }
            }
            // return $brandURL;

            $priceRangeURL="";
            if(!empty($data['price_range'])){
                $priceRangeURL .='&price='.$data['price_range'];
            }
            if(request()->is('e-shop.loc/product-grids')){
                return redirect()->route('product-grids',$catURL.$brandURL.$priceRangeURL.$showURL.$sortByURL);
            }
            else{
                return redirect()->route('product-lists',$catURL.$brandURL.$priceRangeURL.$showURL.$sortByURL);
            }
    }
    public function productSearch(Request $request){
        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        $products=Product::orwhere('title','like','%'.$request->search.'%')
                    ->orwhere('slug','like','%'.$request->search.'%')
                    ->orwhere('description','like','%'.$request->search.'%')
                    ->orwhere('summary','like','%'.$request->search.'%')
                    ->orwhere('price','like','%'.$request->search.'%')
                    ->orderBy('id','DESC')
                    ->paginate('9');
        return view('frontend.pages.product-grids')->with('products',$products)->with('recent_products',$recent_products);
    }

    public function productBrand(Request $request){
        $products=Brand::getProductByBrand($request->slug);
        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        if(request()->is('e-shop.loc/product-grids')){
            return view('frontend.pages.product-grids')->with('products',$products->products)->with('recent_products',$recent_products);
        }
        else{
            return view('frontend.pages.product-lists')->with('products',$products->products)->with('recent_products',$recent_products);
        }

    }
    public function productCat(Request $request) {

       if(session('app_locale') == 'ja')
        {            
            $category = Category::select(
                    'id',
                    'photo',
                    'title_jp as title',
                    'summary_jp as summary')->where('slug', $request->slug)->first();
        }
        else {
           $category = Category::where('slug', $request->slug)->first();
        }
      
        //$productData = Product::where('cat_id', $categoryID->id)->orderBy('id', 'DESC')->get();

        $products = Category::getProductByCat($request->slug);
        // return $products;
        $i = 0;
        foreach($products->products as $product) {
            $currency = session("currency", "USD");
            //print "<br>".$product["title"]."_".$product["price"]."_".$product["price_jp"];

            /*if($currency == "JPY") {
                $products->products[$i]["price"] = $products->products[$i]["price_jp"];
            }
            else if($currency == "HKD") {
                $products->products[$i]["price"] = $products->products[$i]["price_hk"];
            }*/
            $i = $i + 1;
        }

        // return $request->slug;
        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();

        if(request()->is('e-shop.loc/product-grids')) {
            //return view('frontend.pages.product-grids')->with('products',$products->products)->with('recent_products',$recent_products);
        }
        else{
            // return $products;

            $sub_cat = Category::whereNotNull('parent_id')->get();
            // return $sub_cat;
            $catphoto=$category->photo;
// return $catphoto;
            return view('frontend.pages.product-lists')
            ->with('products',$products->products)->with('catphoto',$catphoto)
            ->with('category',$category)->with('sub_cat',$sub_cat)
            ->with('recent_products',$recent_products);

        }

    }
    public function productSubCat(Request $request){
        $products=Category::getProductBySubCat($request->sub_slug);
        // return $products;
        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();

        if(request()->is('e-shop.loc/product-grids')){
            return view('frontend.pages.product-grids')->with('products',$products->sub_products)->with('recent_products',$recent_products);
        }
        else{
            return view('frontend.pages.product-lists')->with('products',$products->sub_products)->with('recent_products',$recent_products);
        }

    }

    public function blog(){
        $post=Post::query();
        
        if(!empty($_GET['category'])){
            $slug=explode(',',$_GET['category']);
            // dd($slug);
            $cat_ids=PostCategory::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
            return $cat_ids;
            $post->whereIn('post_cat_id',$cat_ids);
            // return $post;
        }
        if(!empty($_GET['tag'])){
            $slug=explode(',',$_GET['tag']);
            // dd($slug);
            $tag_ids=PostTag::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
            // return $tag_ids;
            $post->where('post_tag_id',$tag_ids);
            // return $post;
        }

        if(!empty($_GET['show'])){
            $post=$post->where('status','active')->orderBy('id','DESC')->paginate($_GET['show']);
        }
        else{
            $post=$post->where('status','active')->orderBy('id','DESC')->paginate(9);
        }
        // $post=Post::where('status','active')->paginate(8);
        $rcnt_post=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        return view('frontend.pages.blog')->with('posts',$post)->with('recent_posts',$rcnt_post);
    }

    public function blogDetail($slug){
        $post=Post::getPostBySlug($slug);
        $rcnt_post=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        // return $post;
        return view('frontend.pages.blog-detail')->with('post',$post)->with('recent_posts',$rcnt_post);
    }

    public function blogSearch(Request $request){
        // return $request->all();
        $rcnt_post=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        $posts=Post::orwhere('title','like','%'.$request->search.'%')
            ->orwhere('quote','like','%'.$request->search.'%')
            ->orwhere('summary','like','%'.$request->search.'%')
            ->orwhere('description','like','%'.$request->search.'%')
            ->orwhere('slug','like','%'.$request->search.'%')
            ->orderBy('id','DESC')
            ->paginate(8);
        return view('frontend.pages.blog')->with('posts',$posts)->with('recent_posts',$rcnt_post);
    }

    public function blogFilter(Request $request){
        $data=$request->all();
        // return $data;
        $catURL="";
        if(!empty($data['category'])){
            foreach($data['category'] as $category){
                if(empty($catURL)){
                    $catURL .='&category='.$category;
                }
                else{
                    $catURL .=','.$category;
                }
            }
        }

        $tagURL="";
        if(!empty($data['tag'])){
            foreach($data['tag'] as $tag){
                if(empty($tagURL)){
                    $tagURL .='&tag='.$tag;
                }
                else{
                    $tagURL .=','.$tag;
                }
            }
        }
        // return $tagURL;
            // return $catURL;
        return redirect()->route('blog',$catURL.$tagURL);
    }

    public function blogByCategory(Request $request){
        $post=PostCategory::getBlogByCategory($request->slug);
        $rcnt_post=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        return view('frontend.pages.blog')->with('posts',$post->post)->with('recent_posts',$rcnt_post);
    }

    public function blogByTag(Request $request){
        // dd($request->slug);
        $post=Post::getBlogByTag($request->slug);
        // return $post;
        $rcnt_post=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        return view('frontend.pages.blog')->with('posts',$post)->with('recent_posts',$rcnt_post);
    }

    // Login
    public function login(){
        return view('frontend.pages.login');
    }
    public function loginSubmit(Request $request){
        //    return $request;
        $data = $request->all();

        // The login form offers email or phone (with country code). Phone logins are matched on
        // users.phone (see PhoneNumber::findUser) and then authenticated by user id, so accounts
        // registered with a phone number and no email can log in too.
        $credentials = null;
        if (($data['login_method'] ?? 'email') === 'phone') {
            $user = PhoneNumber::findUser($data['phone_code'] ?? '', $data['phone'] ?? '');
            if ($user) {
                $credentials = ['id' => $user->id];
            }
        } elseif (!empty($data['email'])) {
            $credentials = ['email' => $data['email']];
        }

        if($credentials && Auth::attempt($credentials + ['password' => $data['password'] ?? '','status'=>'active'])){
            Session::put('user', Auth::user()->email ?: Auth::user()->phone);
            
            if(session('guest'))
            {
            $guest = session('guest'); 
            
            $already_cart = Cart::where('user_id', $guest)->where('order_id',null)->get();
           
            if($already_cart)
            {                  
                   Cart::where('user_id', $guest)->update(['user_id' =>  auth()->user()->id]);
                   session()->forget('guest');
                   request()->session()->flash('success',__('common.login_success'));
            return redirect()->route('checkout');
            }
            }

            request()->session()->flash('success',__('common.login_success'));
            return redirect()->route('home');
        }
        else{
            request()->session()->flash('loginerror',__('common.invalid_email_password'));
            return redirect()->back()->withInput($request->only('login_method', 'email', 'phone', 'phone_code'));
        }
    }


    public function logout(){
        Session::forget('user');
        Auth::logout();
        request()->session()->flash('success',__('common.logout_success'));
        return redirect()->route('home');
    }

    public function register(){
        return view('frontend.pages.register');
    }
    /** Verification codes for the registration form (emailed on the Email tab, SMS on the Phone tab). */
    private const REGISTER_CODE_TTL_MINUTES = 10;
    private const REGISTER_SMS_TTL_MINUTES = 5;

    /**
     * Rate limit for "Request Code" / "Send SMS Code": one request per 60s per session (matches the
     * form's countdown) and 6 per hour per IP. Returns the seconds to wait, or 0 when allowed.
     */
    private function codeRequestWait(Request $request, string $kind): int
    {
        $sessionKey = $kind . ':' . $request->session()->getId();
        $ipKey = $kind . '-ip:' . $request->ip();
        if (RateLimiter::tooManyAttempts($sessionKey, 1) || RateLimiter::tooManyAttempts($ipKey, 6)) {
            return max(RateLimiter::availableIn($sessionKey), RateLimiter::tooManyAttempts($ipKey, 6) ? RateLimiter::availableIn($ipKey) : 0);
        }
        RateLimiter::hit($sessionKey, 60);
        RateLimiter::hit($ipKey, 3600);
        return 0;
    }

    /** "Request Code" on the Email tab: email a 6-digit code to the address. */
    public function sendRegisterCode(Request $request){
        $validator = \Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users,email',
        ], [
            'email.unique' => 'An account with this email already exists',
        ]);
        if ($validator->fails()) {
            return response()->json(['ok' => false, 'field' => 'email', 'message' => $validator->errors()->first('email')], 422);
        }

        $email = strtolower(trim($request->input('email')));
        if ($wait = $this->codeRequestWait($request, 'register-code')) {
            return response()->json(['ok' => false, 'field' => 'verificationCode', 'message' => 'Please wait ' . $wait . 's before requesting another code'], 429);
        }

        $code = VerificationCode::issue($request, 'register_code', $email, self::REGISTER_CODE_TTL_MINUTES);
        try {
            // config/mail.php leaves the SMTP timeout unset (60s socket default), which outlasts PHP's
            // 30s limit when the mail server is unreachable; cap it so failures surface as a message.
            config(['mail.mailers.smtp.timeout' => 10]);
            app('mail.manager')->purge('smtp');
            Mail::to($email)->send(new RegisterCodeMail($code, self::REGISTER_CODE_TTL_MINUTES));
        } catch (\Throwable $e) {
            Log::error('Registration code email failed: ' . $e->getMessage());
            if (!app()->environment('local')) {
                VerificationCode::forget($request, 'register_code');
                return response()->json(['ok' => false, 'field' => 'verificationCode', 'message' => 'We could not send the code right now. Please try again shortly.'], 503);
            }
        }
        if (app()->environment('local')) {
            // Development convenience only: lets the flow be tested without a running mail server.
            Log::info('Registration verification code for ' . $email . ': ' . $code);
        }

        return response()->json(['ok' => true]);
    }

    /** "Send SMS Code" on the Phone Number tab: text a 6-digit code to the number. */
    public function sendRegisterSmsCode(Request $request, SmsSender $sms){
        $phone = PhoneNumber::normalize($request->input('phone_code'), $request->input('phone'));
        if (!$phone || !preg_match('/^\+\d{7,15}$/', $phone)) {
            return response()->json(['ok' => false, 'field' => 'phone', 'message' => 'Please enter a valid phone number'], 422);
        }
        if (PhoneNumber::findUser($request->input('phone_code'), $request->input('phone'), false)) {
            return response()->json(['ok' => false, 'field' => 'phone', 'message' => 'An account with this phone number already exists'], 422);
        }
        if (!$sms->available()) {
            return response()->json(['ok' => false, 'field' => 'verificationCode', 'message' => 'Sign-up by phone is not available yet. Please use the Email tab.'], 503);
        }
        if ($wait = $this->codeRequestWait($request, 'register-sms')) {
            return response()->json(['ok' => false, 'field' => 'verificationCode', 'message' => 'Please wait ' . $wait . 's before requesting another code'], 429);
        }

        $code = VerificationCode::issue($request, 'register_sms_code', $phone, self::REGISTER_SMS_TTL_MINUTES);
        if (!$sms->send($phone, 'Your Venture Asia verification code is ' . $code . '. It expires in ' . self::REGISTER_SMS_TTL_MINUTES . ' minutes.')) {
            VerificationCode::forget($request, 'register_sms_code');
            return response()->json(['ok' => false, 'field' => 'verificationCode', 'message' => 'We could not send the code right now. Please try again shortly.'], 503);
        }

        return response()->json(['ok' => true]);
    }

    public function registerSubmit(Request $request){
        // Fields follow the "Open Live Account" form: Email or Phone Number tab, each verified by a code.
        $byPhone = $request->input('register_method') === 'phone';
        $verifyCode = (bool) config('services.register_verify_code');
        $phone = $byPhone ? PhoneNumber::normalize($request->input('phone_code'), $request->input('phone')) : null;
        $rules = [
            'register_method' => 'required|in:email,phone',
            'country' => 'required|string|max:100',
            'first_name' => 'required|string|max:100',
            'password' => ['required', 'string', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=\[\]{};\':"\\\\|,.<>\/?]).{8,15}$/'],
            'not_us_resident' => 'accepted',
            'agree_terms' => 'accepted',
            'account_type' => 'nullable|in:individual,corporate',
            'referred_by' => 'nullable|string|max:50',
        ];
        if ($verifyCode) {
            $rules['verification_code'] = 'required|digits_between:4,8';
        }
        if ($byPhone) {
            $rules['phone_code'] = ['required', 'regex:/^\+\d{1,4}$/'];
            $rules['phone'] = ['required', 'string', 'max:20'];
        } else {
            $rules['email'] = 'required|string|email|max:255|unique:users,email';
        }
        // The redesigned form has no captcha (code verification replaces it); set CAPTCHA_ENABLED=true only if one is added back.
        if (env('CAPTCHA_ENABLED', false)) {
            $rules['captcha'] = 'required|captcha';
        }
        $validator = \Validator::make($request->all(), $rules, [
            'first_name.required' => 'First name is required',
            'country.required' => 'Please select your country',
            'email.unique' => 'An account with this email already exists',
            'verification_code.required' => $byPhone ? 'Please enter the SMS verification code' : 'Please enter a valid email verification code',
            'verification_code.digits_between' => 'Verification code must be numeric (4-8 digits)',
            'password.regex' => 'Password must be 8-15 characters, including uppercase letters, lowercase letters, numbers, and special characters.',
            'not_us_resident.accepted' => 'Please tick the checkbox to proceed',
            'agree_terms.accepted' => 'You must agree to the terms of the registration agreement to proceed',
        ]);

        $validator->after(function ($v) use ($request, $byPhone, $phone, $verifyCode) {
            if ($byPhone) {
                if ($v->errors()->has('phone') || $v->errors()->has('phone_code')) {
                    return;
                }
                if (!$phone || !preg_match('/^\+\d{7,15}$/', $phone)) {
                    $v->errors()->add('phone', 'Please enter a valid phone number');
                    return;
                }
                if (PhoneNumber::findUser($request->input('phone_code'), $request->input('phone'), false)) {
                    $v->errors()->add('phone', 'An account with this phone number already exists');
                    return;
                }
            } elseif ($v->errors()->has('email')) {
                return;
            }
            if (!$verifyCode || $v->errors()->has('verification_code')) {
                return;
            }
            // Check the code sent to the same email / phone (not expired, limited attempts).
            $error = $byPhone
                ? VerificationCode::check($request, 'register_sms_code', $phone, (string) $request->input('verification_code'))
                : VerificationCode::check($request, 'register_code', strtolower(trim($request->input('email'))), (string) $request->input('verification_code'));
            if ($error) {
                $v->errors()->add('verification_code', $error);
            }
        });

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->except('password', 'verification_code'));
        }

        $data = $request->all();
        $data['phone'] = $phone;
        if ($byPhone) {
            $data['email'] = null;
        }
        $usercount = User::where('created_at', '>=', Carbon::now()->subHours(24))->count();
        $user_limit = DB::table('miscs')->where('name', 'User_Limit')->value('value') ?? 2;
        if($usercount>=$user_limit) {
           request()->session()->flash('error',__('common.try_again_later'));
            return back()->withInput($request->except('password', 'verification_code'));
        }
        $check=$this->create($data);
        Session::put('user', $data['email'] ?: $phone);
        if($check){
            VerificationCode::forget($request, $byPhone ? 'register_sms_code' : 'register_code');
            // Mail::to($data['email'])->send(new RegisterMail($data));
            request()->session()->flash('success',__('common.register_success'));
            return redirect()->route('login.form');
        }
        else{
            request()->session()->flash('error',__('common.try_again'));
            return back();
        }
    }
    public function create(array $data){
        return User::create([
            'name'=>trim($data['first_name'] ?? '') ?: Str::before((string) $data['email'], '@'),
            'email'=>$data['email'] ?? null,
            'phone'=>$data['phone'] ?? null,
            'password'=>Hash::make($data['password']),
            'status'=>'active',
            'country'=>$data['country'] ?? null,
            ]);
    }
    // Reset password
    public function showResetForm(){
        return view('auth.passwords.old-reset');
    }

    public function subscribe(Request $request){
        if(! Newsletter::isSubscribed($request->email)){
                Newsletter::subscribePending($request->email);
                if(Newsletter::lastActionSucceeded()){
                    request()->session()->flash('success',__('common.subscribed_check_email'));
                    return redirect()->route('home');
                }
                else{
                    Newsletter::getLastError();
                    return back()->with('error',__('common.something_went_wrong'));
                }
            }
            else{
                request()->session()->flash('error',__('common.already_subscribed'));
                return back();
            }
    }

    public function getPage(Request $request)
    {
        $pageData = Pages::getPageBySlug($request->slug);
 
        if (!$pageData) {
            abort(404);
        }
 
        return view('frontend.pages.page')->with('page_data', $pageData);
    }

    
}
