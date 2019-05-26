<?php
abstract class Api
{
    public $apiName = '';//выбор таблицы

    protected $method = ''; //просмотр/удаление/добавление

    public $requestUri = [];
    public $requestParams = [];

    protected $action = '';//название


    public function __construct()
    {
        header("Access-Control-Allow-Orgin: *");
        header("Access-Control-Allow-Methods: *");
        
        //Массив GET параметров разделенных слешем
        $url = urldecode($_SERVER['REQUEST_URI']);
        $url = explode('?',$url);
        $this->requestUri = explode('/', trim($url[0],'/'));

        array_shift($this->requestUri);
        array_shift($this->requestUri);

        $this->requestParams = $_REQUEST;

        if(!isset($this->requestParams['format']))
        {
            throw new RuntimeException('No Content', 204);
        }
        switch ($this->requestParams['format'])
        {
            case 'json': header("Content-Type: application/json"); break;
            case 'xml': header('Accept: application/xml; charset=UTF-8'); break;
            default: throw new RuntimeException('Format Not Found', 415); break;
        }
        $this->method = $_SERVER['REQUEST_METHOD'];




    }

    public function run() {
        //Первые 2 элемента массива URI должны быть "api" и название таблицы
        if(isset($this->requestParams['email']) && isset($this->requestParams['key']))
        {
            $email = $this->requestParams['email'];
            $user = $GLOBALS["connect"]->query("SELECT * FROM `user` WHERE email='$email'");
            $user = $user->fetch(PDO::FETCH_ASSOC);
            if(strcmp($user['token'],$this->requestParams['key'])!=0)
            {
                throw new RuntimeException('Access is denied', 403);
            }
            if(array_shift($this->requestUri) !== 'application.php' || array_shift($this->requestUri) !== $this->apiName){
                throw new RuntimeException('API Not Found', 404);
            }
            //Определение действия для обработки
            $this->action = $this->getAction();

            //Если метод(действие) определен в дочернем классе API
            if (method_exists($this, $this->action)) {
                return $this->{$this->action}();
            } else {

            }
        }
        throw new RuntimeException('No Content', 204);

    }

    protected function response($data, $status = 500) {

        if($status != 200)
        {
            throw new RuntimeException('Data no found', 404);

        }
        //проверка реквест  на формат
        switch ($this->requestParams['format'])
        {
            case 'json': return json_encode($data,JSON_UNESCAPED_UNICODE); break;
            case 'xml':
                $xml =Api::CreateXML($data);
                return $xml;
            break;
        }

    }

    private function requestStatus($code) {
        $status = array(
            200 => 'OK',
            404 => 'Not Found',
            204 => 'No Content',
            415 => 'Format Not Found',
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error',
        );
        return ($status[$code])?$status[$code]:$status[500];
    }

    protected function getAction()
    {

        if(!isset($this->requestParams['name']))
        {
            return 'indexAction';//просмотр всех пользователей

        }
        else {
            return 'viewAction';//просмотр конкретного
        }
    }
    abstract protected function indexAction();
    abstract protected function viewAction();

    public static function CreateXML($data)
    {

        $xml = new DOMDocument("1.0", "UTF-8");
        $xml->preserveWhiteSpace = false;
        $xml->formatOutput = true;

        $xml_root = $xml->createElement("XML-Answer");
        $xml_root->setAttribute("Version","1.0");

        $xml_item = $xml->createElement("Result");
        $xml_root->appendChild($xml_item);
        if(count($data)>5)
        {
            for ($i=0;$i<count($data);$i++)
            {
                $xml_item->appendChild($xml->createElement('ID', $data[$i]['id']));
                $xml_item->appendChild($xml->createElement('name',$data[$i]['name'] ));
                $xml_item->appendChild($xml->createElement('email',$data[$i]['email'] ));
                $xml_item->appendChild($xml->createElement('photo',$data[$i]['photo'] ));
                $xml_item->appendChild($xml->createElement('key',$data[$i]['key'] ));
            }
        } else {
            $xml_item->appendChild($xml->createElement('ID', $data['id']));
            $xml_item->appendChild($xml->createElement('name',$data['name'] ));
            $xml_item->appendChild($xml->createElement('email',$data['email'] ));
            $xml_item->appendChild($xml->createElement('photo',$data['photo'] ));
            $xml_item->appendChild($xml->createElement('key',$data['key'] ));
        }


        $xml->appendChild($xml_root);
        $_xml = $xml->saveXML();
        //echo $_xml;
        return $_xml;

    }


}

?>
