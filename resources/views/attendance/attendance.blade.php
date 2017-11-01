<div class="col-md-6 col-md-offset-3">
    <table border="10px" class="table table-responsive">
        <tr><th>Serial No</th>
            <th>Student Id</th>
            <th>Student Name</th>
            <th>FromDate {{ $fromdate }}<br>
            | ToDate {{ $todate }}</th>
            <th>Percentage</th>
        </tr>
        @php
            $z=1;
            $ch=$datecount/$stcount;

            for($j=0;$j<$datecount;$j+=$ch)
            {
                $att=0;
                $totcls=0;
                for($i=0;$i<$ch;$i++)
                {
                    $att+=$attendance1[$j+$i]->attended;
                    $totcls+=$attendance1[$j+$i]->totalclasses;
                }

                if(isset($less))
                {
                    if($att < $less)
                    {    
                        echo '<tr>';
                        echo '<td>'.$z++,'</td>';
                        echo '<td>'.$attendance1[$j]->st_id.'</td>';
                        foreach ($stdata as $v)
                        {
                            if($v->st_id == $attendance1[$j]->st_id)
                            echo '<td>'.$v->name.'</td>';
                        }
                        echo '<td>'.$att .'/'."&nbsp".$totcls.'</td><td>';
                         echo number_format((($att/$totcls)*100), 2, '.', ',') ;
                        echo '</td></tr>';
                    }
                }

                if(isset($great))
                {
                    if($att > $great)
                    {
                        echo '<tr>';
                        echo '<td>'.$z++,'</td>';
                        echo '<td>'.$attendance1[$j]->st_id.'</td>';
                        foreach ($stdata as $v)
                        {
                            if($v->st_id == $attendance1[$j]->st_id)
                            echo '<td>'.$v->name.'</td>';
                        }
                        echo '<td>'.$att .'/'."&nbsp".$totcls.'</td><td>';
                         echo number_format((($att/$totcls)*100), 2, '.', ',') ;
                        echo '</td></tr>';
                    }
                }

                if(isset($min) and isset($max))
                {
                    if($att > $min and $att < $max)
                    {
                        echo '<tr>';
                        echo '<td>'.$z++,'</td>';
                        echo '<td>'.$attendance1[$j]->st_id.'</td>';
                        foreach ($stdata as $v)
                        {
                            if($v->st_id == $attendance1[$j]->st_id)
                            echo '<td>'.$v->name.'</td>';
                        }
                        echo '<td>'.$att .'/'."&nbsp".$totcls.'</td><td>';
                         echo number_format((($att/$totcls)*100), 2, '.', ',') ;
                        echo '</td></tr>';
                    }
                }

                if(!isset($less) and !isset($great) and !isset($min) and !isset($max))
                {
                    echo '<tr>';
                    echo '<td>'.$z++,'</td>';
                    echo '<td>'.$attendance1[$j]->st_id.'</td>';
                    foreach ($stdata as $v)
                    {
                        if($v->st_id == $attendance1[$j]->st_id)
                        echo '<td>'.$v->name.'</td>';
                    }
                    echo '<td>'.$att .'/'."&nbsp".$totcls.'</td><td>';
                    echo number_format((($att/$totcls)*100), 2, '.', ',') ;

                    echo '</td></tr>';
                }

            }

        @endphp
    </table>
</div>