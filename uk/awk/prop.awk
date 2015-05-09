#!/bin/awk
# Usage : awk -f prop.awk electiondata.csv > outpu.out
# or   cat electiondata.csv | awk -f prop.awk
# calculate the election bonus
# 
#
BEGIN {	FS = ","
        seats = 650;
	min =650
	max = 0
	print "\nElection Proportionality Report"
	printf "\nSeats %d\n", seats;
	print "\nParty\tVote(%)\tSeats\tProportional Seats\tBonus(%)\tBonus(Seats) \n";
}
{
	sb = $3 - (($2*seats)/100)
	printf "%s\t %.2f\t%d\t\t%d\t\t%.2f\t\t%d\n" ,  $1, $2, $3, (($2*seats)/100), (($3/seats)*100) -$2  ,$3 - (($2*seats)/100) ;
        min = (min>sb)?sb:min
        max=(max>sb)?max:sb
} 
END { 
        printf "\n\tLow Bonus:\t%d",  min
        printf "\n\tHigh Bonus:\t%d\n\n",  max
}
