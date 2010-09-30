<?php $tmpl = array (
                    'table_open'          => '<table class=\'contentpane\' id=\'datatable\'>',

                    'heading_row_start'   => '<tr class=\'ui-accordion-header ui-helper-reset ui-state-default ui-corner-all\'>',
                    'heading_row_end'     => '</tr>',
                    'heading_cell_start'  => '<th>',
                    'heading_cell_end'    => '</th>',

                    'row_start'           => '<tr class=\'sectiontableentry1\'>',
                    'row_end'             => '</tr>',
                    'cell_start'          => '<td>',
                    'cell_end'            => '</td>',

                    'row_alt_start'       => '<tr class=\'sectiontableentry2\'>',
                    'row_alt_end'         => '</tr>',
                    'cell_alt_start'      => '<td >',
                    'cell_alt_end'        => '</td>',

                    'table_close'         => '</table>'
              );
$this->table->set_template($tmpl);
?>