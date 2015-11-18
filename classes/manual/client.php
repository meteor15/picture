<?php
/**
 * Клиентская часть
 */

class Client {
    /**
     * @static
     * заголовок страницы
     */
    public static function header()
    {
        echo "<html><head><title>Gallery</title><body bgcolor='#c0c0c0'>";
    }

    /**
     * @static
     * Страница админки
     */
    public static function startPage($result)
    {
        ?>
        <h1 align = "center">
            Gallery of pictures
        </h1>
        <hr/>
        <p align = "center">
            <?php if (isset($result['status'])) {
                switch ($result['status']) {
                    case 'ok':
                        echo "Picture successfully filled. New url is http://example.com/{$result['path']}.<br/><br/>";
                        break;
                    case 'error':
                        echo $result['message'] . "<br/><br/>";
                        break;
                    default:
                }
            }?>
            <form action = "" method = "post" enctype = "multipart/form-data">
                <input type = "file" name = "pic"><br/>
                <table border="0">
                    <tr>
                        <td>
                            <input type = "radio" name = "format" value = "1">
                        </td>
                        <td>
                            HTML
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type = "radio" name = "format" value = "2">
                        </td>
                        <td>
                            JSON
                        </td>
                    </tr>
                </table>
            <input type = "submit" value = "Add">
            </form>
        </p>
        <?php
    }

    /**
     * вывод всех картинок
     * @static
     * @param $result
     */
    public static function showAll($result)
    {
        ?>
        <table border = "0">
            <?php
            $counter = 0;
            foreach ($result as $picture):
                if ($counter % 5 == 0) {
                    echo "<tr>";
                }
                ?>
                    <td width="20%">
                        <a href = "image.php?img=<?=$picture['path']?>">
                            <img src = "storage/<?=$picture['path']?>" width="100%">
                        </a>
                    </td>
            <?php
                $counter ++;
                if ($counter % 5 == 0) {
                    echo "</tr>";
                }
            endforeach;
            if ($counter % 5 != 0) {
                echo "</tr>";
            }
            ?>
        </table>
        <?php
    }

    /*
     * футер
     */
    public static function footer()
    {
        echo "</body></html>";
    }
}