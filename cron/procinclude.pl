#!/usr/bin/perl
use strict;
use warnings;

use File::Slurp;
use File::Basename;

my $dirname = dirname(__FILE__);

my @files = read_dir $ARGV[0], prefix => 1;
for my $filename (@files) {
    next unless $filename =~ /.htm$/;
    my $file = read_file $filename;
    my $modified_counter = 0;
    print ">$filename\n" if $#ARGV >= 1;
    my @includes = $file =~ /--INCLUDE cron\/([a-zA-z0-9-]+\.sh)--/g;
    foreach (@includes) {
        print "* $_\n" if $#ARGV >= 1;
        $modified_counter++;
        my $replacement = `sh $dirname/$_`;
        print "$replacement\n" if $#ARGV >= 1;
        $file =~ s/(--INCLUDE cron\/${_}--.).+?\s*(<!--ENDINCLUDE)/$1$replacement$2/ms;
    }
    write_file $filename, $file if $modified_counter > 0;
}
