<?php

$regresi = [
    [
        'Pedagang' => 'Hermanto',
        'Penjualan' => 89.2,
        'Keuntungan' => 4.9
    ],
    [
        'Pedagang' => 'Usman',
        'Penjualan' => 18.6,
        'Keuntungan' => 4.4
    ],
    [
        'Pedagang' => 'Marwan',
        'Penjualan' => 18.2,
        'Keuntungan' => 1.3
    ],
    [
        'Pedagang' => 'Syamsul',
        'Penjualan' => 71.7,
        'Keuntungan' => 8
    ],
    [
        'Pedagang' => 'Kadam',
        'Penjualan' => 58.6,
        'Keuntungan' => 6.6
    ],
    [
        'Pedagang' => 'Herman',
        'Penjualan' => 46.8,
        'Keuntungan' => 4.1
    ],
    [
        'Pedagang' => 'Iskandar',
        'Penjualan' => 17.5,
        'Keuntungan' => 2.6
    ],
    [
        'Pedagang' => 'Hamid',
        'Penjualan' => 11.9,
        'Keuntungan' => 1.7
    ],
    [
        'Pedagang' => 'Agus',
        'Penjualan' => 19.6,
        'Keuntungan' => 3.5
    ],
    [
        'Pedagang' => 'Bahrul Alam',
        'Penjualan' => 51.2,
        'Keuntungan' => 8.2
    ],
    [
        'Pedagang' => 'Suyanto',
        'Penjualan' => 28.6,
        'Keuntungan' => 6.1
    ]
];
// echo "<pre>";
// print_r($regresi['Penjualan']);

// for($i = 0; $i < count($regresi); $i++)
// {
//     print_r($regresi['Penjualan'][$i]);
// }
$totalP = 0;
foreach ($regresi as $item => $value) {
    // echo $value['Penjualan'];
    // echo "<pre>";
    $totalP += $value['Penjualan'];
}

// echo "Total = " . $totalP / count($regresi);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>

<body>
    <div class="col-10 mx-auto">
        <div class="table-responsive mx-auto my-5">
            <h2>Data Prediksi Keuntungan Penjualan</h2>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Pedagang</th>
                        <th>Penjualan</th>
                        <th>Keuntungan</th>
                        <th>x</th>
                        <th>y</th>
                        <th>x2</th>
                        <th>y2</th>
                        <th>xy</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $totalP = 0;
                    $totalK = 0;
                    $totalX = 0;
                    $totalY = 0;
                    $totalXY = 0;
                    foreach ($regresi as $item => $value) {
                        $totalP += $value['Penjualan'];
                        $totalK += $value['Keuntungan'];
                    }

                    foreach ($regresi as $item => $value) :
                        $x = $value['Penjualan'] - ($totalP / count($regresi));
                        $y = $value['Keuntungan'] - ($totalK / count($regresi));
                        $px = pow($x, 2);
                        $py = pow($y, 2);
                        $xy = $x * $y;
                    ?>
                        <tr>
                            <td><?php echo $value['Pedagang']; ?></td>
                            <td><?php echo $value['Penjualan']; ?></td>
                            <td><?php echo $value['Keuntungan']; ?></td>
                            <td><?php echo $x; ?></td>
                            <td><?php echo $y; ?></td>
                            <td><?php echo $px; ?></td>
                            <td><?php echo $py; ?></td>
                            <td><?php echo $xy; ?></td>
                        </tr>

                    <?php
                        $totalX += $px;
                        $totalY += $py;
                        $totalXY += $xy;
                    endforeach;

                    ?>

                    <tr>
                        <th>Jumlah</th>
                        <th><?php echo $totalP; ?></th>
                        <th><?php echo $totalK; ?></th>
                        <th></th>
                        <th></th>
                        <th><?php echo $totalX; ?></th>
                        <th><?php echo $totalY; ?></th>
                        <th><?php echo $totalXY; ?></th>
                    </tr>
                    <tr>
                        <th>Rata-Rata</th>
                        <th><?php echo $totalP / count($regresi); ?></th>
                        <th><?php echo $totalK / count($regresi); ?></th>
                        <th></th>
                        <th></th>
                        <th><?php echo $totalX / count($regresi); ?></th>
                        <th><?php echo $totalY / count($regresi); ?></th>
                        <th><?php echo $totalXY / count($regresi); ?></th>
                    </tr>
                    <tr>
                        <th>b</th>
                        <th colspan="7"><?php echo $totalXY / $totalX; ?></th>
                    </tr>
                    <tr>
                        <th>a</th>
                        <th colspan="7"><?php echo ($totalK / count($regresi)) - (($totalXY / $totalX) * ($totalP / count($regresi))); ?></th>
                    </tr>
                </tbody>
            </table>
        </div>

        <?php

        // $prediksi = "";
        // $hasil = "";

        $a = ($totalK / count($regresi)) - (($totalXY / $totalX) * ($totalP / count($regresi)));
        $b = $totalXY / $totalX;

        if (isset($_POST['submit'])) {
            $prediksi = $_POST['prediksi'];
            $hasil = $a + ($b * $prediksi);
        }

        ?>

        <div class="row">
            <div class="col-2">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="">Masukan Nilai X</label>
                        <input type="text" name="prediksi" class="form-control">
                    </div>
                    <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                </form>
            </div>
            <div class="col-4 mx-5" style="margin-top: 34px;">
                <?php if (isset($_POST['submit'])) { ?>
                    <input type="text" value="<?php echo $hasil; ?>" class="form-control">
                <?php } else { ?>
                    <input type="text" value="0" class="form-control">
                <?php } ?>
            </div>
        </div>

    </div>
</body>

</html>