<?php
class Proxy
{
    private $proxy;

    public function parseProxy()
    {
        $page = file_get_contents("rsc/proxy.html");
        $page = mb_convert_encoding($page, "utf-8", "cp1251");

        preg_match("#<table class=proxy__t>.+?</table>#su", $page, $match);

        if (!isset($match[0])) {
            exit("Ошибка 1");
        }

        $text = $match[0];

        preg_match("#<tbody>.+?</tbody>#s", $text, $match);

        if (!isset($match[0])) {
            exit("Ошибка 2");
        }

        $text = $match[0];

        preg_match_all("#<tr>.+?</tr>#s", $text, $matches);

        if (!isset($matches[0][0])) {
            exit("Ошибка 3");
        }

        $arrText = $matches[0];

        foreach ($arrText as $value) {
            preg_match("#<td.+?>([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)</td><td>([0-9]+)</td>#", $value, $match);

            if (!isset($match[1]) || !isset($match[2])) {
                exit("Ошибка 4");
            }

            $this->proxy[] = $match[1] . ":" . $match[2];
        }

        $a = 1;
    }
}
