#!/bin/perl
use strict;
use warnings;

use Carp 'verbose';
$SIG{ __DIE__ } = sub { Carp::confess( @_ ) };

use Template;
use DateTime;
use DateTime::Format::Strptime;
use DateTime::Format::RSS;

my $stdin_date_parser = DateTime::Format::Strptime->new(
  pattern => '%d %b %Y',
  on_error => 'croak',
);

my $dtr = DateTime::Format::RSS->new;

my @lines;
while (<>) {
    # tram	16 Mar 2019	http://www.urbanrail.net/eu/de/fr/freiburg.htm	Freiburg	Heinrich-von-Stephan-Str. - Europaplatz (1.9 km)
    chomp;
    my @line = split /\t/;
    my %line = (
        type => $line[0],
        date => $line[1],
        link => $line[2],
        location => $line[3],
        info => $line[4]
    );
    $line{rss_date} = $dtr->format_datetime($stdin_date_parser->parse_datetime($line{date}));
    $line{type} =~ s/-/ /g;
    $line{type} =~ s/\b(\w)/\U$1/g;
    push @lines, \%line;
}

my $vars = {
    run_date => $dtr->format_datetime(DateTime->now),
    lines => \@lines,
};

my $template = Template->new();
$template->process(\*DATA, $vars) || die $template->error(), "\n";

__DATA__
<?xml version="1.0" encoding="UTF-8"?><?xml-stylesheet type="text/css" href="/css/rss.css" ?><rss version="2.0"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	xmlns:atom="http://www.w3.org/2005/Atom"
	xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
	xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
>
	<channel>
		<title>UrbanRail.net - New Lines</title>
		<atom:link href="https://novalinium.com/urbanrail.rss" rel="self" type="application/rss+xml" />
		<link>http://urbanrail.net/news.htm</link>
		<description>Now Open</description>
		<lastBuildDate>[% run_date %]</lastBuildDate>
		<language>en-US</language>
		<sy:updatePeriod>daily</sy:updatePeriod>
		<sy:updateFrequency>1</sy:updateFrequency>
		[% FOREACH line IN lines %]
			<item>
				<title>[% line.info %]</title>
				<guid>[% line.link %]#[% line.type %]-[% line.date %]</guid>
				<link>[% line.link %]#[% line.type %]-[% line.date %]</link>
				<description><![CDATA[[% line.info %]
[% line.type %] opened in [% line.location %] on [% line.date %]]]></description>
				<pubDate>[% line.rss_date %]</pubDate>
                <category>type:[% line.type %]</category>
                <category>location:[% line.location %]</category>
			</item>
        [% END %]
	</channel>
</rss>
