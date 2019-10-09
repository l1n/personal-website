#!/usr/bin/perl
use strict;
use warnings;

use File::Slurp;
use File::stat;
use File::Touch;

use HTTP::Date;

my @articles = split "\n", `find . -name '*.article' -type f -printf "%T@\t%Tc %6k KiB %p\n" | sort -rn | cut -d '/' -f 2-`;

my $pre = read_file "article.pre";
my $post = read_file "article.post";

write_file "index.html", $pre;
write_file "feed.xml", read_file "rss.pre";

foreach my $article (@articles) {
    my ($id) = ($article =~ /^(.*)\.article$/);
    my $content = read_file $article;
    my $wc = `sed "s/<[^>]*>//g" $article | wc -w`; chomp $wc;
    my $wm = int ($wc / 180) + 1;
    my $mtime = stat($article)->mtime;
    my $pubDate = time2str $mtime;
    my ($title) = ($content =~ m[<h3>(.*)</h3>]);
    $content =~ s[<h3>.*</h3>][];
    $content = qq[<article id="$id">$content</article>];
    $content =~ s[<nav class="tags">][<nav class="tags">\n<li><a href="https://lin.noblejury.com/blog/$id.html">Permalink</a>];
    append_file "feed.xml", <<"EOF" if $title !~ /DO NOT PUBLISH/;
<item>
<title>$title</title>
<link>https://lin.noblejury.com/blog/$id.html</link>
<description><![CDATA[$content]]></description>
<pubDate>$pubDate</pubDate>
</item>
EOF
    $content = qq[<p>Word count: $wc (~$wm minutes), Last modified: $pubDate</p>$content];
    $content = qq[<h3>$title</h3>$content] if $title;
    append_file "index.html", $content if $title !~ /DO NOT PUBLISH/;
    $content = $pre . $content . $post;
    if ($title) {
        $content =~ s(<title>Littera Nova</title>)(<title>$title - Littera Nova</title>);
        $content =~ s("og:title" content="Littera Nova")("og:title" content="$title");
    }
    write_file "$id.html", $content;

    File::Touch->new(time => $mtime )->touch("$id.html");
}
append_file "index.html", $post;
append_file "feed.xml", read_file "rss.post";
