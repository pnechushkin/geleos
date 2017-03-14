<?php
/**
 * Created by PhpStorm.
 * User: Павел
 * Date: 13.03.2017
 * Time: 15:49
 */
if(!function_exists('classAutoLoader')){
    function classAutoLoader($class){
        $class=strtolower($class);
        $classFile='classes/'.$class.'.class.php';
        if(is_file($classFile)&&!class_exists($class)) include $classFile;
    }
}
spl_autoload_register('classAutoLoader');

$url_val=$_POST['url'];
$url = new Robots();
$url->Run($url_val);
if ($url->getResponse()==200):?>
    <!--    Проверка кода ответа сервера для файла robots.txt-->
    <?php    if ($url->getRobotsResponse()==200){
        $col='green';
        $status_text='OK';
        $condition='Файл robots.txt отдаёт код ответа сервера 200';
        $recommendations='Доработки не требуются';
    }
    else {
        $col='red';
        $status_text='Ошибка';
        $condition='При обращении к файлу robots.txt сервер возвращает код ответа ('.$url->getRobotsResponse().')';
        $recommendations='Программист: Файл robots.txt должны отдавать код ответа 200, иначе файл не будет обрабатываться. Необходимо настроить сайт таким образом, чтобы при обращении к файлу robots.txt сервер возвращает код ответа 200';
    } ?>
    <div style="width: 100%">
        <div style="float: left; width: 24%;height: auto">
            Проверка кода ответа сервера для файла robots.txt
        </div>
        <div style="float: left; width: 24%; background-color: <?=$col?>; height: auto"; >
            <?=$status_text;?>
        </div>
        <div style="float: left; width: 24%;height: auto">
            <div>
                Состояние
            </div>
            <div>
                Рекомендации
            </div>
        </div>
        <div style="float: left; width: 24%;height: auto">
            <div>
                <?=$condition;?>
            </div>
            <div>
                <?=$recommendations;?>
            </div>
        </div>
    </div>
    <!--    END Проверка кода ответа сервера для файла robots.txt-->
    <!--    Проверка наличия файла robots.txt-->
    <?php    if ($url->getRobotsResponse()==200){
        $col='green';
        $status_text='OK';
        $condition='Файл robots.txt присутствует';
        $recommendations='Доработки не требуются';
    }
    else {
        $col='red';
        $status_text='Ошибка';
        $condition='Файл robots.txt отсутствует';
        $recommendations='Программист: Создать файл robots.txt и разместить его на сайте.';
    } ?>
    <div style="width: 100%">
        <div style="float: left; width: 24%;height: auto">
            Проверка наличия файла robots.txt
        </div>
        <div style="float: left; width: 24%; background-color: <?=$col?>; height: auto"; >
            <?=$status_text;?>
        </div>
        <div style="float: left; width: 24%;height: auto">
            <div>
                Состояние
            </div>
            <div>
                Рекомендации
            </div>
        </div>
        <div style="float: left; width: 24%;height: auto">
            <div>
                <?=$condition;?>
            </div>
            <div>
                <?=$recommendations;?>
            </div>
        </div>
    </div>
    <!--    END Проверка наличия файла robots.txt-->
    <!--    Проверка размера файла robots.txt-->
    <?php
    $sizeKB=round($url->getRobotsSize()/1024, 2);
    if ($sizeKB<32){
        $col='green';
        $status_text='OK';
        $condition='Размер файла robots.txt составляет '.$sizeKB.' кб, что находится в пределах допустимой нормы';
        $recommendations='Доработки не требуются';
    }
    else {
        $col='red';
        $status_text='Ошибка';
        $condition='Размера файла robots.txt составляет '.$sizeKB.' кб, что превышает допустимую норму';
        $recommendations='Программист: Максимально допустимый размер файла robots.txt составляем 32 кб. Необходимо отредактировть файл robots.txt таким образом, чтобы его размер не превышал 32 Кб';
    } ?>
    <div style="width: 100%">
        <div style="float: left; width: 24%;height: auto">
            Проверка размера файла robots.txt
        </div>
        <div style="float: left; width: 24%; background-color: <?=$col?>; height: auto"; >
            <?=$status_text;?>
        </div>
        <div style="float: left; width: 24%;height: auto">
            <div>
                Состояние
            </div>
            <div>
                Рекомендации
            </div>
        </div>
        <div style="float: left; width: 24%;height: auto">
            <div>
                <?=$condition;?>
            </div>
            <div>
                <?=$recommendations;?>
            </div>
        </div>
    </div>
    <!--    END Проверка размера файла robots.txt-->
    <!--    Проверка указания директивы Host-->
    <?php
    if ($url->getHostExistence()){
        $col='green';
        $status_text='OK';
        $condition='Директива Host указана';
        $recommendations='Доработки не требуются';
    }
    else {
        $col='red';
        $status_text='Ошибка';
        $condition='В файле robots.txt не указана директива Host';
        $recommendations='Программист: Для того, чтобы поисковые системы знали, какая версия сайта является основных зеркалом, необходимо прописать адрес основного зеркала в директиве Host. В данный момент это не прописано. Необходимо добавить в файл robots.txt директиву Host. Директива Host задётся в файле 1 раз, после всех правил.';
    } ?>
    <div style="width: 100%">
        <div style="float: left; width: 24%;height: auto">
            Проверка указания директивы Host
        </div>
        <div style="float: left; width: 24%; background-color: <?=$col?>; height: auto"; >
            <?=$status_text;?>
        </div>
        <div style="float: left; width: 24%;height: auto">
            <div>
                Состояние
            </div>
            <div>
                Рекомендации
            </div>
        </div>
        <div style="float: left; width: 24%;height: auto">
            <div>
                <?=$condition;?>
            </div>
            <div>
                <?=$recommendations;?>
            </div>
        </div>
    </div>
    <!--  END Проверка указания директивы Host-->
    <!--    Проверка количества директив Host, прописанных в файле-->
    <?php
    if ($url->getHostQuantity()==1){
        $col='green';
        $status_text='OK';
        $condition='В файле прописана 1 директива Host';
        $recommendations='Доработки не требуются';
    }
    else {
        $col='red';
        $status_text='Ошибка';
        $condition='В файле прописано несколько директив Host';
        $recommendations='Программист: Директива Host должна быть указана в файле толоко 1 раз. Необходимо удалить все дополнительные директивы Host и оставить только 1, корректную и соответствующую основному зеркалу сайта';
    } ?>
    <div style="width: 100%">
        <div style="float: left; width: 24%;height: auto">
            Проверка количества директив Host, прописанных в файле
        </div>
        <div style="float: left; width: 24%; background-color: <?=$col?>; height: auto"; >
            <?=$status_text;?>
        </div>
        <div style="float: left; width: 24%;height: auto">
            <div>
                Состояние
            </div>
            <div>
                Рекомендации
            </div>
        </div>
        <div style="float: left; width: 24%;height: auto">
            <div>
                <?=$condition;?>
            </div>
            <div>
                <?=$recommendations;?>
            </div>
        </div>
    </div>
    <!--   END Проверка количества директив Host, прописанных в файле-->
    <!--    Проверка указания директивы Sitemap-->
    <?php
    if ($url->getSitemapExistence()==1){
        $col='green';
        $status_text='OK';
        $condition='Директива Sitemap указана';
        $recommendations='Доработки не требуются';
    }
    else {
        $col='red';
        $status_text='Ошибка';
        $condition='В файле robots.txt не указана директива Sitemap';
        $recommendations='Программист: Добавить в файл robots.txt директиву Sitemap';
    } ?>
    <div style="width: 100%">
        <div style="float: left; width: 24%;height: auto">
            Проверка указания директивы Sitemap
        </div>
        <div style="float: left; width: 24%; background-color: <?=$col?>; height: auto"; >
            <?=$status_text;?>
        </div>
        <div style="float: left; width: 24%;height: auto">
            <div>
                Состояние
            </div>
            <div>
                Рекомендации
            </div>
        </div>
        <div style="float: left; width: 24%;height: auto">
            <div>
                <?=$condition;?>
            </div>
            <div>
                <?=$recommendations;?>
            </div>
        </div>
    </div>
    <!--    END Проверка указания директивы Sitemap-->
<?php else:    ?>
    <div>
        URL <strong><?=$url->getUrl();?> </strong>введен не корректно.  <a href="/">Попробывать снова</a>
    </div>
<?php endif; ?>



