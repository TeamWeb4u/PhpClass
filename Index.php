<?

/***
 * Class Index
 * setTemplate - установка шаблона
 *  - $template [название шаблона]
 *  - $data [массив данных]
 *
 * getMenu - вывод главного меню
 *  - $current [активное сейчас меню]
 */
class Index
{

    public function setTemplate($template, $data, $flag=0)
    {
        if ($flag==0) {
            $str = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/template/' . $template . '.tpl');
        } else if ($flag==1) {
            $str = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/template/dialog/' . $template . '.tpl');
        }
        foreach ($data as $key => $value) {
            $str = str_replace('{$' . $key . '}', $value, $str);
        }
        return $str;
    }

    public function getMenu($current)
    {
        $menu = [
            [
                "name" => "Группы",
                "url" => "groups",
                "class" => "fa-users"
            ],
            [
                "name" => "Реестр",
                "url" => "clients",
                "class" => "fa-pencil-square-o"
            ],
            [
                "name" => "Настройки",
                "url" => "settings",
                "class" => "fa fa-cog"
            ]
        ];
        $x = "";
        foreach ($menu as $row) {
            $data = [
                "url" => $row["url"],
                "active" => $current == $row["url"] ? 'class="active"' : '',
                "class" => $row["class"]
            ];
            $x .= $this->setTemplate("menu_li", $data);
        }

        return $x;
    }

    public function getValid($str, $flag='null'){
        switch ($flag){
            case 'null':
                return trim($str)==''?false:true;
                break;
        }
    }

    public function getDay(){
        $day='';
        for ($i=1;$i<=31;$i++){
            $day.='<option value="'.$i.'">'.$i.'</option>';
        }
        return $day;
    }

    public function getMonth(){
        $arr=['', 'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
        $month='';
        for ($i=1;$i<=12;$i++){
            $month.='<option value="'.$i.'">'.$arr[$i].'</option>';
        }
        return $month;
    }

    function slog($n, $forms) {
        return $n%10==1&&$n%100!=11?$forms[0]:($n%10>=2&&$n%10<=4&&($n%100<10||$n%100>=20)?$forms[1]:$forms[2]);
    }

    public function getMonthName($id){
        $arr=['', 'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
        return $arr[$id];
    }
}

?>
