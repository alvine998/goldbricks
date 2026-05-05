<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Article;
use App\Models\Page;
use Illuminate\Support\Facades\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        // Static pages
        $staticPages = [
            ['url' => route('home'), 'priority' => '1.0', 'changefreq' => 'weekly'],
            ['url' => route('project'), 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => route('gallery'), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => route('articles'), 'priority' => '0.9', 'changefreq' => 'daily'],
            ['url' => route('about'), 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['url' => route('contact'), 'priority' => '0.8', 'changefreq' => 'monthly'],
        ];

        foreach ($staticPages as $page) {
            $sitemap .= $this->addUrl($page['url'], $page['changefreq'], $page['priority']);
        }

        // Projects
        $projects = Project::all();
        foreach ($projects as $project) {
            $sitemap .= $this->addUrl(route('project.show', $project->slug), 'weekly', '0.8', $project->updated_at);
        }

        // Articles
        $articles = Article::where('status', 'published')->get();
        foreach ($articles as $article) {
            $sitemap .= $this->addUrl(route('articles.show', $article->slug), 'monthly', '0.7', $article->updated_at);
        }

        $sitemap .= '</urlset>';

        return Response::make($sitemap, 200, [
            'Content-Type' => 'application/xml',
        ]);
    }

    private function addUrl($url, $changefreq = 'monthly', $priority = '0.5', $lastmod = null)
    {
        $xml = '<url>' . "\n";
        $xml .= '  <loc>' . htmlspecialchars($url) . '</loc>' . "\n";
        if ($lastmod) {
            $xml .= '  <lastmod>' . $lastmod->toAtomString() . '</lastmod>' . "\n";
        }
        $xml .= '  <changefreq>' . $changefreq . '</changefreq>' . "\n";
        $xml .= '  <priority>' . $priority . '</priority>' . "\n";
        $xml .= '</url>' . "\n";
        return $xml;
    }
}
