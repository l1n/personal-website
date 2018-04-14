#!/usr/bin/perl
use strict;
use warnings;

use File::Slurp;
use File::stat;
use File::Touch;

my @articles = split "\n", `find . -name '*.article' -type f -printf "%T@\t%Tc %6k KiB %p\n" | sort -rn | cut -d '/' -f 2-`;

my $pre = read_file "article.pre";
my $post = read_file "article.post";

write_file "index.html", $pre;

foreach my $article (@articles) {
    my ($id) = ($article =~ /^(.*)\.article$/);
    my $content = read_file $article;
    my ($title) = ($content =~ m[<h3>(.*)</h3>]);
    $content =~ s[<h3>.*</h3>][];
    $content = qq[<article id="$id">$content</article>];
    $content = qq[<h3>$title</h3>$content] if $title;
    $content =~ s[<nav class="tags">][<nav class="tags">\n<li><a href="https://lin.noblejury.com/blog/$id.html">Permalink</a>];
    append_file "index.html", $content;
    $content = $pre . $content . $post;
    if ($title) {
        $content =~ s(<title>Littera Nova</title>)(<title>$title - Littera Nova</title>);
    }
    write_file "$id.html", $content;
    File::Touch->new(time => stat($article)->mtime )->touch("$id.html");
}
append_file "index.html", $post;
