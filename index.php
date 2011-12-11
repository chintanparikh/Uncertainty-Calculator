<?php

//still need to implement rounding to the same num of significant figures
//UPDATE, FUNCTION HAS BEEN CREATED, need to now create the form and implement it in the existing functions. use calcDecPlaces
//UPDATE Done, but doesn't round to 1?
//Does now, Fix the . issue
function addValues($num1, $unc1, $num2, $unc2, $decp)
{
	//force variables to be integers so we can add properly
	$num1 = $num1 + 0;
	$num2 = $num2 + 0;
	$unc1 = $unc1 + 0;
	$unc2 = $unc2 + 0;
	//save all the working to $working
	$working ='';
	$working = '(' . $num1 . '±' . $unc1 . ') + (' . $num2 . '±' . $unc2 . ') <br />';
	$working .= '=(' . $num1 . '+' . $num2 . ') ± (' . $unc1 . '+' . $unc2 . ') <br />';
	$answer = $num1 + $num2;
	$unc = $unc1 + $unc2;
	$working .= '=' . $answer . ' ± ' . $unc . '<br />';
	//for the final answer, round the numbers to the decp specified
	$working .= '=' . roundTo($answer, $decp) . ' ± ' . roundTo($unc, $decp) . '<br />';
	return $working;
	
}
function subtractValues($num1, $unc1, $num2, $unc2, $decp)
{
	//force variables to be integers so we can add properly
	$num1 = $num1 + 0;
	$num2 = $num2 + 0;
	$unc1 = $unc1 + 0;
	$unc2 = $unc2 + 0;
	//save all the working to $working
	$working ='';
	$working = '(' . $num1 . '±' . $unc1 . ') - (' . $num2 . '±' . $unc2 . ') <br />';
	$working .= '=(' . $num1 . '-' . $num2 . ') ± (' . $unc1 . '+' . $unc2 . ') <br />';
	$answer = $num1 - $num2;
	$unc = $unc1 + $unc2;
	$working .= '=' . $answer . ' ± ' . $unc . '<br />';
	$working .= '=' . roundTo($answer, $decp) . ' ± ' . roundTo($unc, $decp) . '<br />';
	return $working;
	
}
function multiplyValues($num1, $unc1, $num2, $unc2, $decp)
{
	//force variables to be integers so we can add properly
	$num1 = $num1 + 0;
	$num2 = $num2 + 0;
	$unc1 = $unc1 + 0;
	$unc2 = $unc2 + 0;
	//save all the working to $working
	$working ='';
	$working = '(' . $num1 . '±' . $unc1 . ') × (' . $num2 . '±' . $unc2 . ') <br />';
	$working .= '=(' . $num1 . '×' . $num2 . ') ± (' . $unc1 . '+' . $unc2 . ') <br />';
	$working .= '=(' . $num1 . '×' . $num2 . ') ± (' . round((($unc1*100)/$num1),$decp+3) . '%+' . round((($unc2*100)/$num2),$decp+3) . '%) <br />';
	$answer = $num1 * $num2;
	$unc = ($unc1/$num1) + ($unc2/$num2);
	$working .= '=' . round($answer,$decp+3) . ' ± ' . round($unc * 100,$decp+3) . '%<br />';// round the numbers so they aren't waaaay too long.
	$working .= '=' . round($answer,$decp+3) . ' ± ' . round($unc * $answer,$decp+3) . '<br />';
	$working .= '=' . roundTo($answer, $decp) . ' ± ' . roundTo($unc * $answer, $decp) . '<br />';
	return $working;
	
}
function divideValues($num1, $unc1, $num2, $unc2, $decp)
{
	//force variables to be integers so we can add properly
	$num1 = $num1 + 0;
	$num2 = $num2 + 0;
	$unc1 = $unc1 + 0;
	$unc2 = $unc2 + 0;
	//save all the working to $working
	$working ='';
	$working = '(' . $num1 . '±' . $unc1 . ') ÷ (' . $num2 . '±' . $unc2 . ') <br />';
	$working .= '=(' . $num1 . '÷' . $num2 . ') ± (' . $unc1 . '+' . $unc2 . ') <br />';
	$working .= '=(' . $num1 . '÷' . $num2 . ') ± (' . round((($unc1*100)/$num1),$decp+3) . '%+' . round((($unc2*100)/$num2),$decp+3) . '%) <br />';
	$answer = $num1 / $num2;
	$unc = ($unc1/$num1) + ($unc2/$num2);
	$working .= '=' . round($answer,$decp+3) . ' ± ' . round($unc * 100,$decp+3) . '%<br />';
	$working .= '=' . round($answer,$decp+3) . ' ± ' . round($unc * $answer,$decp+3) . '<br />';
	$working .= '=' . roundTo($answer, $decp) . ' ± ' . roundTo($unc * $answer, $decp) . '<br />';
	return $working;
	
}

function roundTo($num, $dec)
{
	//rounds to $dec number of decimal places
	$numsplit = explode('.',$num);  //splits it into the part infront of and behind the dec places
	if(@$numsplit[2]){ // if it has more than one dot, it'll return false.
		return false;
	}
	elseif(@$numsplit[1]){
		$decpart = $numsplit[1];
		$digits = strlen((string)$decpart);
		if($digits > $dec) // For when the number of digits after the decimal point is greater than the number of digits we want to round to.
		{
			$new = round($num, $dec);
			return $new;
		}
		elseif($digits < $dec) // For when the number of digits after the decimal point is less than the number of digits we want to round to.
		{
			$newdec = (string)$decpart;
			$add0s = $dec - $digits;
			while((int)$add0s > 0){
				$newdec .= '0';
				$add0s--;
			}
                        if($dec == 0){
				$newdec = $numsplit[0];
			}
			else{
				$newdec = $numsplit[0] . '.' . (string)$newdec;
			}
			return $newdec;
		}
		elseif((int)$digits == (int)$dec){
			$newdec = (string)$decpart;
			if($dec == 0){
				$newdec = $numsplit[0];
			}
			else{
				$newdec = $numsplit[0] . '.' . (string)$newdec;
			}
			return $newdec;
		}
	}
	else{
		$add0s = $dec;
		if($dec == 0){
		$newdec = $num;			
		}
		else{
		$newdec = $num . '.';			
		}
		while((int)$add0s > 0){
				$newdec .= '0';
				$add0s--;
			}
		return $newdec;
	}
	
}

function calcDecPlaces($number){
	$splitted = explode('.',$number);
	return strlen((string)$splitted[2]);
}


if(!isset($_POST['submitted']))
{
	include('form.php');
}
else
{
	//set the variables
	$num1 = htmlentities($_POST['N1']);
	$num2 = htmlentities($_POST['N2']);
	$un1 = htmlentities($_POST['U1']);
	$un2 = htmlentities($_POST['U2']);
	$op =  htmlentities($_POST['oper']);
	$decp = htmlentities($_POST['decp']);
	
	//work out the maths	
	switch($op)
	{
	case '+':
		print addValues($num1, $un1, $num2, $un2, $decp);
		print '<a href="index.php">Do another equation!</a>';
		break;
	case '-':
		print subtractValues($num1, $un1, $num2, $un2, $decp);
		print '<a href="index.php">Do another equation!</a>';
		break;
	case '*':
		print multiplyValues($num1, $un1, $num2, $un2, $decp);
		print '<a href="index.php">Do another equation!</a>';
		break;
	case '/':
		print divideValues($num1, $un1, $num2, $un2, $decp);
		print '<a href="index.php">Do another equation!</a>';
		break;
	default:
		print "There has been an error, this shouldn't be appearing";
		break;
	}
}
?>