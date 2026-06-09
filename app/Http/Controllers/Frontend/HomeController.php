<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageBoxContent;
use App\Models\InnerBannerPage;
use App\Models\PortfolioGallery;
use Exception;
use App\Models\PageImage;
use App\Models\Slider;
use App\Models\BoothImage;
use App\Models\Gallery;
use App\Models\Contact;
use App\Models\Setting;
use App\Models\MassContentImage;
use App\Models\Content;
use App\Models\MassPortfolioGallery;
class HomeController extends Controller
{
    public function index()
    {
        
        $page = Page::where ('type', 'home')->first();
    
        if (!$page) {
            
            return abort(404);
        }
    
        
        $pageContents = PageBoxContent::where('page_id', $page->id)->pluck('content')->toArray();
        
    
        
        $pageImages = PageImage::where('page_id', $page->id)->with('image')->get();
        $pageBoothImage = BoothImage::where('page_id', $page->id)->with('image')->get();
        $sliders = Slider::where('status', true)->get();

        return view('pages.frontend.index', compact('page', 'pageContents', 'pageImages','sliders','pageBoothImage' ));
    }
    
    



   
    
    
    
    
    
    
    public function ContactTemplateOne()
    {
        $SettingMenu = Setting::where(['type' => 'setting'])->get();
        $contactSetting = Contact::all();
        return view('pages.frontend.contact_us', compact('SettingMenu','contactSetting'));
    }
    

  
 



    public function page($pageSlug)
    {
        $page = Page::where('page_url', $pageSlug)->first();
    
        if ($page && $page->type != 'home') {
            if ($page->content && $page->content->is_completed) {
                if ($page->type == 'mass') {
                     $massImages = MassContentImage::where('page_id', $page->id)->get();
                    if ($page->content->template == 'one') {
                        return view('pages.frontend.mass_template_one', compact('page','massImages'));
                    } elseif ($page->content->template == 'two') {
                        return view('pages.frontend.mass_template_two', compact('page','massImages'));
                    } else {
                        return view('pages.frontend.mass_template_three', compact('page','massImages'));
                    }
                } elseif ($page->type == 'menu') {
                    if ($page->content->template == 'one') {
                        return view('pages.frontend.menu_template_one', compact('page'));
                    } elseif ($page->content->template == 'two') {
                        return view('pages.frontend.menu_template_two', compact('page'));
                    } else {
                        return abort(404);
                    }
                }elseif ($page->type == 'portfolio') {
                    $portfolioImages = PortfolioGallery::where('page_id', $page->content_id) // Assuming content_id and page_id are the same
                    ->orderBy('order_by')
                    ->get();
                    return view('pages.frontend.portfolio_template_one', compact('page','portfolioImages'));
                    
                }
                elseif ($page->type == 'massportfolio')
                {
                    
                    $contentId = Page::where('id', $page->id)->value('content_id');
                    $contentTitle = Content::where('id', $contentId)->value('content_title');
                    $portfolioImages = MassPortfolioGallery::where('page_id', $page->content_id) // Assuming content_id and page_id are the same
                    
                    ->get();
                    return view('pages.frontend.massportfolio_gallery_image', compact('page','portfolioImages','contentTitle'));
                }
                 elseif ($page->content->content_type == 'ReplicateMassContent')
                {
                    //  If content visibility is private → deny access
                    if ($page->content->content_visibility_status === 'private') {
                        abort(404, 'This content is private.');
                    }

                    //  Load template-based views for public content
                    if ($page->content->template == 'one') {
                        return view('pages.frontend.replicate_mass_template_one', compact('page'));
                    }

                    if ($page->content->template == 'two') {
                        return view('pages.frontend.replicate_mass_template_two', compact('page'));
                    }
                }
            } else {
                return view('errors');
            }
        } else {
             return abort(404);
        }
    }
    

    
    


}
