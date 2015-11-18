<?php
/**
 * Класс для работы с админкой
 */
require_once __DIR__ . '/../../load/loader.php';

class Main {
    const HTML = 1;
    const JSON = 2;

    /**
     * формат вывода данных
     * @var
     */
    private $_format;

    public function __construct()
    {
        if (isset($_POST['format']) && $_POST['format'] == 2) {
            $this->_format = self::JSON;
        } else {
            $this->_format = self::HTML;
        }
        Clogic::load();
    }

    /**
     * Загрузка картинки
     * @return array
     * @throws MainException
     */
    public function action()
    {
        $config = COption::getConfig();

        $store = "storage";
        if ($_FILES) {
            try {
                if ($_FILES['pic']['size'] > $config['max_size_file']) {
                    throw new MainException("File too large!", 1);
                }
                $ext = NULL;
                switch($_FILES['pic']['type'])
                {
                    case 'image/gif':
                       $ext = 'gif';
                       break;
                    case 'image/jpeg':
                    case 'image/jpg':
                        $ext = 'jpg';
                        break;
                    case 'image/png':
                        $ext = 'png';
                        break;
                    default:
                }

                if ($ext) {
                    $count =  Clogic::getCounter();
                    $count ++;

                    $dir = intval($count/$config['max_files_in_dir']);
                    $name = time();
                    $file = "{$name}.{$ext}";
                    $directory = "{$dir}/{$file}";
                    $path = getcwd()."/../{$store}/{$dir}";

                    @mkdir($path);
                    move_uploaded_file($_FILES['pic']['tmp_name'], "{$path}/{$file}");

                    Clogic::addPicture($count, $directory);

                    return array(
                        'status' => 'ok',
                        'path' => "{$store}/{$directory}",
                    );
                } else {
                    throw new MainException("Invalid type of file!", 2);
                }
            } catch (MainException $e) {
                return array(
                    'status' => 'error',
                    'message' => $e->getMessage(),
                );
            }
        }
        return array();
    }

    /**
     * получение картинок
     * @return mixed
     */
    public function getPictures()
    {
        return Clogic::getPicturesFromDB();
    }

    /**
     * Вывод страницы админки
     * @param $result
     */
    public function response($result)
    {
        if ($this->_format == self::JSON) {
            echo json_encode($result);
        } else {
            Client::header();
            Client::startPage($result);
            Client::footer();
        }
    }

    /**
     * Вывод картинок
     * @param $result
     */
    public function showAll($result)
    {
        Client::header();
        Client::showAll($result);
        Client::footer();
    }
}