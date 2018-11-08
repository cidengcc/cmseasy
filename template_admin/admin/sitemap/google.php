<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.google.com/schemas/sitemap/0.84">
<url>
<loc>http://****** </loc>
<lastmod>{dede:arclist row=1 titlelen=24 orderby=pubdate}
[field:pubdate function=strftime('%Y-%m-%d',@me)/]
{/dede:arclist}</lastmod>
<changefreq>daily</changefreq>
<priority>1.0</priority>
</url>
{dede:channel row='23' type='top'}
<url>
<loc>http://****** [field:typelink /]</loc>
<changefreq>daily</changefreq>
<priority>0.8</priority>
</url>
{/dede:channel}
{dede:arclist row=2000 orderby=pubdate}
<url>
<loc>http://****** [field:arcurl/]</loc>
<lastmod>[field:pubdate function=strftime('%Y-%m-%d',@me)/]</lastmod>
<changefreq>monthly</changefreq>
</url>
{/dede:arclist}
</urlset>