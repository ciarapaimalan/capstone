<?php

include ('MySQL.php');
$output = '';

if (mysqli_num_rows($result) > 0) {
    $output .= '<tr>
                                                <th>Assessment Date</th>
                                                <th>Risk Factors associated with Clinical Setting (Step One)</th>
                                                <th>Risk Factors associated with Patient(Step Two</th>
                                                <th>Total Risk Factor</th>
                                                <th>Contraindication to anticoagulants?</th>
                                                <th>Modalities</th>
                                                <th>Physcian</th>

                                            </tr>';

    while ($row = mysqli_fetch_array($result)) {
        $output .= '
                                                    <tr>
                                                                        <td>' . $row["exam_date"] . '</td>
                                                                        <td>' . $row["step_one"] . '</td>
                                                                        <td>' . $row["step_two"] . '</td>
                                                                        <td>' . $row["trf"] . '</td>
                                                                        <td>' . $row["anticoagulants"] . '</td>
                                                                        <td>' . $row["modalities"] . '</td>
                                                                        <td>' . $row["username"] . '</td>
           </tr>';
    }

    echo $output;
} else {
    echo 'Risk Assessment Not Found';
}
?>
