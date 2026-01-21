<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:content="http://purl.org/rss/1.0/modules/content/">
    <channel>
        <title>Trama Educativa</title>
        <link>{{ url('/') }}</link>
        <description>Portal de noticias educativas de Mar del Plata y la region. Cobertura de politica educativa, gremiales, universidad y cultura.</description>
        <language>es-AR</language>
        <lastBuildDate>{{ now()->toRfc2822String() }}</lastBuildDate>
        <atom:link href="{{ route('rss') }}" rel="self" type="application/rss+xml"/>
        <image>
            <url>{{ asset('favicon.svg') }}</url>
            <title>Trama Educativa</title>
            <link>{{ url('/') }}</link>
        </image>
        @foreach($articles as $article)
        <item>
            <title><![CDATA[{{ $article->title }}]]></title>
            <link>{{ route('article.show', $article) }}</link>
            <guid isPermaLink="true">{{ route('article.show', $article) }}</guid>
            <pubDate>{{ $article->published_at->toRfc2822String() }}</pubDate>
            <description><![CDATA[{{ $article->excerpt }}]]></description>
            <content:encoded><![CDATA[
                @if($article->featured_image_url)
                <p><img src="{{ $article->featured_image_url }}" alt="{{ $article->title }}"></p>
                @endif
                <p>{{ $article->excerpt }}</p>
            ]]></content:encoded>
            <category>{{ $article->category->name }}</category>
            <author>{{ $article->author->name }}</author>
        </item>
        @endforeach
    </channel>
</rss>
