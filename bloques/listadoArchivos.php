<?php
ini_set('display_errors', 'On');
$dir    = '/var/www/d_Box/d_' . $_SESSION['nick'];
// array_diff(scandir($dir), array('..', '.'))
$files = array();
$folders = array();
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        $cont1 = 0;
        $cont2 = 0;
        while (($file = readdir($dh)) !== false) {
            if(!is_dir($dir . '/' . $file)){
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
$folders = array_diff($folders, array('..', '.'))
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-8">
            <table class="table">
            <?php
                foreach ($folders as $file) {
                        ?><tr>
                            <td class="list-icon yellow"><i class="mdi-file-folder"></i></td>
                            <td class="list-name"><?php echo $file ?></td>
                            <td></td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox">
                                    </label>
                                </div>
                            </td>
                        </tr><?php
                }
                foreach ($files as $file) {
                    $ext = pathinfo($file, PATHINFO_EXTENSION);
                    $color = 'blue';
                    switch($ext){
                        case 'pdf':
                            $color = 'red';
                            break;
                        case 'jpg':
                            $color = 'green';
                            break;
                    }
                ?><tr>
                <td class="list-icon <?php echo $color ?>"><i class="mdi-editor-insert-drive-file"></i></td>
                <td class="list-name"><?php echo $file ?></td>
                <td></td>
                <td>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox">
                        </label>
                    </div>
                </td>
                </tr><?php
}
            ?>
            </table>
        </div>
    </div>
</div>
