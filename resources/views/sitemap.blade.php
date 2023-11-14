<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset
        xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

    <url>
        <loc>{{ env('APP_URL') }}</loc>
        <lastmod>2020-08-03T17:03:07+00:00</lastmod>
        <priority>1.00</priority>
    </url>
    <url>
        <loc>{{ env('APP_URL') }}/pricing</loc>
        <lastmod>2020-08-03T17:03:07+00:00</lastmod>
        <priority>0.90</priority>
    </url>
    @foreach ($pages as $page)
        <url>
            <loc>{{ env('APP_URL') }}/show/{{$page->link}}</loc>
            <lastmod>{{ $page->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <priority>0.90</priority>
        </url>
    @endforeach
    @foreach ($stores as $store)
        <url>
            <loc>{{$store->route_store()}}</loc>
            <lastmod>{{ $store->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <priority>0.80</priority>
        </url>
    @endforeach
</urlset>