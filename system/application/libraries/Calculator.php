<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Calculator class
*
* 
*/

class Calculator
	{
	
		function quote($capital_type, $amount_type, $interest_type, $calculate_by, $payment_type, $payment_frequency, $initial, $regular, $number_of_ports, $annual_support_costs, $other_monthly_costs)
		{
		
			
		//START OF QUOTE CALCULATION
		
		
			
			
		$i=0;
		if ($payment_type==1)
			{
				$typeresult = "Arrears";
			}
		else if ($payment_type==2)
			{
				$typeresult = "Advance";
			}
		
		if ($payment_frequency==1)
			{
				$payment_frequencyresult="Yearly";
			}
		if ($payment_frequency==4)
			{
				$payment_frequencyresult="Quarterly";
			}
		if ($payment_frequency==12)
			{
				$payment_frequencyresult="Monthly";
			}
		
		



		/** Rate Per Thousand =if(C5=1; (1000/(C9+C2)*(C7+1)); 1000/(C9+C2) **/
		// interest type is actually what it's calculated by, 1 is interest rate. I shall sort out the variable names one day
		if ($interest_type==1)
			{
				$calculate_by = $calculate_by/100;
				if ($calculate_by==NULL)
				{
					//include("calc_capital.php");  
					exit;
				}
				//$calculate_by=$calculate_by/100;
				$interestperperiod =$calculate_by/$payment_frequency;
				/**  echo $interestperperiod;
				* pv=(1-(1+(C7))^-C3)/(C7) **/
				
				$pva =(1+$interestperperiod);
				$pvb = -$regular;
				$pvc= pow($pva,$pvb);
				$pv =(1-$pvc)/$interestperperiod;
				$interestresult = $calculate_by*100;
				$interestresult = "$interestresult&#37;";
				/** echo "<br/>pvc $pvc";
				* echo "<br/>pv $pv";
				* echo "<br/>work out rate per1000<br/>"; **/
				
			
				if ($payment_type==1)
					{
					$rateperthousand = (1000/($pv+$initial))*($interestperperiod+1);
					
					}
				else
					{
					$rateperthousand = (1000/($pv+$initial));
					
					}
			}
		
		//capital type	
		if ($capital_type==1)
		{
			$capital = $amount_type;
		}
		else if ($capital_type==2)
		{
			if($interest_type==2)
		
				{
				$rateperthousand = $calculate_by;
				}
			$capital = (($amount_type/$rateperthousand)*(1000));
		}
// interest type 3 is periodic payment

//if($interest_type==3)
	
//	{
//	$rateperthousand = $calculate_by/($capital/1000);
//	}

// interest typee 2 is rate per thousand
if($interest_type==2)
	
	{
	$rateperthousand = $calculate_by;
	}
	

$initialpayment = $capital/1000*($rateperthousand)*$initial;
$regularpayment = $capital/1000*($rateperthousand);
$totalpayback = ($regular*$regularpayment)+$initialpayment;
$totalinterest = $totalpayback-$capital;
$initialpaymentround = number_format($initialpayment, 2);
$regularpaymentround = number_format($regularpayment, 2);
$totalpaybackround = number_format($totalpayback, 2);
$totalinterestround = round($totalinterest, 2);
$rateperthousandround = number_format($rateperthousand, 2);
$capitalresult = number_format($capital, 2);
// echo "<br/><strong>Rate Per Thousand:</strong> $rateperthousand
// <br/><strong>Initial Payment:</strong> &pound;$initialpaymentround
// <br/><strong>Regular Payment:</strong> &pound;$regularpaymentround
// <br/><br/><strong>Total payback:</strong> &pound;$totalpaybackround
// <br/> <strong>Total interest:</strong> &pound;$totalinterestround";	
	
if ($interest_type>1)
	{
	
	
		if ($rateperthousand==NULL)
		{
		 include("calc_capital.php"); 
		exit;
		}
	$maxtries=500;
	
$guess = (100-(100/($totalpayback/$capital)));
$guess = round($guess, 3);


	do 		
		{
		
		
		$guessed =($guess/($payment_frequency))/100;
		$roundedrate = round($rateperthousand, 3);
		if ($payment_type==1)
			{
			$rpt= (1000/(((1-( pow((1+$guessed),(-$regular))))/$guessed)+$initial))*($guessed+1);
			
			}
			else
			{
			$rpt= (1000/(((1-( pow((1+$guessed),(-$regular))))/$guessed)+$initial));
			
			}
		$rpt = round($rpt, 3);
		//echo "<br/>Guess - $guess";
		
		if ($rpt<$roundedrate)
			{
			if ($payment_frequency==1)
				{
				$gd = abs(($roundedrate-$rpt)/12);
				$payment_frequencyresult="Yearly";
				
				}
				
				else if ($payment_frequency ==4)
				{
				$gd = abs(($roundedrate-$rpt)/4);
				}
				else if ($payment_frequency ==12)
				{
				$gd = abs($roundedrate-$rpt);
				}
			$guess=($guess+($gd));
			//echo "<br/>$roundedrate (rounded rate) minus $rpt (rpt)  - $gd -";
			}
		else
		if ($rpt>$roundedrate)
			{
			if ($payment_frequency==1)
				{
				$gd = abs(($roundedrate-$rpt)/12);
				
				}
				else if ($payment_frequency ==4)
				{
				$gd = abs(($roundedrate-$rpt)/4);
				}
				else if ($payment_frequency ==12)
				{
				$gd = abs($roundedrate-$rpt);
				}
				
			//echo "<br/>$rpt (rpt) minus $roundedrate (rounded rate) - $gd -";
			
				$guess=($guess-($gd));
				
			}
		if ($rpt==$roundedrate)
			{
			/**echo "<h2>calculated rate per thousand $rpt <br/>
			* interest rate - $guess, it took $i guesses<br/></h2>"; **/
			$guess=round($guess, 2);
			// echo "<br/><strong  class='Tips2' title='took $i tries'>Interest Rate:</strong> $guess&#37;";
			$solved=1;
			$interestresult = "$guess&#37;";
			break;	
			}
			else
			{
				$solved = 0;
			}
			
			
		$i = $i+1;
		}
		while ($i <= $maxtries);
	
	
	if ($solved==0)
		{
		$interestresult = "Could not be calculated";
		}	
	}
	if($number_of_ports > 0)
	{
	$cost_per_port_per_month = (((($regularpayment*$payment_frequency)/12)/$number_of_ports)+(($annual_support_costs/12)/$number_of_ports)+(($other_monthly_costs))/$number_of_ports);
	$cost_per_port_per_month = number_format($cost_per_port_per_month, 2);
	
	$product_cost_per_port = (($regularpayment*$payment_frequency)/12)/$number_of_ports;
	$product_cost_per_port = number_format($product_cost_per_port, 2);
	
	$service_cost_per_port = (($annual_support_costs/12)/$number_of_ports)+($other_monthly_costs)/$number_of_ports;
	$service_cost_per_port = number_format($service_cost_per_port, 2);
	}
	else
	{
		$cost_per_port_per_month = 0;
		$product_cost_per_port = 0;
		$service_cost_per_port = 0;
	}
	//END OF QUOTE CALCULATION
			
			
			
			$results['capital'] = $capital;
			$results['interest_rate'] = $interestresult;
			$results['rate_per_1000'] = $rateperthousandround;
			$results['payment_type'] = $typeresult;
			$results['payment_frequency'] = $payment_frequencyresult;
			$results['initial'] = $initial;
			$results['regular'] = $regular;
			$results['initial_result'] = $initialpaymentround;
			$results['regular_result'] = $regularpaymentround;
			$results['cost_per_port_per_month'] = $cost_per_port_per_month;
			$results['product_cost_per_port'] = $product_cost_per_port;
			$results['service_cost_per_port'] = $service_cost_per_port;
			$results['number_of_ports'] = $number_of_ports;
			
			$data[] = $results;
			return $data;
		}
		
		
		
		function roi($number_of_salespeople, $appts_per_month, $hours_per_appt, $appt_sale_ratio, $average_salary, $average_deal, $lease_penetration, $acceptance_ratio, $average_term, $subscription)
			{
			//CALCULATION STARTS HERE
			//calculate Portfolio Size
		$portfolio_size = ((((($appts_per_month/$appt_sale_ratio)*$number_of_salespeople)*($lease_penetration/100))*$average_deal))*$average_term;
				
		// Number of leases
		$number_of_leases = $portfolio_size/$average_deal;
		
		
		 
		//average payment and RBO level
			if ($average_term==36)
				{
					$average_payment =	$average_deal*0.03288;
					$rbo_available = (($average_deal-(24*$average_payment))*($number_of_leases/3))+(($average_deal-(12*$average_payment))*($number_of_leases/3));
					$term_years = 3;
				}
				else
				{
					
				}
			if ($average_term==48)
				{
					$average_payment = $average_deal*0.02607;
					$rbo_available = (($average_deal-(36*$average_payment))*($number_of_leases/4))+(($average_deal-(24*$average_payment))*($number_of_leases/4))+(($average_deal-(12*$average_payment))*($number_of_leases/4));
					$term_years = 4;
				}
				else
				{
					
				}
			if ($average_term==60)
				{
					$average_payment = $average_deal*0.02202;
					$rbo_available = (($average_deal-(48*$average_payment))*($number_of_leases/5))+(($average_deal-(36*$average_payment))*($number_of_leases/5))+(($average_deal-(24*$average_payment))*($number_of_leases/5))+(($average_deal-(12*$average_payment))*($number_of_leases/5));
					$term_years = 5;
				}
				else
				{
					
				}
		//end of average payment and RBO level
		
		// Cost per appointment
		$cost_per_appt = ((($average_salary/260)/8)*$hours_per_appt);
		
		//Lease Desk cost per sales per month
		$leasedesk_sales_cost = ($subscription/12)/$number_of_salespeople;
		
		//Average Number of Agreements per Sales
		$average_agreement_per_sales = $number_of_leases/$number_of_salespeople;
		
		//RBO available per sales
		$rbo_available_per_sales = $rbo_available/$number_of_salespeople;
		
		//Additional churn per month per sales
		$additional_churn_per_sales = ($rbo_available_per_sales/12)/2;
		
		//Additional churn per month total
		$additional_churn_total = $additional_churn_per_sales*$number_of_salespeople;
		
		//Total cost of lease desk per month
		$total_cost_per_month = $subscription/12;
		//CALCULATION ENDS HERE
		
		$results['portfolio_size'] = $portfolio_size;
		$results['number_of_leases'] = $number_of_leases;
		$results['average_payment'] = $average_payment;
		$results['term_years'] = $term_years;
		$results['rbo_available'] = $rbo_available;
		$results['cost_per_appt'] = $cost_per_appt;
		$results['leasedesk_sales_cost'] = $leasedesk_sales_cost;
		$results['average_agreement_per_sales'] = $average_agreement_per_sales;
		$results['rbo_available_per_sales'] = $rbo_available_per_sales;
		$results['additional_churn_per_sales'] = $additional_churn_per_sales;
		$results['additional_churn_total'] = $additional_churn_total;
		$results['total_cost_per_month'] = $total_cost_per_month;
		$data[] = $results;
		return $data;	
			
			}
	
		
	}
?>