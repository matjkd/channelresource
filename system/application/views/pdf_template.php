<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style>

            body {
                margin: 0pt 22pt 24pt 22pt;
                font-family: 'Helvetica';
                font-size: 9px;
                line-height: 15px;
            }

            table {
                width:100%;
                margin-top: 2em;
                border: 0.0pt;
            }

            thead {
                background-color: #cccccc;
                border: 0.0pt;
            }

            tbody {
                background-color: #ffffff;
                border: 0.0pt;
            }

            th,td {
                padding: 0pt;
                border: 0.0pt;
            }

            hr {
                border: 0.5pt;
                width:100%;
                color: #555555;

            }

            table.collapse {

                border-collapse: collapse;
                border: 0.0pt solid #333333;  
            }

            table.collapse td {
                border: 0.0pt solid #333333;

            }
        </style>
    </head>

    <body>

        <table>
            <tr>
                <td width="340px">&nbsp;</td>

                <td width="185px"><img style="width: 180px;" src="logo.jpg"/>



                </td>
            </tr>

        </table>


        <?php
//fix currency if euro
        if ($currency == NULL) {

            $currency = "£";
        }
        if ($currency == '€') {
            $currency = "&#0128;";
        }

//set date
        $old_date_added = strtotime($date_added);
        $new_date_added = date('l jS \of F Y', $old_date_added);
        ?>



        <?php
        $this->load->view('admin/table');
        $this->table->add_row('<h2>Quote</h2>', '');
        $this->table->add_row("<strong>Company Name</strong>: $assigned_company_name", "<strong>Added by</strong>: $quote_added_by ");
        $this->table->add_row("<strong>Contact</strong>: $assigned_name", "<strong>Quote Reference</strong>: $quote_ref");
        $this->table->add_row("<strong>Email</strong>: $assigned_email", "<strong>Date of Creation</strong>: $new_date_added");

        foreach ($quote_results as $key => $row):


            $this->table->add_row('<h2>Summary</h2>', '');
            $this->table->add_row('<strong>Capital Amount</strong>', $currency . number_format($row['capital'], 2));


            $this->table->add_row('<strong>Payment Type</strong>', $row['payment_type']);
            $this->table->add_row('<strong>Payment Frequency</strong>', $row['payment_frequency']);
            $this->table->add_row('<strong>Payment Profile (Initial+Regular)</strong>', $row['initial'] . "+" . $row['regular']);
            $this->table->add_row('<strong>Initial</strong>', $currency . $row['initial_result']);
            $this->table->add_row('<strong>Regular</strong>', $currency . $row['regular_result']);
            $this->table->add_row('<strong>Annual Costs</strong>', $currency . $annual_support_costs);
            $this->table->add_row('<strong>Other Monthly Costs</strong>', $currency . $other_monthly_costs);
            $this->table->add_row('', '');

            $this->table->add_row('<h2>Cost per User/Unit Results</h2>', '');
            $this->table->add_row('<hr noshade="noshade"/>', '<hr noshade="noshade" />');
            $this->table->add_row('<strong>Number of Users/Units</strong>', $row['number_of_ports']);
            $this->table->add_row('<strong>Product cost per User/Unit</strong>', $currency . $row['product_cost_per_port']);
            $this->table->add_row('<strong>Service cost per User/Unit</strong>', $currency . $row['service_cost_per_port']);
            $this->table->add_row('<hr noshade="noshade"/>', '<hr noshade="noshade" />');
            $this->table->add_row('<strong>Total Cost Per User/Unit per month</strong>', $currency . $row['cost_per_port_per_month']);
            $this->table->add_row('<hr noshade="noshade"/>', '<hr noshade="noshade" />');
            echo $this->table->generate();
            $this->table->clear();

        endforeach;
        ?>




        <div style="font-size: 9px; text-align:center; width:500px; margin:30px auto; padding-top:50px;"><strong >cc</strong>apps is a company dedicated to providing user
            friendly technology to simplify complex commercial &amp;
            financial models. For further information see contact
            details below.</div>




        <script type="text/php">

            if ( isset($pdf) ) {

            $font = Font_Metrics::get_font("sans-serif");;
            $size = 8;
            $color = array(0,0,0);
            $text_height = Font_Metrics::get_font_height($font, $size);

            $foot = $pdf->open_object();

            $w = $pdf->get_width();
            $h = $pdf->get_height();

            // Draw a line along the bottom
            $y = $h - 2 * $text_height - 24;
            $pdf->line(16, $y, $w - 16, $y, $color, 1);

            $y += $text_height;

            $text = "";
            $pdf->text(16, $y, $text, $font, $size, $color);

            $pdf->close_object();
            $pdf->add_object($foot, "all");







            $text = "e:  info@ccapps.cc | t: 01302 245310 | w: www.ccapps.cc ";  

            // Center the text
            $width = Font_Metrics::get_text_width("e:  info@ccapps.cc | t: 01302 245310 | w: ccapps.cc", $font, $size);
            $pdf->page_text($w / 2 - $width / 2, $y, $text, $font, $size, $color);

            }
        </script>

    </body>
</html>