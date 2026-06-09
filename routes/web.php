<?php

use App\Models\Content;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', ['as' => 'web.index', 'uses' => 'Frontend\HomeController@index']);





Route::group([
    'prefix' => 'administrator'
], function () {
    Route::get('/', ['as' => 'login', 'uses' => 'Admin\AuthController@index']);
    Route::post('login', ['as' => 'admin.login', 'uses' => 'Admin\AuthController@login']);
});

Route::group([
    'middleware' => ['auth:admin'], 'prefix' => 'admin'
], function () {

    Route::group(['prefix' => 'filemanager'], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
    Route::get('logout', ['as' => 'admin.logout', 'uses' => 'Admin\AuthController@logout']);

    Route::post('profile/change_password', ['as' => 'admin.profile.change_password', 'uses' => 'Admin\ProfileController@changePassword']);

    Route::get('dashboard', ['as' => 'admin.dashboard', 'uses' => 'Admin\DashboardController@index']);

    Route::group(['prefix' => 'menu'], function () {
        Route::get('/', ['as' => 'admin.menu', 'uses' => 'Admin\MenuController@index']);
        Route::get('add', ['as' => 'admin.menu.add', 'uses' => 'Admin\MenuController@menuAdd']);
        Route::post('insert', ['as' => 'admin.menu.insert', 'uses' => 'Admin\MenuController@menuInsert']);
        Route::get('edit/{id}', ['as' => 'admin.menu.edit', 'uses' => 'Admin\MenuController@menuEdit']);
        Route::post('update/{id}', ['as' => 'admin.menu.update', 'uses' => 'Admin\MenuController@menuUpdate']);
        Route::get('remove/{id}', ['as' => 'admin.menu.remove', 'uses' => 'Admin\MenuController@menuRemove']);
    });

    Route::group(['prefix' => 'footer-menu'], function () {
        Route::get('/', ['as' => 'admin.footer.menu', 'uses' => 'Admin\FooterMenuController@index']);
        Route::get('add', ['as' => 'admin.footer.menu.add', 'uses' => 'Admin\FooterMenuController@footermenuAdd']);
        Route::post('insert', ['as' => 'admin.footer.menu.insert', 'uses' => 'Admin\FooterMenuController@menuInsert']);
        Route::get('edit/{id}', ['as' => 'admin.footer.menu.edit', 'uses' => 'Admin\FooterMenuController@menuEdit']);
        Route::post('update/{id}', ['as' => 'admin.footer.menu.update', 'uses' => 'Admin\FooterMenuController@menuUpdate']);
        Route::get('remove/{id}', ['as' => 'admin.footer.menu.remove', 'uses' => 'Admin\FooterMenuController@menuRemove']);
    });

    Route::group(['prefix' => 'slider'], function () {
        Route::get('/', ['as' => 'admin.slider.index', 'uses' => 'Admin\SliderController@index']);
        Route::get('add', ['as' => 'admin.slider.add', 'uses' => 'Admin\SliderController@sliderAdd']);
        Route::post('insert', ['as' => 'admin.slider.insert', 'uses' => 'Admin\SliderController@sliderInsert']);
        Route::get('edit/{id}', ['as' => 'admin.slider.edit', 'uses' => 'Admin\SliderController@sliderEdit']);
        Route::post('update/{id}', ['as' => 'admin.slider.update', 'uses' => 'Admin\SliderController@sliderUpdate']);
        Route::get('remove/{id}', ['as' => 'admin.slider.remove', 'uses' => 'Admin\SliderController@sliderRemove']);
        Route::post('/admin/slider/update-status', 'Admin\SliderController@updateStatus')->name('admin.slider.updateStatus');
    });

    Route::group(['prefix' => 'home'], function () {
        Route::get('/', ['as' => 'admin.home.content', 'uses' => 'Admin\HomeController@homecontentindex']);
        Route::get('edit/{id}', ['as' => 'admin.home.content.edit', 'uses' => 'Admin\HomeController@homecontentEdit']);
        Route::post('update/{id}', ['as' => 'admin.home.content.update', 'uses' => 'Admin\HomeController@homeupdateContent']);

        Route::get('add/step-one/{id}', ['as' => 'admin.homecontent.step.one.update', 'uses' => 'Admin\HomeController@homeContenOneEdit']);
        Route::post('update/step-one/{id}', ['as' => 'admin.homecontent.step.one.save', 'uses' => 'Admin\HomeController@homeContenOneUpdate']);

        
    });
    


 
 Route::group(['prefix' => 'content'], function () {
        Route::get('/', ['as' => 'admin.content', 'uses' => 'Admin\ContentController@contentindex']);

        Route::get('add', ['as' => 'admin.content.add', 'uses' => 'Admin\ContentController@contentAdd']);
        Route::post('save', ['as' => 'admin.content.save', 'uses' => 'Admin\ContentController@saveContent']);

        Route::get('edit/{id}', ['as' => 'admin.content.edit', 'uses' => 'Admin\ContentController@contentEdit']);
        Route::post('update/{id}', ['as' => 'admin.content.update', 'uses' => 'Admin\ContentController@updateContent']);


        


        Route::get('add/step-two/{contentId}', ['as' => 'admin.content.step.two.update', 'uses' => 'Admin\ContentController@contentStepTwoUpdate']);
        Route::post('insert/step-two/{contentId}', ['as' => 'admin.content.step.two.save', 'uses' => 'Admin\ContentController@contentStepTwoSave']);

        Route::get('add/step-three/{contentId}', ['as' => 'admin.content.step.three.update', 'uses' => 'Admin\ContentController@contentStepThreeUpdate']);
        Route::post('insert/step-three/{contentId}', ['as' => 'admin.content.step.three.save', 'uses' => 'Admin\ContentController@contentStepThreeSave']);
        
        Route::get('add/step-four/{contentId}', ['as' => 'admin.content.step.four.update', 'uses' => 'Admin\ContentController@contentStepFourUpdate']);
        Route::post('insert/step-four/{contentId}', ['as' => 'admin.content.step.four.save', 'uses' => 'Admin\ContentController@contentStepFourSave']);

        Route::get('add/step-five/{contentId}', ['as' => 'admin.content.step.five.update', 'uses' => 'Admin\ContentController@contentStepFiveUpdate']);
        Route::post('insert/step-five-one/{contentId}', ['as' => 'admin.content.step.five.one.save', 'uses' => 'Admin\ContentController@contentStepFiveoneSave']);
        Route::post('insert/step-five-two/{contentId}', ['as' => 'admin.content.step.five.two.save', 'uses' => 'Admin\ContentController@contentStepFivetwoSave']);

        Route::get('add/step-six/{contentId}', ['as' => 'admin.content.step.six.update', 'uses' => 'Admin\ContentController@contentStepSixUpdate']);
        Route::post('insert/step-six/{contentId}', ['as' => 'admin.content.step.six.save', 'uses' => 'Admin\ContentController@contentStepSixSave']);

        Route::get('complete', ['as' => 'admin.content.complete', 'uses' => 'Admin\ContentController@contentSaveComplete']);

        Route::get('page/image/remove/{id}', ['as' => 'admin.page.image.remove', 'uses' => 'Admin\ContentController@contentPageImageRemove']);
        Route::get('remove/{id}', ['as' => 'admin.content.remove', 'uses' => 'Admin\ContentController@contentRemove']);
    });

    Route::group(['prefix' => 'masscontent'], function () {
        Route::get('/', ['as' => 'admin.masscontent', 'uses' => 'Admin\MassContentController@massContentIndex']);

        Route::get('add', ['as' => 'admin.masscontent.add', 'uses' => 'Admin\MassContentController@massContentAdd']);
        Route::post('save', ['as' => 'admin.masscontent.save', 'uses' => 'Admin\MassContentController@MasssaveContent']);

        Route::get('add/mass-banner-content/{contentId}', ['as' => 'admin.massbanner.content.update', 'uses' => 'Admin\MassContentController@massBannercontentStepUpdate']);
        Route::post('insert/mass-banner-content/{contentId}', ['as' => 'admin.massbanner.content.save', 'uses' => 'Admin\MassContentController@massBannercontentStepSave']);

        Route::get('add/step-two/{contentId}', ['as' => 'admin.masscontent.step.two.update', 'uses' => 'Admin\MassContentController@massContentStepTwoUpdate']);
        Route::post('insert/step-two/{contentId}', ['as' => 'admin.masscontent.step.two.save', 'uses' => 'Admin\MassContentController@massContentStepTwoSave']);


        Route::get('add/step-three/{contentId}', ['as' => 'admin.masscontent.step.three.update', 'uses' => 'Admin\MassContentController@massContentStepThreeUpdate']);
        Route::post('insert/step-three/{contentId}', ['as' => 'admin.masscontent.step.three.save', 'uses' => 'Admin\MassContentController@massContentStepThreeSave']);

        Route::get('add/step-four/{contentId}', ['as' => 'admin.masscontent.step.four.update', 'uses' => 'Admin\MassContentController@massContentStepFourUpdate']);
        Route::post('insert/step-four/{contentId}', ['as' => 'admin.masscontent.step.four.save', 'uses' => 'Admin\MassContentController@massContentStepFourSave']);

        Route::get('add/step-five/{contentId}', ['as' => 'admin.masscontent.step.five.update', 'uses' => 'Admin\MassContentController@massContentStepFiveUpdate']);
        Route::post('insert/step-five/{contentId}', ['as' => 'admin.masscontent.step.five.save', 'uses' => 'Admin\MassContentController@massContentStepFiveSave']);

        Route::get('edit/{id}', ['as' => 'admin.masscontent.edit', 'uses' => 'Admin\MassContentController@massContentEdit']);
        Route::post('update/{id}', ['as' => 'admin.masscontent.update', 'uses' => 'Admin\MassContentController@MassupdateContent']);
        
         Route::get('gallery-image-remove/{id}', ['as' => 'admin.masscontent.gallery.image.remove', 'uses' => 'Admin\MassContentController@massContentGalleryImageRemove']);

        Route::get('remove/{id}', ['as' => 'admin.masscontent.remove', 'uses' => 'Admin\MassContentController@massContentRemove']);
    });
     Route::group(['prefix' => 'replicate-mass-content'], function () {
        Route::get('/', ['as' => 'admin.replicatemasscontent', 'uses' => 'Admin\ReplicateMassContentController@replicateMassContentindex']);
        Route::get('add', ['as' => 'admin.replicatemasscontent.add', 'uses' => 'Admin\ReplicateMassContentController@replicateMassContentAdd']);
        Route::post('save', ['as' => 'admin.replicatemasscontent.save', 'uses' => 'Admin\ReplicateMassContentController@replicateMassContentSave']);

        Route::get('edit/{id}', ['as' => 'admin.replicatemasscontent.edit', 'uses' => 'Admin\ReplicateMassContentController@replicateMassContentEdit']);
        Route::post('update/{id}', ['as' => 'admin.replicatemasscontent.update', 'uses' => 'Admin\ReplicateMassContentController@replicateMassUpdateContent']);

        Route::get('add/step-one/{contentId}', ['as' => 'admin.replicatemasscontent.step.one.update', 'uses' => 'Admin\ReplicateMassContentController@replicateMassContentStepOneUpdate']);
        Route::post('insert/step-one/{contentId}', ['as' => 'admin.replicatemasscontent.step.one.save', 'uses' => 'Admin\ReplicateMassContentController@replicatemassContentStepOneSave']);


        Route::get('remove/{id}', ['as' => 'admin.replicatemasscontent.remove', 'uses' => 'Admin\ReplicateMassContentController@replicateMassContentRemove']);
        Route::get('remove/page/{id}', ['as' => 'admin.replicatemasscontent.page.remove', 'uses' => 'Admin\ReplicateMassContentController@replicateMassContentPagedelete']);
        Route::post('content/visibility/{contentId}', ['as' => 'admin.replicatemasscontent.content.visibility','uses' => 'Admin\ReplicateMassContentController@updateContentVisibility']);
        Route::post('page/visibility/{pageId}', ['as' => 'admin.replicatemasscontent.page.visibility','uses' => 'Admin\ReplicateMassContentController@updatePageVisibility']);


        // AJAX URL CHECK ROUTE
        Route::post('check-page-url', ['as' => 'admin.replicatemasscontent.checkPageUrl','uses' => 'Admin\ReplicateMassContentController@checkPageUrl']); 
    });


    Route::group(['prefix' => 'Portfolio'], function () {
        Route::get('/', ['as' => 'admin.Portfolio', 'uses' => 'Admin\PortfolioGalleryController@PortfolioIndex']);

        Route::get('add', ['as' => 'admin.Portfolio.add', 'uses' => 'Admin\PortfolioGalleryController@PortfolioAdd']);
        Route::post('save', ['as' => 'admin.Portfolio.save', 'uses' => 'Admin\PortfolioGalleryController@savePortfolio']);

        Route::get('edit/{id}', ['as' => 'admin.Portfolio.edit', 'uses' => 'Admin\PortfolioGalleryController@PortfolioContentEdit']);
        Route::post('update/{id}', ['as' => 'admin.Portfolio.update', 'uses' => 'Admin\PortfolioGalleryController@PortfolioUpdateContent']);

        Route::get('add/portfolio/{contentId}', ['as' => 'admin.Portfolio.gallery.add', 'uses' => 'Admin\PortfolioGalleryController@galleryAdd']);
        Route::post('insert/portfolio/{contentId}', ['as' => 'admin.Portfolio.gallery.insert', 'uses' => 'Admin\PortfolioGalleryController@galleryInsert']);

        Route::get('add/portfolio/step-one-page-url/{contentId}', ['as' =>'admin.portfolio.content.step.one.mass.page.url.update', 'uses' => 'Admin\PortfolioGalleryController@steponePortfolioMassContentPageUrlUpdate']);
        Route::post('insert/portfolio/step-three-one-page-url/{contentId}', ['as' =>'admin.portfolio.content.step.one.mass.page.url.save', 'uses' => 'Admin\PortfolioGalleryController@steponePortfolioMassContentPageUrlSave']);

        Route::get('add/portfolio/step-two/{contentId}', ['as' =>'admin.portfolio.content.step.two.update', 'uses' => 'Admin\PortfolioGalleryController@stepTwoPortfolioContentUpdate']);
        Route::post('insert/portfolio/step-two/{contentId}', ['as' =>'admin.portfolio.content.step.two.save', 'uses' => 'Admin\PortfolioGalleryController@stepTwoPortfolioContentSave']);

        

        Route::get('add/portfolio/step-three/{contentId}', ['as' =>'admin.portfolio.content.step.three.update', 'uses' => 'Admin\PortfolioGalleryController@stepThreePortfolioContentUpdate']);
        Route::post('insert/portfolio/step-three/{contentId}', ['as' =>'admin.portfolio.content.step.three.save', 'uses' => 'Admin\PortfolioGalleryController@stepThreePortfolioContentSave']);

        Route::get('add/portfolio/step-four/{contentId}', ['as' =>'admin.portfolio.content.step.four.update', 'uses' => 'Admin\PortfolioGalleryController@stepFourPortfolioContentUpdate']);
        Route::post('insert/portfolio/step-four/{contentId}', ['as' =>'admin.portfolio.content.step.four.save', 'uses' => 'Admin\PortfolioGalleryController@stepFourPortfolioContentSave']);

        Route::get('add/portfolio/step-five/{contentId}', ['as' =>'admin.portfolio.content.step.five.update', 'uses' => 'Admin\PortfolioGalleryController@stepFiverPortfolioContentUpdate']);
        Route::post('insert/portfolio/step-five/{contentId}', ['as' =>'admin.portfolio.content.step.five.save', 'uses' => 'Admin\PortfolioGalleryController@stepFivePortfolioContentSave']);

        Route::get('remove/gallery/{id}', ['as' => 'admin.portfolio.remove.gallery.image', 'uses' => 'Admin\PortfolioGalleryController@removeGalleryPortfolio']);
        Route::get('remove/{id}', ['as' => 'admin.portfolio.content.remove', 'uses' => 'Admin\PortfolioGalleryController@portfolioContentRemove']);
    });

    Route::group(['prefix' => 'MassPortfolio'], function () {
        Route::get('/', ['as' => 'admin.massportfoliogallery', 'uses' => 'Admin\MassPortfolioController@massportfolioGalleryIndex']);

        Route::get('add', ['as' => 'admin.massportfoliogallery.add', 'uses' => 'Admin\MassPortfolioController@massportfolioGalleryAdd']);
        Route::post('save', ['as' => 'admin.massportfoliogallery.save', 'uses' => 'Admin\MassPortfolioController@massportfolioGallerySave']);

        Route::get('edit/{id}', ['as' => 'admin.massportfoliogallery.edit', 'uses' => 'Admin\MassPortfolioController@massportfolioGalleryEdit']);
        Route::post('update/{id}', ['as' => 'admin.massportfoliogallery.update', 'uses' => 'Admin\MassPortfolioController@massportfolioGalleryUpdate']);

        Route::get('add/portfolio-gallery/{contentId}', ['as' => 'admin.massportfoliogallery.step.one.add.images', 'uses' => 'Admin\MassPortfolioController@massportfolioGallerySteponeImagesAdd']);
        Route::post('insert/portfolio-gallery/{contentId}', ['as' => 'admin.massportfoliogallerystep.one.insert.images', 'uses' => 'Admin\MassPortfolioController@massportfolioGalleryateponeImagesInsert']);

        Route::get('add/portfolio/{contentId}', ['as' => 'admin.massportfoliogallery.gallery.add', 'uses' => 'Admin\MassPortfolioController@massportfoliogalleryAdd']);
        Route::post('insert/portfolio/{contentId}', ['as' => 'admin.massportfoliogallery.gallery.insert', 'uses' => 'Admin\MassPortfolioController@massportfoliogalleryInsert']);

        Route::get('remove/massgallery/{id}', ['as' => 'admin.massportfoliogallery.remove.gallery.image', 'uses' => 'Admin\MassPortfolioController@removemassportfoliogalleryPortfolio']);
        Route::get('remove/{id}', ['as' => 'admin.massportfoliogallery.content.remove', 'uses' => 'Admin\MassPortfolioController@massportfoliogalleryContentRemove']);

        //is_completed status update

        Route::put('admin/massportfoliogallery/update/{contentId}', ['as' => 'admin.massportfoliogallery.content.status.update', 'uses' => 'Admin\MassPortfolioController@massportfolioStatusUpdate']);

       
    });

    Route::group(['prefix' => 'Contacts'], function () {
        Route::get('/', ['as' => 'admin.Contacts', 'uses' => 'Admin\ContactController@index']);

        Route::get('add', ['as' => 'admin.Contacts.add', 'uses' => 'Admin\ContactController@contactAdd']);
        Route::post('save', ['as' => 'admin.Contacts.save', 'uses' => 'Admin\ContactController@saveContact']);

        Route::get('edit/{id}', ['as' => 'admin.Contacts.edit', 'uses' => 'Admin\ContactController@contactEdit']);
        Route::post('update/{id}', ['as' => 'admin.Contacts.update', 'uses' => 'Admin\ContactController@contactupdate']);

        Route::get('remove/{id}', ['as' => 'admin.Contacts.remove', 'uses' => 'Admin\ContactController@contactContentRemove']);
       
    });





    Route::group(['prefix' => 'filemanager'], function () {
        Route::get('/', ['as' => 'admin.filemanager', 'uses' => 'Admin\FileManagerImageController@filemanagerindex']);

        Route::get('add', ['as' => 'admin.filemanager.add', 'uses' => 'Admin\FileManagerImageController@filemanagerImageAdd']);
        Route::post('save', ['as' => 'admin.filemanager.save', 'uses' => 'Admin\FileManagerImageController@filemanagerImageSave']);

        Route::get('add.new.image.folder', ['as' => 'admin.filemanager.update.folder.image', 'uses' => 'Admin\FileManagerImageController@filemanagerImageUpdateFolder']);
        Route::post('save.new.image.folder', ['as' => 'admin.filemanager.update.folder.image.save', 'uses' => 'Admin\FileManagerImageController@filemanagerImageUpdateFolderImageSave']);

        Route::get('remove/{id}', ['as' => 'admin.filemanager.remove', 'uses' => 'Admin\FileManagerImageController@imgRemove']);
    });

    Route::get('get-filemanger-folder/{page_id}', ['as' => 'admin.filemanager.folder', 'uses' => 'Admin\FileManagerImageController@getFolder']);
    Route::get('get-filemanger-image/{file_id}/{page_id}', ['as' => 'admin.filemanager.image', 'uses' => 'Admin\FileManagerImageController@getImage']);

    Route::get('get-filemanger-image-for-both/{file_id}/{page_id}', ['as' => 'admin.filemanager.image.for.both', 'uses' => 'Admin\FileManagerImageController@getImageForBoth']);

    Route::get('get-sub-menu', ['as' => 'admin.sub.menu.fetch', 'uses' => 'Admin\ContentController@fetchSubmenu']);

    Route::post('ckeditor/upload', ['as' => 'ckeditor.upload', 'uses' => 'Admin\ContentController@uploadCkEditorImage']);


    Route::group(['prefix' => 'googleanalytics'], function () {
        Route::get('/', ['as' => 'admin.analytics', 'uses' => 'Admin\AnalyticsController@GoogleAnalyticsindex']);
        // Route::get('add', ['as' => 'admin.analytics.add', 'uses' => 'Admin\AnalyticsController@GoogleAnalyticsAdd']);
        // Route::post('save', ['as' => 'admin.analytics.save', 'uses' => 'Admin\AnalyticsController@GoogleAnalyticsSave']);
        Route::get('/edit/{id}', ['as' => 'admin.analytics.edit', 'uses' => 'Admin\AnalyticsController@GoogleAnalyticsEdit']);
        Route::post('/update/{id}', ['as' => 'admin.analytics.update', 'uses' => 'Admin\AnalyticsController@GoogleAnalyticsUpdate']);
        Route::get('/remove/{id}', ['as' => 'admin.analytics.remove', 'uses' => 'Admin\AnalyticsController@GoogleAnalyticsRemove']);
    });
    
     Route::group(['prefix' => 'noscriptgoogleanalytics'], function () {
        Route::get('/', ['as' => 'admin.noscriptanalytics', 'uses' => 'Admin\NoscriptAnalyticsController@NoscriptGoogleAnalyticsindex']);
        Route::get('/edit/{id}', ['as' => 'admin.noscriptanalytics.edit', 'uses' => 'Admin\NoscriptAnalyticsController@NoscriptGoogleAnalyticsEdit']);
        Route::post('/update/{id}', ['as' => 'admin.noscriptanalytics.update', 'uses' => 'Admin\NoscriptAnalyticsController@NoscriptGoogleAnalyticsUpdate']);
        Route::get('/remove/{id}', ['as' => 'admin.noscriptanalytics.remove', 'uses' => 'Admin\NoscriptAnalyticsController@NoscriptGoogleAnalyticsRemove']);
    });

    Route::group(['prefix' => 'settings'], function () {
        Route::get('/', ['as' => 'admin.setting', 'uses' => 'Admin\SettingController@Settingsindex']);
        Route::get('/edit/{id}', ['as' => 'admin.setting.edit', 'uses' => 'Admin\SettingController@SettingsEdit']);
        Route::post('/update/{id}', ['as' => 'admin.setting.update', 'uses' => 'Admin\SettingController@SettingsUpdate']);
    });


    Route::group(['prefix' => 'social'], function () {
        Route::get('/', ['as' => 'admin.social', 'uses' => 'Admin\SocialController@Socialindex']);
        Route::get('add', ['as' => 'admin.social.add', 'uses' => 'Admin\SocialController@SocialAdd']);
        Route::post('save', ['as' => 'admin.social.save', 'uses' => 'Admin\SocialController@SocialSave']);
        Route::get('/edit/{id}', ['as' => 'admin.social.edit', 'uses' => 'Admin\SocialController@SocialEdit']);
        Route::post('/update/{id}', ['as' => 'admin.social.update', 'uses' => 'Admin\SocialController@SocialUpdate']);
        Route::get('/remove/{id}', ['as' => 'admin.social.remove', 'uses' => 'Admin\SocialController@SocialRemove']);
    });
});

//Clear configuration cache:
Route::get('/optimize-clear', function () {
    Artisan::call('optimize:clear');
    return '<h1>Configurations optimize cleared</h1>';
});

//Clear configuration cache:
Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return '<h1>Storage linked</h1>';
});

// content & Mass content page
// Route::get('/{pageSlug?}', ['as' => 'web.page', 'uses' => 'Frontend\HomeController@page']);

Route::get('/{pageSlug?}', ['as' => 'web.page', 'uses' => 'Frontend\HomeController@page'])
    ->where('pageSlug', '.*');
