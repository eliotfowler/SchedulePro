#!/usr/bin/perl -w
use strict;
use warnings;
use LWP::UserAgent;
 

my $URL = 'http://www.admin.muohio.edu/cfapps/courselist/selection_display.cfm';

#open (FILE, 'CSE_List.txt');
open (WFILE, '>>CSE_List.txt');

#my @lines = <FILE>;
#close(FILE);
my @times;

&parse_list;

sub parse_list {
	
	my $i = 0;
	my @details;
	my @lines;
	my $lineC;
	
	my $ua = new LWP::UserAgent;
		$ua->agent("Mozilla/4.0 (compatible; MSIE 69; Windows NT 6.9)");
		$ua->timeout(60);
		my $res = $ua->post($URL, {
   term   => '201310',
   campus  => '',
   subj => 'CSE',
   course_type   => '',
   course   => '',
   crn   => '',
   title   => '',
   level   => '',
   begin_time   => '',
   end_time   => '',
   monday => 'M',
   tuesday   => 'T',
   wednesday   => 'W',
   thursday   => 'R',
   friday   => 'F',
   saturday   => 'S',

});
		
		if ($res->is_success)
		{
			@lines = split("\n", $res->content);
			$lineC = @lines;
		}
		else
		{
			print "fail";
		}
	
	foreach(@lines) {
		if($lines[$i] =~ /.*\<td class\=\"colNote\"\>/i)
		{
			#found a class
			
			$i += 2;
			$lines[$i] =~ /\<td class\=\"colCrn\"\>(\d+)\<\/td\>/i;
			print $lines[$i] . "\n";
			my $crnNum = $1;
			#push(@details, $1);
			$i += 5;
			$lines[$i] =~ /\<td class\=\"colLim\"\>(\d+)\/(\d+)\<\/td\>/i;
			my $currentNum = $1;
			my $cap = $2;
			#print $lines[$i] . "\n";
			#push(@details, $1);
			#push(@details, $2);
			print WFILE $crnNum . "," . $currentNum . "," . $cap . "\n";

			
		}
		$i++;
		#print "CRN: " . $details[0] . " Current: " . $details[1] . " Limit " . $details[2] . "\n";
		#print WFILE $details[0] . "," . $details[1] . "," . $details[2] . "\n";
	}
}					
