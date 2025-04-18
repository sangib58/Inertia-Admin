<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Faq;
use App\Models\LogHistory;
use App\Models\Settings;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

class SettingsController extends Controller
{
    public function GetLanding(): Response
    {   
        return Inertia::render('index');
    }
    public function GetSettings(): Response
    {
        return Inertia::render('settings',[
            'settings'=>Settings::first()
        ]);
    }

    public function UpdateGeneralSettings(): RedirectResponse
    {
        $validated = request()->validate([
            'siteSettingsId' => 'required|integer',
            'siteTitle' => 'required|string|max:255',
            'welComeMessage' => 'required|string|max:500',
            'copyRightText' => 'required|string|max:500',
            'version' => 'required|integer',
            'logoImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'faviconImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $settings = Settings::find($validated['siteSettingsId']);
        if ($settings) {
            $settings->siteTitle = $validated['siteTitle'];
            $settings->welComeMessage = $validated['welComeMessage'];
            $settings->copyRightText = $validated['copyRightText'];
            $settings->version = $validated['version'];
            $settings->allowWelcomeEmail=request()->allowWelcomeEmail==1 ? 1 : 0;
            $settings->allowFaq=request()->allowFaq==1 ? 1 : 0;
            $settings->lastUpdatedBy=Auth::user()->userId;
            $settings->lastUpdatedDate=now();
            if(request()->hasFile('logoImage')){
                $fileName=Carbon::now()->timestamp.'.'.$validated['logoImage']->extension();
                $validated['logoImage']->move(public_path('images'),$fileName);
                $settings->logoPath=$fileName;
            }
            if(request()->hasFile('faviconImage')){
                $fileName=Carbon::now()->timestamp.'.'.$validated['faviconImage']->extension();
                $validated['faviconImage']->move(public_path('images'),$fileName);
                $settings->faviconPath=$fileName;
            }
            $settings->save();
            return redirect()->route('settings.show')->with('success', 'Settings updated successfully.')->with('settings', $settings);
        }
        return redirect()->route('settings.show')->with('error', 'Settings not found.');
    }

    public function UpdateEmailSettings(): RedirectResponse
    {
        $validated = request()->validate([
            'siteSettingsId' => 'required|integer',
            'defaultEmail' => 'nullable|string|email|max:255',
            'password' => 'nullable|string|min:8',
            'host' => 'nullable|string|max:255',
            'port' => 'nullable|integer',
        ]);
        $settings = Settings::find($validated['siteSettingsId']);
        if ($settings) {
            $settings->defaultEmail = $validated['defaultEmail'];
            $settings->password = $validated['password'];
            $settings->host = $validated['host'];
            $settings->port = $validated['port'];
            $settings->lastUpdatedBy=Auth::user()->userId;
            $settings->lastUpdatedDate=now();
            $settings->save();
            return redirect()->route('settings.show')->with('success', 'Email settings updated successfully.')->with('settings', $settings);
        }
        return redirect()->route('settings.show')->with('error', 'Settings not found.');
    }

    public function UpdateEmailTextSettings(): RedirectResponse
    {
        $validated = request()->validate([
            'siteSettingsId' => 'required|integer',
        ]);
        $settings = Settings::find($validated['siteSettingsId']);
        if ($settings) {
            $settings->welcomeEmailSubject = request()->welcomeEmailSubject;
            $settings->welcomeEmailHeader = request()->welcomeEmailHeader;
            $settings->welcomeEmailBody = request()->welcomeEmailBody;
            $settings->forgetPasswordEmailSubject = request()->forgetPasswordEmailSubject;
            $settings->forgetPasswordEmailHeader = request()->forgetPasswordEmailHeader;
            $settings->forgetPasswordEmailBody = request()->forgetPasswordEmailBody;
            $settings->lastUpdatedBy=Auth::user()->userId;
            $settings->lastUpdatedDate=now();
            $settings->save();
            return redirect()->route('settings.show')->with('success', 'Email text settings updated successfully.')->with('settings', $settings);
        }
        return redirect()->route('settings.show')->with('error', 'Settings not found.');
    }
    public function UpdateLandingSettings(): RedirectResponse
    {
        $validated = request()->validate([
            'siteSettingsId' => 'required|integer',
            'homePictureSrc' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'feature1PictureSrc' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'feature2PictureSrc' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'feature3PictureSrc' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'feature4PictureSrc' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
        $settings = Settings::find($validated['siteSettingsId']);
        if ($settings) {
            $settings->homeHeader1 = request()->homeHeader1;
            $settings->homeDetail1 = request()->homeDetail1;
            $settings->homeHeader2 = request()->homeHeader2;
            $settings->homeDetail2 = request()->homeDetail2;
            $settings->homeBox1Header = request()->homeBox1Header;
            $settings->homeBox1Detail = request()->homeBox1Detail;
            $settings->homeBox2Header = request()->homeBox2Header;
            $settings->homeBox2Detail = request()->homeBox2Detail;
            $settings->homeBox3Header = request()->homeBox3Header;
            $settings->homeBox3Detail = request()->homeBox3Detail;
            $settings->homeBox4Header = request()->homeBox4Header;
            $settings->homeBox4Detail = request()->homeBox4Detail;
            $settings->feature1Header = request()->feature1Header;
            $settings->feature1Detail = request()->feature1Detail;
            $settings->feature2Header = request()->feature2Header;
            $settings->feature2Detail = request()->feature2Detail;
            $settings->feature3Header = request()->feature3Header;
            $settings->feature3Detail = request()->feature3Detail;
            $settings->feature4Header = request()->feature4Header;
            $settings->feature4Detail = request()->feature4Detail;
            $settings->registrationText = request()->registrationText;
            $settings->contactUsText = request()->contactUsText;
            $settings->contactUsTelephone = request()->contactUsTelephone;
            $settings->contactUsEmail = request()->contactUsEmail;
            $settings->footerText = request()->footerText;
            $settings->footerFacebook = request()->footerFacebook;
            $settings->footerTwitter = request()->footerTwitter;
            $settings->footerLinkedin = request()->footerLinkedin;
            $settings->footerInstagram = request()->footerInstagram;
            if(request()->hasFile('homePictureSrc')){
                $fileName=Carbon::now()->timestamp.'.'.$validated['homePictureSrc']->extension();
                $validated['homePictureSrc']->move(public_path('images'),$fileName);
                $settings->homePicture=$fileName;
            }
            if(request()->hasFile('feature1PictureSrc')){
                $fileName=Carbon::now()->timestamp.'.'.$validated['feature1PictureSrc']->extension();
                $validated['feature1PictureSrc']->move(public_path('images'),$fileName);
                $settings->feature1Picture=$fileName;
            }
            if(request()->hasFile('feature2PictureSrc')){
                $fileName=Carbon::now()->timestamp.'.'.$validated['feature2PictureSrc']->extension();
                $validated['feature2PictureSrc']->move(public_path('images'),$fileName);
                $settings->feature2Picture=$fileName;
            }
            if(request()->hasFile('feature3PictureSrc')){
                $fileName=Carbon::now()->timestamp.'.'.$validated['feature3PictureSrc']->extension();
                $validated['feature3PictureSrc']->move(public_path('images'),$fileName);
                $settings->feature3Picture=$fileName;
            }
            if(request()->hasFile('feature4PictureSrc')){
                $fileName=Carbon::now()->timestamp.'.'.$validated['feature4PictureSrc']->extension();
                $validated['feature4PictureSrc']->move(public_path('images'),$fileName);
                $settings->feature4Picture=$fileName;
            }          
            $settings->lastUpdatedBy=Auth::user()->userId;
            $settings->lastUpdatedDate=now();
            $settings->save();
            return redirect()->route('settings.show')->with('success', 'Landing page settings updated successfully.')->with('settings', $settings);
        }
        return redirect()->route('settings.show')->with('error', 'Settings not found.');
    }

    public function CreateContacts(): RedirectResponse
    {
        $validated = request()->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|min:10|max:5000',
        ]);
        $validated['dateAdded']=now();
        Contact::create($validated);
        return redirect()->route('settings.index')->with('success', 'Your message has been sent successfully.');
    }
    public function GetContacts(): Response
    {
        $contacts = Contact::all();
        return Inertia::render('contact', [
            'contacts' => $contacts,
        ]);
    }
    public function GetFaqs(): Response
    {
        $faqs = Faq::all();
        return Inertia::render('faq', [
            'faqs' => $faqs,
        ]);
    }

    public function AddFaq(): RedirectResponse
    {
        $validated = request()->validate([
            'title' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:10|max:500',
        ]);
        $validated['addedBy']=Auth::user()->userId;
        Faq::create($validated);
        return redirect()->route('settings.showFaqs')->with('success', 'FAQ added successfully.');
    }

    public function UpdateFaq(): RedirectResponse
    {
        $validated = request()->validate([
            'faqId' => 'required|integer',
            'title' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:10|max:500',
        ]);
        $validated['lastUpdatedBy']=Auth::user()->userId;
        $faq = Faq::find($validated['faqId']);
        if ($faq) {
            $faq->update($validated);
            return redirect()->route('settings.showFaqs')->with('success', 'FAQ updated successfully.');
        }
        return redirect()->route('settings.showFaqs')->with('error', 'FAQ not found.');
    }

    public function DeleteFaq(): RedirectResponse
    {
        $validated = request()->validate([
            'faqId' => 'required|integer',
        ]);
        $faq = Faq::find($validated['faqId']);
        if ($faq) {
            $faq->delete();
            return redirect()->route('settings.showFaqs')->with('success', 'FAQ deleted successfully.');
        }
        return redirect()->route('settings.showFaqs')->with('error', 'FAQ not found.');
    }

    public function GetBrowseLogs(): Response
    {
        $logs=LogHistory::join('users','users.userId','=','loghistory.userId')
            ->select('users.userId','fullName','email','logInTime','logOutTime','ip','browser','browserVersion','platform')
            ->get();
        return Inertia::render('log/browse-log', [
            'logs' => $logs,
        ]);
    }
}
