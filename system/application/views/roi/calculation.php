<?php 
$user =  $user_id;

foreach($roi_numbers as $key => $data):

//CALCULATION STARTS HERE
			//calculate Portfolio Size
		$data['portfolio_size'] = ((((($data['appts_per_month']/$data['appt_sale_ratio'])*$data['number_of_salespeople'])*($data['lease_penetration']/100))*$data['average_deal']))*$data['average_term'];
				
		// Number of leases
		$data['number_of_leases'] = $data['portfolio_size']/$data['average_deal'];
		
		$portfolio_size = $data['portfolio_size'];
		 
		//average payment and RBO level
			if ($data['average_term']==36)
				{
					$data['average_payment'] =	$data['average_deal']*0.03288;
					$data['rbo_available'] = (($data['average_deal']-(24*$data['average_payment']))*($data['number_of_leases']/3))+(($data['average_deal']-(12*$data['average_payment']))*($data['number_of_leases']/3));
					$data['term_years'] = 3;
				}
				else
				{
					
				}
			if ($data['average_term']==48)
				{
					$data['average_payment'] = $data['average_deal']*0.02607;
					$data['rbo_available'] = (($data['average_deal']-(36*$data['average_payment']))*($data['number_of_leases']/4))+(($data['average_deal']-(24*$data['average_payment']))*($data['number_of_leases']/4))+(($data['average_deal']-(12*$data['average_payment']))*($data['number_of_leases']/4));
					$data['term_years'] = 4;
				}
				else
				{
					
				}
			if ($data['average_term']==60)
				{
					$data['average_payment'] = $data['average_deal']*0.02202;
					$data['rbo_available'] = (($data['average_deal']-(48*$data['average_payment']))*($data['number_of_leases']/5))+(($data['average_deal']-(36*$data['average_payment']))*($data['number_of_leases']/5))+(($data['average_deal']-(24*$data['average_payment']))*($data['number_of_leases']/5))+(($data['average_deal']-(12*$data['average_payment']))*($data['number_of_leases']/5));
					$data['term_years'] = 5;
				}
				else
				{
					
				}
		//end of average payment and RBO level
		
		// Cost per appointment
		$data['cost_per_appt'] = ((($data['average_salary']/260)/8)*$data['hours_per_appt']);
		
		//Lease Desk cost per sales per month
		$data['leasedesk_sales_cost'] = ($data['subscription']/12)/$data['number_of_salespeople'];
		
		//Average Number of Agreements per Sales
		$data['average_agreement_per_sales'] = $data['number_of_leases']/$data['number_of_salespeople'];
		
		//RBO available per sales
		$data['rbo_available_per_sales'] = $data['rbo_available']/$data['number_of_salespeople'];
		
		//Additional churn per month per sales
		$data['additional_churn_per_sales'] = ($data['rbo_available_per_sales']/12)/2;
		
		//Additional churn per month total
		$data['additional_churn_total'] = $data['additional_churn_per_sales']*$data['number_of_salespeople'];
		
		//Total cost of lease desk per month
		$data['total_cost_per_month'] = $data['subscription']/12;
		//CALCULATION ENDS HERE


endforeach; 
return $data;


?>
