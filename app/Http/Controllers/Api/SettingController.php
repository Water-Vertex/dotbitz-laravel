<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\SeoSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    // =================== SETTINGS ===================

    public function getSettings()
    {
        $settings = Setting::first();
        return response()->json([
            'success' => true,
            'data'    => $settings,
        ]);
    }

    public function saveSettings(Request $request)
    {
        $data = $request->only([
            'facebook', 'twitter', 'linkedin', 'instagram',
            'pintrest', 'youtube', 'email', 'about',
            'site_title', 'meta_title', 'meta_tags', 'meta_desc',
            'meta_keywords', 'head_tags', 'body_tags', 'phone', 'address',
        ]);

        // File uploads handle karo
        foreach (['favicon', 'main_logo', 'footer_logo'] as $field) {
            if ($request->hasFile($field)) {
                $file     = $request->file($field);
                $filename = time() . '_' . $field . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('assets/settings'), $filename);
                $data[$field] = $filename;
            }
        }

        $settings = Setting::first();

        if ($settings) {
            $settings->update($data);
        } else {
            $settings = Setting::create($data);
        }

        return response()->json([
            'success' => true,
            'message' => 'Settings saved successfully.',
            'data'    => $settings,
        ]);
    }

    // =================== SEO SETTINGS ===================

    public function getSeoSettings()
    {
        $seo = SeoSetting::first();
        return response()->json([
            'success' => true,
            'data'    => $seo,
        ]);
    }

    public function saveSeoSettings(Request $request)
    {
        $data = $request->only([
            'home_meta_title', 'home_meta_description', 'home_meta_keywords',
            'home_meta_tags', 'home_title', 'home_page_schema',
            'about_meta_title', 'about_meta_description', 'about_meta_keywords',
            'about_meta_tags', 'about_title', 'about_page_schema',
            'contact_meta_title', 'contact_meta_description', 'contact_meta_keywords',
            'contact_meta_tags', 'contact_title', 'contact_page_schema',
            'service_meta_title', 'service_meta_description', 'service_meta_keywords',
            'service_meta_tags', 'service_title', 'service_page_schema',
            'course_meta_title', 'course_meta_description', 'course_meta_keywords',
            'course_meta_tags', 'course_page_schema',
            'faq_meta_title', 'faq_meta_description', 'faq_meta_keywords', 'faq_meta_tags',
        ]);

        $seo = SeoSetting::first();

        if ($seo) {
            $seo->update($data);
        } else {
            $seo = SeoSetting::create($data);
        }

        return response()->json([
            'success' => true,
            'message' => 'SEO settings saved successfully.',
            'data'    => $seo,
        ]);
    }
}
