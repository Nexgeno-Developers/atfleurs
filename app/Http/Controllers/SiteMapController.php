<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class SiteMapController extends Controller
{
    public function newSitemap() {
        $otherUrls = [
            url('/about-us'),
            url('/careers'),
            url('/contact-us'),
            url('/blog'),
            url('/blog'),
            url('/services'),
            url('/faq'),
            url('/terms'),
            url('/return-policy'),
            url('/privacy-policy'),
        ];

        $blogsUrls = $this->getBlogUrls();
        $categoryUrls = $this->getCategoryUrls();
        $productUrls = $this->getProductUrls();

        $directory = public_path('sitemap');
        $my_file = $directory . '/sitemap.xml';

        // Create directory if it doesn't exist
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
        $handle = fopen($my_file, 'w+');

        $sitemapContent = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemapContent .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';

        $sitemapContent .= '
        <url>
            <loc>'.url('').'</loc>
            <lastmod>'.date('Y-m-d').'</lastmod>
            <changefreq>weekly</changefreq>
            <priority>1.0</priority>
        </url>';

        foreach ($otherUrls as $url) {
            $sitemapContent .= '
            <url>
                <loc>'.$url.'</loc>
                <lastmod>'.date('Y-m-d').'</lastmod>
                <changefreq>weekly</changefreq>
                <priority>0.8</priority>
            </url>';
        }

        foreach ($blogsUrls as $url) {
            $url = url('/blog/' . $url);
            $sitemapContent .= '
            <url>
                <loc>'.$url.'</loc>
                <lastmod>'.date('Y-m-d').'</lastmod>
                <changefreq>weekly</changefreq>
                <priority>0.5</priority>
            </url>';
        }
        foreach ($categoryUrls as $url) {
            $url = url('/category/' . $url);
            $sitemapContent .= '
            <url>
                <loc>'.$url.'</loc>
                <lastmod>'.date('Y-m-d').'</lastmod>
                <changefreq>weekly</changefreq>
                <priority>0.5</priority>
            </url>';
        }
        foreach ($productUrls as $url) {
            $url = url('/product/' . $url);
            $sitemapContent .= '
            <url>
                <loc>'.$url.'</loc>
                <lastmod>'.date('Y-m-d').'</lastmod>
                <changefreq>weekly</changefreq>
                <priority>0.5</priority>
            </url>';
        }
        
        $sitemapContent .= '</urlset>';

        fwrite($handle, $sitemapContent);
        fclose($handle);
        echo "<h2>Blog Sitemap Has Been Updated</h2>";
    }

    private function getBlogUrls()
    {
        $blogUrls = [];
        $blogs = Blog::where('status', 1)->get();

        foreach ($blogs as $blog) {
            $blogUrls[] = $blog->slug;
        }

        return $blogUrls;
    }
    
    private function getCategoryUrls()
    {
        $categoryUrls = [];
        $categories = Category::all();

        foreach ($categories as $category) {
            $categoryUrls[] = $category->slug;
        }

        return $categoryUrls;
    }
    
    private function getProductUrls()
    {
        $productUrls = [];
        $products = Product::where('published', 1)->get();

        foreach ($products as $product) {
            $productUrls[] = $product->slug;
        }

        return $productUrls;
    }
}
