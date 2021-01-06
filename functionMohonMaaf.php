<?php
$con = mysqli_connect("localhost", "root", "", "db_mydosa");

function MohonMaaf($mydosa)
{
    if (isset($_POST["tombolMintaMaaf"])) {
        if ($_POST > 0) {
            global $con;
            $julid = htmlspecialchars($mydosa["julid"]);
            $hate = htmlspecialchars($mydosa["hate"]);
            $buruk = htmlspecialchars($mydosa["buruk"]);
            $shit = htmlspecialchars($mydosa["shit"]);

            $dosa = mysqli_query($con, "SELECT * FROM dosa WHERE
                    mulut='$julid' OR
                    comment='$hate' OR
                    posting='$shit' OR
                    perbuatan='$buruk' ORDER BY id_dosa DESC
                    ");

            if (mysqli_fetch_assoc($dosa)) {
                echo "
                    <script>
                        alert('Mohon Maaf Lahir dan Batin,,,
                               dari isan yg blm berkeluarga :v');
                    </script>
                    ";
                return false;
            }
        }
    }
}
