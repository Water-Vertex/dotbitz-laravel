<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SitemapController extends Controller
{
    // ===== STATIC PAGES =====
    private function getStaticPages(): array
    {
        return [
            [
                'url'        => url('/'),
                'title'      => 'Home',
                'priority'   => '1.0',
                'changefreq' => 'daily',
                'lastmod'    => now()->format('Y-m-d'),
            ],
            [
                'url'        => url('/about-us'),
                'title'      => 'About Us',
                'priority'   => '0.8',
                'changefreq' => 'monthly',
                'lastmod'    => now()->format('Y-m-d'),
            ],
            [
                'url'        => url('/contact-us'),
                'title'      => 'Contact Us',
                'priority'   => '0.7',
                'changefreq' => 'monthly',
                'lastmod'    => now()->format('Y-m-d'),
            ],
            [
                'url'        => url('/faq'),
                'title'      => 'FAQ',
                'priority'   => '0.7',
                'changefreq' => 'monthly',
                'lastmod'    => now()->format('Y-m-d'),
            ],
            [
                'url'        => url('/courses'),
                'title'      => 'Courses',
                'priority'   => '0.9',
                'changefreq' => 'weekly',
                'lastmod'    => now()->format('Y-m-d'),
            ],
            [
                'url'        => url('/book-free-appointment'),
                'title'      => 'Book Free Appointment',
                'priority'   => '0.8',
                'changefreq' => 'monthly',
                'lastmod'    => now()->format('Y-m-d'),
            ],
            [
                'url'        => url('/pre-registration'),
                'title'      => 'Pre Registration',
                'priority'   => '0.7',
                'changefreq' => 'monthly',
                'lastmod'    => now()->format('Y-m-d'),
            ],
            [
                'url'        => url('/privacy-policy'),
                'title'      => 'Privacy Policy',
                'priority'   => '0.3',
                'changefreq' => 'yearly',
                'lastmod'    => now()->format('Y-m-d'),
            ],
            [
                'url'        => url('/terms-of-service'),
                'title'      => 'Terms of Service',
                'priority'   => '0.3',
                'changefreq' => 'yearly',
                'lastmod'    => now()->format('Y-m-d'),
            ],
            [
                'url'        => url('/cookie-policy'),
                'title'      => 'Cookie Policy',
                'priority'   => '0.3',
                'changefreq' => 'yearly',
                'lastmod'    => now()->format('Y-m-d'),
            ],
        ];
    }

    // ===== DYNAMIC CONTENT =====
    private function getDynamicContent(): array
    {
        // Courses
        $courses = [];
        try {
            $courses = Course::select('id', 'course_name', 'slug', 'updated_at')
                ->get()
                ->map(function($course) {
                    $slug = $course->slug ?? \Str::slug($course->course_name ?? 'course-' . $course->id);
                    return [
                        'url'        => url('/course/' . $slug),
                        'title'      => $course->course_name ?? 'Course',
                        'priority'   => '0.8',
                        'changefreq' => 'weekly',
                        'lastmod'    => $course->updated_at
                            ? $course->updated_at->format('Y-m-d')
                            : now()->format('Y-m-d'),
                    ];
                })->toArray();
        } catch (\Exception $e) {}

        // Blog Posts
        $posts = [];
        try {
            if (class_exists(\App\Models\Blog::class)) {
                $posts = Blog::select('id', 'title', 'slug', 'updated_at')
                    ->get()
                    ->map(function($post) {
                        return [
                            'url'        => url('/blog/' . ($post->slug ?? $post->id)),
                            'title'      => $post->title ?? 'Blog Post',
                            'priority'   => '0.7',
                            'changefreq' => 'monthly',
                            'lastmod'    => $post->updated_at
                                ? $post->updated_at->format('Y-m-d')
                                : now()->format('Y-m-d'),
                        ];
                    })->toArray();
            }
        } catch (\Exception $e) {}

        // Categories
        $categories = [];
        try {
            if (class_exists(\App\Models\Category::class)) {
                $categories = Category::select('id', 'name', 'slug', 'updated_at')
                    ->get()
                    ->map(function($category) {
                        return [
                            'url'        => url('/category/' . ($category->slug ?? $category->id)),
                            'title'      => $category->name ?? 'Category',
                            'priority'   => '0.6',
                            'changefreq' => 'weekly',
                            'lastmod'    => $category->updated_at
                                ? $category->updated_at->format('Y-m-d')
                                : now()->format('Y-m-d'),
                        ];
                    })->toArray();
            }
        } catch (\Exception $e) {}

        return [
            'courses'    => $courses,
            'posts'      => $posts,
            'categories' => $categories,
        ];
    }

    // ===== ALL URLS =====
    private function getAllUrls(): array
    {
        $all     = $this->getStaticPages();
        $dynamic = $this->getDynamicContent();

        foreach ($dynamic as $items) {
            foreach ($items as $item) {
                $all[] = $item;
            }
        }

        return $all;
    }

    // ===== URL COUNTS =====
    private function getUrlCounts(): array
    {
        $dynamic = $this->getDynamicContent();
        $static  = count($this->getStaticPages());

        $counts = [
            'static'     => $static,
            'courses'    => count($dynamic['courses']),
            'posts'      => count($dynamic['posts']),
            'categories' => count($dynamic['categories']),
        ];

        $counts['total'] = array_sum($counts);
        return $counts;
    }

    // ===== API: Get Sitemap Data for Angular =====
    public function getSitemapData()
    {
        return response()->json([
            'success'        => true,
            'staticPages'    => $this->getStaticPages(),
            'dynamicContent' => $this->getDynamicContent(),
            'urlCounts'      => $this->getUrlCounts(),
            'lastGenerated'  => now()->format('Y-m-d H:i:s'),
            'allUrls'        => $this->getAllUrls(),
        ]);
    }

    // ===== API: Download XML =====
    public function downloadXml()
    {
        $xml = $this->buildXml();

        return Response::make($xml, 200, [
            'Content-Type'        => 'application/xml',
            'Content-Disposition' => 'attachment; filename="sitemap.xml"',
        ]);
    }

    // ===== WEB: View XML (sitemap.xml) =====
    public function viewXml()
    {
        $xml = $this->buildXml();

        return Response::make($xml, 200, [
            'Content-Type' => 'application/xml',
        ]);
    }

    // ===== BUILD XML =====
    private function buildXml(): string
    {
        $urls = $this->getAllUrls();

        $xml  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($urls as $url) {
            $xml .= "  <url>\n";
            $xml .= "    <loc>" . htmlspecialchars($url['url']) . "</loc>\n";
            $xml .= "    <lastmod>{$url['lastmod']}</lastmod>\n";
            $xml .= "    <changefreq>{$url['changefreq']}</changefreq>\n";
            $xml .= "    <priority>{$url['priority']}</priority>\n";
            $xml .= "  </url>\n";
        }

        $xml .= '</urlset>';

        return $xml;
    }
}