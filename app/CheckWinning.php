<?php
use Sunra\PhpSimple\HtmlDomParser as Parser;

class CheckWinning
{
    public $url;
    public $dom;
    public $email = array();
    public $file;
    public $htmlNode;
    public $data;

    public function __construct($options = array())
    {
        $this->url = $options['url'];
        $this->email = $options['email'];
        $this->htmlNode = $options['htmlNode'];
        $this->file = dirname(__FILE__) . DIRECTORY_SEPARATOR . "tmp" . DIRECTORY_SEPARATOR . $options['tmpName'];
        $this->query();
    }

    public function query()
    {
        $content = $this->getContents($this->url);
        $dom = Parser::str_get_html($content);
        $result = $dom->find($this->htmlNode, 0)->plaintext;
        $this->data = $result;
        $this->check();
    }

    public function check()
    {
//        $nowFile = $this->data;
//        $oldFile = $this->getFile();
//        if ($nowFile !== $oldFile) {
//            $this->setFile();
//        }
        $this->sendMail();
    }

    public function getFile()
    {
        return file_get_contents($this->file);
    }

    public function setFile()
    {
        return file_put_contents($this->file, $this->data);
    }

    public function getContents($url)
    {
        $content = file_get_contents($url);

        return mb_convert_encoding($content, 'UTF-8', 'windows-1251');
    }

    public function sendMail()
    {
        $subject = "New post on " . $this->url;
        $text = "<a href='$this->url'>link</a>";
        foreach ($this->email as $mail) {
            $this->setMail($mail, $subject, $text);
        }
    }

    public function setMail($to, $subject, $text)
    {
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        return mail($to, $subject, $text, $headers);
    }
}
