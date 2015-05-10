#!/bin/awk
# Usage : awk -f prop.awk electiondata.csv > outpu.out
# or   cat electiondata.csv | awk -f prop.awk
# calculate the election bonus
# 
#
BEGIN {	FS = ","
        seats  = 166;  #Hard coded for UK House of Commons, 166 for Dail 108 for NI Assembly
	min    = 166
	max    = 0
	under  = 0
	over   = 0
	print "\nElection Proportionality Report"
	printf "\nSeats %d\n", seats;
	print "\nParty\tVote(%)\tSeats\tProportional Seats\tBonus(%)\tBonus(Seats) \n";
}
{
	sb = $3 - (($2*seats)/100)
	printf "%s\t %.2f\t%d\t\t%d\t\t%.2f\t\t%d\n" ,  $1, $2, $3, (($2*seats)/100), (($3/seats)*100) -$2  ,$3 - (($2*seats)/100) ;
        min = (min>sb)?sb:min
        max=(max>sb)?max:sb
        if (sb < 0)
		under = sb + under;
	if  (sb > 0)
		over = sb + over; 
} 
END { 
        printf "\n\tLow Bonus:\t%d",  min
        printf "\n\tHigh Bonus:\t%d\n\n",  max
        printf "\n\tUnder Rep:\t%.2f",  under
        printf "\n\tOver Rep:\t%.2f\n\n",  over
}
