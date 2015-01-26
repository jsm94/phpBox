<?php
$dir    = '/var/www/d_Box/d_' . $_SESSION['nick'];
// array_diff(scandir($dir), array('..', '.'))
$files = array();
$folders = array();
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        $cont1 = 0;
        $cont2 = 0;
        while (($file = readdir($dh)) !== false) {
            if(!is_dir($file)){
                $files[$cont1] = $file;
                $cont1++;
            } else {
                $folders[$cont2] = $file;
                $cont2++;
            }
        }
        closedir($dh);
    }
}
mkdir($dir . '/carpeta2',0777, false);
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-8">
            <table class="table">
            <?php
                foreach ($folders as $file) {
                    if (!is_file($file)){
                        ?><tr>
                            <td></td>
                            <td><?php echo $file ?></td>
                            <td></td>
                            <td></td>
                        </tr><?php
                    }
                }
            ?>
            </table>
        </div>
    </div>
</div>
