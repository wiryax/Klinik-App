<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Pasien</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <style>
        table,
        tbody,
        thead,
        tr,
        td,
        th {
            text-align: center;
            border: 1px solid black;
            margin: auto;
            width: 80vw;
        }

        h1 {
            text-align: center;
            margin-top: 50px;
            margin-bottom: 50px;
        }
    </style>
</head>

<body>
    <h1>Laporan Data Pasien</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Pasien</th>
                <th>Nama Pasien</th>
                <th>Alamat</th>
                <th>Nomer Telphone</th>
                <th>Kode Resep</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($lap_pasien as $row) :
            ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $row->username ?></td>
                    <td><?= $row->alamat ?></td>
                    <td><?= $row->no_tlp ?></td>
                    <td><?= $row->tgl_periksa ?></td>
                    <td><?= $row->kd_resep ?></td>
                </tr>
            <?php
                $i++;
            endforeach;
            ?>
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>

</html>